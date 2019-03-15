<?php

/**
* Dynamic Selects: Actions
*
* This file forms part of the Dynamic Selects Suite.
* Executes various runtime CRUD tasks for the module.
* 
* @author Francis Otieno (Kongondo)
* @version 0.0.5
*
* This is a Copyrighted Commercial Module. Please do not distribute or host publicly. The license is not transferable.
*  
* Dynamic Selects for ProcessWire
* Copyright (C) 2016 by Francis Otieno
* Licensed under a Commercial Licence (see README.txt)
*
*/

class DynamicSelectsActions extends ProcessDynamicSelects {

	/**
	 * Set some key properties for use throughout the class.
	 *
	 * @access public
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->dsUtilities = new DynamicSelectsUtilities();
		$this->dsDatabase = new DynamicSelectsDatabase();
	}

	// class properties needed by various methods
	private $dataObj;
	private $triggerColumn;
	private $triggerColumnIsFirst;
	private $dependentColumn;
	private $dataRelationship;
	private $dataSource;
	private $dataPageID;
	
	private $dsName;
	private $firstColumnName;
	private $columnNames;
	
	private $frontCache;
	private $cacheTime;	
	
	private $includedExcludedIDs;
	
	private $includedTemplates;
	private $excludedTemplates;
	private $includedPages;
	private $excludedPages;
	/*private $includedFields;
	private $excludedFields;*/

	private $dsSettings;

	private $multiLingual;
	private $dsCacheName;

	

/* ######################### - PROCESS ACTIONS - ######################### */


	/**
	 * Determine what action to apply to selected Dynamic Selects.
	 *
	 * Actions are: publish, unpublish, lock, unlock, trash, delete.
	 *
	 * @access public
	 * @param string $actionType Type of action to apply.
	 * @param array|string|object $dsItems Selected dynamic selects to action.
	 * @param array $options Options to guide manipulation of selects.
	 * @return array $data This array is returned from the respective action type methods. It contains error/success messages.
	 *
	 */
	public function actionDynamicSelects($actionType, $dsItems, $options = array()) {

		$data = array();

		// @note: all requests sent here are non-ajax

		// dynamic selects: create new selects
		if($actionType == 'create')			$data = $this->actionCreate($dsItems, $options);
		// dynamic selects: bulk actions
		elseif($actionType == 'publish')	$data = $this->actionPublish($dsItems, 1);
		elseif($actionType == 'unpublish')	$data = $this->actionPublish($dsItems, 0);
		elseif($actionType == 'lock')		$data = $this->actionLock($dsItems, 1);
		elseif($actionType == 'unlock') 	$data = $this->actionLock($dsItems, 0);
		elseif($actionType == 'trash')		$data = $this->actionDelete($dsItems, 1);
		elseif($actionType == 'delete')		$data = $this->actionDelete($dsItems, 0);
		// dynamic selects: editing a single Dynamic Selects
		elseif($actionType == 'edit')		$data = $this->actionEdit($dsItems);// single Dynamic Selects edit	
				
		// non-ajax request responses
		if($data['message'] == 'error') $this->error($data['error']);
		elseif($data['message'] == 'success') $this->message($data['success']);		
		else $this->error($this->_('Dynamic Selects: There was an error. We could not process your request.'));// catering for the unknowns		

	}

	/**
	 * Create dynamic selects (pages).
	 *
	 * Can be single or bulk.
	 *		
	 * @access private
	 * @param string $items newline-separated titles of dynamic selects to create.
	 * @param array $options Options to guide dynamic selects creation.
	 * @return array $data Feedback: success/error messages if any.
	 *
	 */	
	private function actionCreate($items, Array $options) {

		$sanitizer = $this->wire('sanitizer');
		$data = array();

		$failed = array();
		$dynamicSelects = explode("\n", $items);// convert to an array
		
		$parent = $this->wire('page');// @note: to enable non-superusers to be able to create Dynamic Selects if they have the permission
		$template = $this->wire('templates')->get('dynamic-selects');
	
		// Sanitize and save new dynamic selects

		$i = 0;// set counter for number of selects added
		foreach ($dynamicSelects as $ds) {
			$p = new Page();
			$p->parent = $parent;
			$p->template = $template;
			$p->title = $sanitizer->text($ds);// @note: already works fine in multilingual
			if (!$p->title) continue;// skip to next if no title provided
			if ($p->title) $p->name = $sanitizer->pageName($p->title);// sanitize and convert to a URL friendly page name

			// check if name already taken
			if($p->parent->child("name={$p->name}, include=all")->id) {
				// if the name already exists, add it to the $failed array [to display to user in error message later] and skip to next title
				$failed [] = $p->title;
				continue;
			}

			// if user pressed 'save unpublished' or they have no publish permission, we save new dynamic selects unpublished
			if ((int) $options['published'] == 0 || $this->noPublish) $p->addStatus(Page::statusUnpublished);
			// @note: saving as hidden; we don't want to show in AdminThemeReno side menu
			$p->addStatus(Page::statusHidden);
			$p->save();
			$i++;

		}// end foreach $dynamicSelects as $ds

		// create a string of "failed" dynamic selects titles to add to error message
		$failedTitles = implode(', ', $failed); 

		// tell user how many dynamic selects were added
		if($i > 0) {
			$data['message'] = 'success';
			$actionTaken = sprintf(_n("Dynamic Selects: Added %d new dynamic select.", "Dynamic Selects: Added %d new dynamic dynamic selects.", $i), $i);
			if($failedTitles) $actionTaken = $actionTaken . $this->_(" Some dynamic selects not added because names already in use. These are: {$failedTitles}.");			
			$data['success'] = $actionTaken;			
		}

		else {
			$data['message'] = 'error';
			$data['error'] = $this->_("Dynamic Selects: Nothing added because specified names are already in use. These are: {$failedTitles}.");
		}

		return $data;
		
	}

	/**
	 * Publish/Unpublish dynamic selects.
	 *
	 * Called by actionDynamicSelects to bulk unpublish/publish dynamic selects.
	 * Only used in ProcessDynamicSelects context.
	 * Only those with 'dynamic-selects-publish' permission (if present) will be able to select the action.
	 *
	 * @access private
	 * @param array $items Selected 'dynamic selects' to publish/unpublish (i.e. the pages themselves).
	 * @param int $action Whether to publish or unpublish. 0=unpublish; 1=publish.
	 * @return array $data Feedback: success/error messages if any.
	 *
	 */
	private function actionPublish($items = array(), $action) {

		$data = array();

		// @access-control: dynamic-selects-publish
		if($this->noPublish) {
			$data['message'] = 'error';
			$data['error'] = $this->_('Dynamic Selects: You have no permission to (un)publish selects.');
			return $data;
		}
		
		$pages = $this->wire('pages');
		$actionTaken = '';
		$actionStr = $action ? $this->_('published') : $this->_('unpublished');

		if(count($items)) {

			$i = 0;// count for success actions
			$j = 0;// count for failed actions

				foreach ($items as $id) {

					$p = $pages->get((int) $id);
					if(!$p->id) continue;

					// if 'dynamic selects' page locked for edits
					if($p->is(Page::statusLocked)) {
						$j++;
						continue;
					}

					// unpublish 'dynamic selects' page
					if($action == 0) {
						$p->addStatus(Page::statusUnpublished);
						$p->save();
												
						// confirm successfully unpublished
						if ($p->is(Page::statusUnpublished)) $i++;
						else $j++;
					}

					// publish 'dynamic selects'
					elseif($action == 1) {
						$p->removeStatus(Page::statusUnpublished);
						$p->save();
						
						// confirm successfully published
						if (!$p->is(Page::statusUnpublished)) $i++;
						else $j++;
					}

					else $j++;

				}// end foreach

			/* prepare responses */

			if($i > 0) {
					
				$actionTaken = sprintf(_n('Dynamic Selects: %1$d item %2$s.', 'Dynamic Selects: %1$d items %2$s.', $i, $actionStr), $i, $actionStr);
				if($j) $actionTaken = $actionTaken . 
									  sprintf(_n(' %1$d select is locked for edits and could not be %2$s', ' %1$d selects are locked for edits and could not be %2$s.', $j, $actionStr), $j, $actionStr);
				$data['message'] = 'success';
				$data['success'] = $actionTaken;

			}
						
			// if we could not (un)publish any 'dynamic selects'
			else {
					
				$lockedEditsStr = $this->_(' Selects locked for edits.');
				$error = $this->_('Dynamic Selects: Selected items could not be ') . $actionStr . '. ' . $lockedEditsStr;
				
				$data['message'] = 'error';
				$data['error'] = $error;
			}

		}// end if count($items)

		return $data;

	}

	/**
	 * Lock/Unlock dynamic selects.
	 *
	 * Called by actionDynamicSelects to bulk unlock/lock dynamic selects.
	 * Only used in ProcessDynamicSelects context.
	 * Only those with 'dynamic-selects-lock' permission (if present) will be able to select the action.
	 *
	 * @access private
	 * @param array $items Selected 'dynamic selects' to unlock/lock (i.e. the pages themselves).
	 * @param int $action Whether to lock or unlock. 0=unlock; 1=lock.
	 * @return array $data Feedback: success/error messages if any.
	 *
	 */
	private function actionLock($items = array(), $action) {

		$data = array();

		// @access-control: dynamic-selects-lock
		if($this->noLock) {
			$data['message'] = 'error';
			$data['error'] = $this->_('Dynamic Selects: You have no permission to (un)lock selects.');
			return $data;
		}
		
		$pages = $this->wire('pages');
		$actionTaken = '';
		$actionStr = $action ? $this->_('locked') : $this->_('unlocked');

		if(count($items)) {

			$i = 0;// count for success actions
			$j = 0;// count for failed actions

			foreach ($items as $id) {

				$p = $pages->get((int) $id);
				if(!$p->id) continue;

				// unlock 'dynamic selects'
				if($action == 0) {
					$p->removeStatus(Page::statusLocked);
					$p->save();
					
					// confirm successfully unlocked
					if (!$p->is(Page::statusLocked)) $i++;
					else $j++;
				}

				// lock 'dynamic selects'
				elseif($action == 1) {
					$p->addStatus(Page::statusLocked);
					$p->save();
					
					// confirm successfully locked
					if ($p->is(Page::statusLocked)) $i++;
					else $j++;
				}

				else $j++;

				}// end foreach

			/* prepare responses */

			if($i > 0) {
					
				$actionTaken = sprintf(_n('Dynamic Selects: %1$d item %2$s.', 'Dynamic Selects: %1$d items %2$s.', $i, $actionStr), $i, $actionStr);
				if($j) $actionTaken = $actionTaken .
									  sprintf(_n(' %1$d select could not be %2$s', ' %1$d selects could not be %2$s.', $j, $actionStr), $j, $actionStr);
					
				$data['message'] = 'success';
				$data['success'] = $actionTaken;

			}
						
			// if we could not (un)lock any 'dynamic selects'
			else {

				$lockedEditsStr = $this->_(' Selects locked for edits.');
				$error = $this->_('Dynamic Selects: Selected items could not be ') . $actionStr . '. ' . $lockedEditsStr;
					
				$data['message'] = 'error';
				$data['error'] = $error;
			}	

		}// end if count($items)

		return $data;

	}

	/**
	 * Trash/Delete dynamic selects.
	 *
	 * Called by actionDynamicSelects to trash/delete dynamic selects.
	 * Also for trashing single dynamic select (edit mode).
	 * Only used in ProcessDynamicSelects context.
	 * Only those with 'dynamic-selects-delete' permission (if present) will be able to select the action.
	 *
	 * @access private
	 * @param Array $items Selected 'dynamic selects' to trash/delete (i.e. the pages themselves).
	 * @param Int $action Whether to trash or delete. 0=delete; 1=trash.
	 * @return Array $data Success/Error messages to return to user.
	 *
	 */
	private function actionDelete($items = array(), $action) {

		$data = array();

		// @access-control: dynamic-selects-delete
		if($this->noDelete) {
			$data['message'] = 'error';
			$data['error'] = $this->_('Dynamic Selects: You have no permission to trash/delete selects.');
			return $data;
		}
		
		$pages = $this->wire('pages');
		$actionTaken = '';
		$actionStr = $action ? $this->_('trashed') : $this->_('deleted');

		if(count($items)) {

			$i = 0;// count for success actions
			$j = 0;// count for failed actions

			foreach ($items as $id) {

				$p = $pages->get((int) $id);
				if(!$p->id) continue;

				// if 'dynamic selects' page locked for edits
				if($p->is(Page::statusLocked)) {
					$j++;
					continue;
				}

				$dsName = $p->name;

				// delete 'dynamic selects' page
				if($action == 0) {
					$p->delete();// delete the page
					if($pages->get((int) $id)->id == 0) {
						$i++;// confirm deleted
						// also delete the Dynamic Selects cache
						$this->deleteSelectsCache($dsName);
					}
					else $j++;// found page but for some reason failed to delete
				}

				// trash 'dynamic selects' page
				elseif($action == 1) {
					$pages->trash($p);// trash the page
					if ($p->is(Page::statusTrash)) {
						$i++;// confirm trashed;
						// also delete the Dynamic Selects cache
						$this->deleteSelectsCache($dsName);
					} 
					else $j++;// found page but for some reason failed to trash
				}

				else $j++;

			}// end foreach

			/* prepare responses */

			if($i > 0) {
					
				$actionTaken = sprintf(_n('Dynamic Selects: %1$d item %2$s.', 'Dynamic Selects: %1$d items %2$s.', $i, $actionStr), $i, $actionStr);
				if($j) $actionTaken = $actionTaken . 
									  sprintf(_n(' %1$d select is locked for edits and could not be %2$s', ' %1$d selects are locked for edits and could not be %2$s.', $j, $actionStr), $j, $actionStr);
					
				$data['message'] = 'success';
				$data['success'] = $actionTaken;
			}
						
			// if we could not (un)publish any 'dynamic selects'
			else {
					
				$lockedEditsStr = $this->_(' Selects locked for edits.');
				$error = $this->_('Dynamic Selects: Selected items could not be ') . $actionStr . '. ' . $lockedEditsStr;
					
				$data['message'] = 'error';
				$data['error'] = $error;
			}

		}// end if count($items)

		return $data;

	}
		
	/**
	 * Edit a single Dynamic Selects.
	 *
	 * Only those with 'dynamic-selects-edit' permission (if present) will be able to edit and save settings.
	 *		
	 * @access public
	 * @param Object $post Submitted form input.
	 * @return Array $data Success/Error messages to return to user.
	 *
	 */	
	public function actionEdit($post) {

		// @note: form where the post comes from already processed		
		// process form
		#$form->processInput($post); 

		// @access-control: dynamic-selects-edit
		// @note: should they be able to view if they cannot edit? yes
		if($this->noEdit) {
			$data = array();
			$data['message'] = 'error';
			$data['error'] = $this->_('Dynamic Selects: You have no permission to edit these settings.');
			return $data;
		}

		$data = array();
		$actionTaken = '';
		$noAccessRedirectURL = '';
		$noAccessCustomMessage = '';
		$cacheMsg = '';
		$sanitizer = $this->wire('sanitizer');

		// get the dynamic selects page
		$p = $this->wire('pages')->get((int) $post->ds_id);
		
		// if we didn't get the page, abort
		if(!$p->id) {
				$data['message'] = 'error';
				$data['error'] = $this->_('Dynamic Selects: We did not find that dynamic selects item!');
				return $data;
		}

		// @access-control: dynamic selects locked
		// if dynamic selects is locked but user has some editing rights
		if($p->is(Page::statusLocked)) {

			// dynamic selects locked BUT user has no permission to (un)lock
			if($this->noLock) {
				$data['message'] = 'error';
				$data['error'] = $this->_('Dynamic Selects: This select is locked for edits.');
			} 

			// dynamic selects locked BUT user has permission to unlock and they clicked the save button
			elseif((int) $post->ds_lock == 0) {
				$p->removeStatus(Page::statusLocked);
				$p->save();
				$data['message'] = 'success';
				$data['success'] = $this->_('Dynamic Selects: The select has been unlocked for editing.');
			}
			// select locked, user has permission to unlock BUT they attempted to save without first unlocking select
			else {
				$data['message'] = 'error';
				$data['error'] = $this->_('Dynamic Selects: This select is locked for edits. Unlock it first to enable editing.');
			}
			
			return $data;

		}// end if dynamic select is locked

		/** select is not locked so good to go with normal edits **/

		// check for name change in order to delete 'old' cache
		$oldName = $sanitizer->pageName($post->ds_old_name);

		$p->title = $sanitizer->text($post->ds_title);

		// if no title provided, halt, return error message
		if(!$p->title) {
			$data['message'] = 'error';
			$data['error'] = $this->_('Dynamic Selects: A title is required.');
			return $data;
		}

		// if a title was provided, we sanitize and convert it to a URL friendly page name
		if($p->title) $p->name = $sanitizer->pageName($p->title);// @note: already works fine in multilingual
		//if name already exists [i.e. a child under this parent]; don't proceed
		if($p->parent->child("name={$p->name}, id!={$p->id}, include=all")->id) {
			//if name already in use, we tell the user in an error message and stop process
			$data['message'] = 'error';
			$data['error'] = $this->_('Dynamic Selects: A select item with that title already exists. Amend the title and try again.');
			return $data;
		}

		// (un)publish select: dynamic-selects-publish
		// @access-control
		if(!$this->noPublish) {
			if((int) $post->ds_publish == 0) $p->addStatus(Page::statusUnpublished);
			elseif((int) $post->ds_publish == 1) $p->removeStatus(Page::statusUnpublished);
		}

		// lock select @note: above already checked if select locked so if here, it means select is unlocked so CAN only be 'locking'
		// @access-control: dynamic-select-lock
		if(!$this->noLock && (int) $post->ds_lock == 1) $p->addStatus(Page::statusLocked);

		// prepare and save dynamic select columns and settings
		$ds = new WireData();
		$this->dsName = $ds->uniqueid = $p->name;
		$this->dsCacheName = $this->dsName . $this->dsUtilities->setLanguageSuffix();

		$ds->firstColumn = (int) $post->firstColumn;// @todo...error here or later if no input specified?
		if($post->firstColumnSelector) $ds->firstColumnSelector = $this->dsUtilities->sanitizeSelector($post->firstColumnSelector);		
		if($post->firstColumnFindCode) $ds->firstColumnFindCode = $post->firstColumnFindCode;// @note: not possible to sanitize this. Up to dev!
		
		if($post->includedTemplates) $ds->includedTemplates = $post->includedTemplates;// -ditto-
		if($post->excludedTemplates) $ds->excludedTemplates = $post->excludedTemplates;
		
		if($post->includedPages) $ds->includedPages = $post->includedPages;
		if($post->excludedPages) $ds->excludedPages = $post->excludedPages;
		
		if($post->includedFields) $ds->includedFields = $post->includedFields;
		if($post->excludedFields) $ds->excludedFields = $post->excludedFields;// -ditto-


		if($post->hideEmptySelects) $ds->hideEmptySelects = (int) $post->hideEmptySelects;
		//@todo: will add if there's enough demand for this + will be a JS solution
		//if($post->autoFinalSingleSelect) $ds->autoFinalSingleSelect = (int) $post->autoFinalSingleSelect;
		if($post->frontAccess) $ds->frontAccess = (int) $post->frontAccess;
		if($post->noFrontAccessAction) $ds->noFrontAccessAction = (int) $post->noFrontAccessAction;
		
		// redirect URL if user does not have view access to this Dynamic Selects in frontend
		if($ds->noFrontAccessAction && $ds->noFrontAccessAction == 4) {
				$noAccessRedirectURL = $sanitizer->url($post->noFrontAccessRedirectURL);
				if(!$noAccessRedirectURL) {
					$data['message'] = 'error';
					$data['error'] = $this->_('Dynamic Selects: A URL to redirect to when a user does not have access needs to be specified.');
					return $data;
				}
				else $ds->noFrontAccessRedirectURL = $noAccessRedirectURL;
		}

		// custom message if user does not have view access to this Dynamic Selects in frontend
		elseif ($ds->noFrontAccessAction && $ds->noFrontAccessAction == 5) {
			$noAccessCustomMessage = $sanitizer->text($post->noFrontAccessCustomText);
			if(!$noAccessCustomMessage) {
					$data['message'] = 'error';
					$data['error'] = $this->_('Dynamic Selects: A custom message to show when a user does not have access needs to be specified.');
					return $data;
				}
				else $ds->noFrontAccessCustomText = $noAccessCustomMessage;
		}

		if($post->frontCache) $ds->frontCache = (int) $post->frontCache;
		if($ds->frontCache) {
			$cacheTime = abs((int) $post->cacheTime);
			if($cacheTime < 1) {
				$data['message'] = 'error';
				$data['error'] = $this->_('Dynamic Selects: You need to specify a valid cache time in seconds.');
				return $data;
			}
			else $this->cacheTime = $ds->cacheTime = abs($cacheTime);
		}		

		// process dynamic selects 'columns', i.e. the individual selects that together form the 'dynamic selects'
		$dsSettings = $this->actionProcessColumns($ds, $post);

		// if we got any errors from processing columns, we abort
		// @note: this is indicated in the docs. E.g. any columns that were being set up (i.e. not yet saved) will be lost!
		if($dsSettings->valid == 0) {
			$this->error($ds->error);
			$data['message'] = 'error';
			$data['error'] = $ds->error;
			return $data;
		}

		// JSON string of Dynamic Selects settings to save
		#$dsSettingsJSON = count($dsSettings) ? wireEncodeJSON($dsSettingsArray) : '';// wont save empties
		$dsSettingsArray = $dsSettings->getArray();
		$dsSettingsJSON = count($dsSettings) ? json_encode($dsSettingsArray) : '';// we may need to save empties
		
		$p->ds_settings = $dsSettingsJSON;

		// save the Dynamic Selects page
		$p->save();

		// if caching, create 'skeleton cache consisting of all columns names as keys
		if($ds->frontCache && $ds->cacheTime) {
			$columnNames = $this->dsUtilities->getColumnNames($dsSettingsArray);
			$this->createSelectsCache($columnNames);
			// success/error message if cache created/not created
			$cacheName = 'dynamic-selects-' . $this->dsCacheName;
			if($this->wire('cache')->get($cacheName)) $cacheMsg = $this->_(' Also created cache ') . $cacheName . '.';
			else $cacheMsg = $this->_(' Failed to create cache ') . $cacheName . '.';
		}

		// create cache of only first column. @note: We use this for frontend security checks
		else {
			$columnNames = $this->dsUtilities->getColumnNames($dsSettingsArray, true);
			$this->createSelectsCache($columnNames);
		}

		// if title/name of Dynamic Selects was changed, delete the 'old' cache
		if($oldName !== $p->name) {
			$this->deleteSelectsCache($sanitizer->pageName($oldName));
		}

		$actionTaken = $this->_('Dynamic Selects: Saved select.') . $cacheMsg;

		$data['message'] = 'success';
		$data['success'] = $actionTaken;

		return $data;

	}

	/**
	 * Process (CRUD) dynamic selects' columns.
	 *	 
	 * Used in both ProcessDynamicSelects and FieltypeDynamicSelects contexts.
	 * We validate column names, triggers and relationships.
	 * In the FieldtypeDynamicSelects context, we also carry out some database CRUD manipulations.	 
	 *
	 * @access public
	 * @param Object $ds The object to set properties to.
	 * @param Object $input The wire->post object to get input values from.
	 * @param Int $fieldMode If in field mode (1) we will be doing some database manipulations.
	 *
	 */
	public function actionProcessColumns($ds, $input, $fieldMode = 0) {

		/*###########################

			0=>name,
			1=label,
			2=data-trigger,
			3=data-relationship,
			4=data-source,

		###########################*/	
	
		$columns = array();

		$names = $input->ds_name;
		$count = count($names);

		$oldNames = $input->ds_old_name;
		$deleted = $input->ds_delete;

		$labels = $input->ds_label;
		$triggers = $input->ds_trigger;
		$relationships = $input->ds_relationship;
		$dataSources = $input->ds_datasource;

		$dbColumnsNew = array();
		$dbColumnsRenamed = array();
		$dbColumnsDeleted = array();
		$colNames = array();
		$validTriggerCheck = array();

		$triggerRelationship = 0;
		$triggerDataSource = 0;

		$sanitizer = $this->wire('sanitizer');

		$columnError = array();
		$columnError['error'] = false;// check for column errors
		
		$first = $ds->firstColumn;

		$j = 0;// for numCols count
		for ($i = 0; $i < $count; $i++) {
			// check deleted columns: if found...send to method to alter DB 
			if($deleted[$i]) {
				$dbColumnsDeleted[] = $oldNames[$i];
				continue;
			}			

			// sanitizer + name check
			$name = $this->dsUtilities->sanitizeFieldName($names[$i]);// @note: this will also enforce lowercase
			// name error
			if(!$names[$i] || !$name) {
				$columnError['error'] = true;
				$columnError['message'] = $this->_('Dynamic Selects: A name not specified or an invalid name specified');
				break;
			}

			// check new or renamed columns: if found send to methods to alter DB
			// for renamed: $key => $value: oldColName => newColName
			// for new we only add the new column $name values to our array
			$oldName = $oldNames[$i];
			if($oldName != $name) {
				// renaming column										
				if($oldName) $dbColumnsRenamed[$oldName] = $name;
				// adding new column
				else $dbColumnsNew[] = $name;
			}

			// sanitize other settings
			$label = $sanitizer->text($labels[$i]);
			$trigger = $i == 0 ? 0 : $this->dsUtilities->sanitizeFieldName($triggers[$i]);
			$relationship = $i == 0 ? 0 : (int) $relationships[$i];// 1st dropdown/column has no relationship (none==0)
			$dataSource =  $i == 0 ? 0 : (int) $dataSources[$i];// 1st dropdown/column has no data-source (initial==0)

			$colNames[] = $name;

			// for columns/dropdowns other than 1, we must have a trigger, relationship and data source
			// also triggers must be a column name of a previous column (i.e. a column cannot come before its trigger column)
			if($i > 0) {
				if(!$trigger || !$relationship || !$dataSource) {
					$columnError['error'] = true;
					$columnError['message'] = $this->_('Dynamic Selects: A trigger, a relationship or a data source not specified for the column') . ' ' . $name;
					break;
				}

				// trigger check
				if(!in_array($trigger, $colNames)) {
					$columnError['error'] = true;
					$columnError['message'] = $this->_('Dynamic Selects: No trigger found for the column') . ' ' . $name;
					break;
				}

				// relationship trigger validity				
				$triggerRelationship = $columns[$trigger][2];
				$triggerDataSource = $columns[$trigger][3];
				$valid = $this->dsUtilities->validateTrigger($triggerRelationship, $triggerDataSource, $relationship, $dataSource, $first);
				if(!$valid) {
					$columnError['error'] = true;
					$columnError['message'] = sprintf(__('Dynamic Selects: Invalid relationship between the trigger column %1$s and the dependent column %2$s'), $trigger, $name);
					break;
				}
			}

			// good to go...add to Dynamic Selects settings columns array

			// prep field settings
			$columns[$name] = array(
				$label,
				$trigger,
				$relationship,
				$dataSource,
			);

			$j++;

		}// end for

		// check for duplicate column names
		if(count($colNames) !== count(array_unique($colNames))) {
			$columnError['error'] = true;
			$columnError['message'] = $this->_('Dynamic Selects: Duplicate column names found. Names must be unique');
		}
	
		// if no errors, good to go; save settings
		if(!$columnError['error']) {
			// remove old column settings first then save new ones
			$ds->remove('columns');
			$ds->columns = $columns;
			$ds->numCols = $j;// number of columns
			$ds->valid = 1;// for checks in inputfield
			if($fieldMode === 1) $ds->save();

			################## DATABASE OPERATIONS ##################

			if ($fieldMode === 1) {
				// CREATE new columns in this fields table
				if(count($dbColumnsNew)) $this->dsDatabase->dbCreateColumns($dbColumnsNew, $ds);
				// RENAME (UPDATE) new columns in this fields table
				if(count($dbColumnsRenamed)) $this->dsDatabase->dbUpdateColumns($dbColumnsRenamed, $ds);
				// DELETE columns in this fields table
				if(count($dbColumnsDeleted)) $this->dsDatabase->dbDeleteColumns($dbColumnsDeleted, $ds);
			}

		}// end if no errors

		else {
			$ds->valid = 0;// for checks in inputfield
			if($fieldMode === 1) $ds->save();
			$error = $columnError['message'];
			$error .= '. ' . $this->_('Dynamic Selects settings not saved.');
			
			if($fieldMode === 1) $this->error($error);
			else $ds->error = $error;
		}
		
		// warning if too few columns
		if($ds->numCols < 2) $this->error($this->_('Dynamic Selects: You need at least 2 columns for this field to work; a trigger and a dependent select.'));

		if($fieldMode === 0) return $ds;

	}

	/**
	 * Evaluate given PHP string to fetch WireArray objects for use as data in first column.
	 *
	 * For first dropdown/column (i.e. initial data).
	 * @note Uses eval().
	 *
	 * @access private
	 * @param String $code PHP String to be evaluated and its value returned.
	 * @return Object $firstColumnData WireArray derived objects.
	 *
	 */
	private function findDataCode($code) {

		$page = $this->page;
		// so that $page and $pages are locally scoped to the eval
		$process = $this->wire('process'); 
		if($process && $process->className() == 'ProcessPageEdit') $page = $process->getPage();

		$pages = $this->wire('pages');
		$templates = $this->wire('templates');
		$users = $this->wire('users');

		$firstColumnData = eval($code);

		// if eval() returns anything other than a WireArray derived object return null
		if(!WireArray::iterable($firstColumnData)) return null;

		return $firstColumnData;

	}

	############################ PROCESS AJAX REQUESTS FOR DATA ############################

	/**
	 * Process ajax-data request input.
	 *
	 * Ajax requests gateway.
	 * Needed for both front- and backend contexts.
	 * Request is first validated (security checks) before data can be returned.
	 *
	 * @access public
	 * @param Object $input Post input.
	 * @param Bool $frontend Whether processing input from the front or backend.
	 * @return String $data JSON Data for the dependent select's options.
	 *
	 */
	public function processDataRequest($input, $frontend = true) {

		$data = array();

		################################ Validation ################################

		$valid = $this->dsUtilities->validateRequest($input, $frontend);
		// if validation failed...get out of here
		if(!$valid['valid']) {
			$data['message'] = 'error';
			return json_encode($data);
		}

		## top-level validation passed: good to go
		
		// @note: Further validation will be carried out in subsequent methods depending on the $dataRelationship	

		
		################################ RESULTS ################################

		$results = $this->checkDataRelationship($valid);

		// @note: prefix: for ID uniqueness when we have multiple selects and user is reusing column names
		$prefix = $this->dsName . '-';
		$dependentColumn = $prefix . $this->dependentColumn;

		$data[$dependentColumn] = $results;
		$data[$dependentColumn]['message'] = 'success';// @todo if/how to return error message if no data found?

		return json_encode($data);

	}

	/* ######################### - CHECK DATA RELATIONSHIPS - ######################### */

	/**
	 * Determine data-relationship type.
	 *
	 * Relationship dictates the method to use to fetch data.
	 * We only get here if security validation checks were passed.
	 *
	 * @access public
	 * @param Array $options Settings of a single column in the given Dynamic Selects.
	 * @return Array $data Data to populate the dependent select's options.
	 *
	 */
	public function checkDataRelationship(Array $options) {
				
		$data = array();		

		// @note: we set values to class properties here
		$this->setOptions($options);
		$dataRelationship = $this->dataRelationship;
		$dataPageID = $this->dataPageID;

		// internal data
		if($dataRelationship == 1) $data = $this->getChildData();// child: get children of page
		elseif($dataRelationship == 2) $data = $this->getParentData();// parent: get parent page of this page
		elseif($dataRelationship == 3) $data = $this->getPageData();// page: get pages using this template
		elseif($dataRelationship == 4) $data = $this->getGroupData();// group: get pages categorised under this category			
		elseif($dataRelationship == 5) $data = $this->getFieldData();// field: get this page's fields
		elseif($dataRelationship == 6) $data = $this->getValueData($dataPageID);// value: get value of given field
		elseif($dataRelationship == 7) $data = $this->getUserPropertyData();// user: property
		elseif($dataRelationship == 8) $data = $this->getUserValueData($dataPageID);// user: value

		// external data
		#elseif($dataRelationship == 9) $data = $this->getExternalJSONData($id);// external server JSON: get data of the item with this id
		#elseif($dataRelationship == 10) $data = $this->getExternalTablesData($id);// external db tables: -ditto- (@note: could be a db table name/column)

		return $data;

	}

	/* ######################### - GET DATA - ######################### */

	/**
	 * Fetch data of given pages.
	 *
	 * Utilitiy method to fetch data for child, parent, page, group, value and user: value data-relationships.
	 *
	 * @access private
	 * @param Int $dataSource ID of the field in the given pages whose values to return.
	 * @param Object $pages WireArray|PageArray of Objects to be returned as data for dynamic selects ajax request.
	 * @return Array $results Data to populate dependent select options. 
	 *
	 */
	private function getData($dataSource, $pages) {

		/* @note: security notes
			- ProcessWire will not return hidden and/or unpublished pages if we used a 'find'; so no need for this here
		 	- even if user did not block the blanket return of 'Home' children, ProcessWire will prevent the listing of Admin pages.
		 */

		// @note: needed for fitlering out/in results fetched via getUserValueData() and getValueData() since those not fetched via PW selector
		$dependentColumn = $this->dependentColumn;		

		$iterable = false;
		$iteratePages = false;
		$singleImageFile = false;
		$singlePage = false;

		$results = array();
		$resultsTemplatesIDs = array();		

		// get the data-source. It's value will be returned as the 'text' for the <option>
		// e.g. $page->title
		$fieldName = 'title';
		if($dataSource > 0) {// @todo not really necessary?

			$p = $pages->first();

			// if we got nothing, get out of here
			if(!$p) return $results;

			$f = $this->wire('fields')->get($dataSource);
			if($f && $f->id > 0) {
				$fieldName = $f->name;
				$p->of(true);// briefly turn on output formatting to correctly assess iterability (since we are in a module context)	
				if(WireArray::iterable($p->$fieldName)) {
					$iterable = true;
					if($f->type instanceof FieldtypePage) $iteratePages = true;
				}
				elseif($f->type instanceof FieldtypeFile) $singleImageFile = true;
				elseif($f->type instanceof FieldtypePage) $singlePage = true;
			}// if $f->id

		}// if $dataSource

		// @note: $pages is a WireArray (either pages or users)
		// we get its data below as per the $dataSource
		foreach ($pages as $page) {
		
			if($iterable) {
				foreach ($page->$fieldName as $item) {		
					// multi-pagefield @note: $key is pageID of the page in the pagefield			
					if($iteratePages) {
						// @filter-in/out results
						if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($item->template->id, $this->includedExcludedIDs, $dependentColumn, $item->id)) continue;
						$results[$item->id] = $this->dsUtilities->getLanguageValue('title', $item, $this->multiLingual);
						$resultsTemplatesIDs[$item->id] = $item->template->id;
					}
					// multi-image/file/options field
					else {
						$value = $item->get('name|title');
						#if(in_array($value, $iterableDuplicates)) continue;// @note: nope; they are for different pages!
						// pageID|filename.ext => e.g. 1234!my_file.ext {image|file|options} @note: custom fields not currently supported
						$results[$page->id .'|'. $value] = $value;
						$resultsTemplatesIDs[$page->id .'|'. $value] = $page->template->id;
					}	
				}					
			}// end iterable

			// a single image/file field
			elseif($singleImageFile) {
				if(!$page->$fieldName)  continue;
				$results[$page->id] = $page->$fieldName->name;
				$resultsTemplatesIDs[$page->id] = $page->template->id;
			}
			// a single pagefield
			elseif($singlePage) {
				if(!$page->$fieldName) continue;				
				// @filter-in/out results
				if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($page->$fieldName->template->id, $this->includedExcludedIDs, $dependentColumn, $page->$fieldName->id)) continue;				
				$results[$page->$fieldName->id] = $this->dsUtilities->getLanguageValue('title', $page->$fieldName, $this->multiLingual);
				$resultsTemplatesIDs[$page->$fieldName->id] = $page->$fieldName->template->id;
			}
			// other 'normal field'
			else {
				// @filter-in/out results
				if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($page->template->id, $this->includedExcludedIDs, $dependentColumn, $page->id)) continue;				
				$results[$page->id] = $this->dsUtilities->getLanguageValue($fieldName, $page, $this->multiLingual);				
				$resultsTemplatesIDs[$page->id] = $page->template->id;

			}

		}// end foreach	

		$results = array_filter($results);// remove empties
		#$results = asort($results);...@todo: works but doesn't seem to work in the selects themselves!
		#asort($results, SORT_STRING);

		$p->of(false);// revert output formatting to 'off' as usual in module context

		// @note: update cache if caching is being used in the frontend
		if(count($results) && $this->frontCache) $this->updateSelectsCache($results);		

		return $results;

	}

	/**
	 * Fetch pages|templates|users for the first/initial dynamic select.
	 *
	 * For data-relationship == 0.
	 *
	 * @access public
	 * @param Array $dsSettings Settings of the given Dynamic Selects.
	 * @param String $uniqueid The uniqueid for this Dynamic Selects.
	 * @param String $firstColumnName Name of the first column in this Dynamic Selects.
	 * @param Bool $frontend Whether we are in the frontend (MarkupDynamicSelects) or backend (FieldtypeDynamicSelects).
	 * @return Array $results Data to populate the first/initial dynamic select's options. 
	 *
	 */
	public function getInitialData($dsSettings, $uniqueid, $firstColumnName, $frontend) {

		$initialDataType = array(1=>'pages', 2=>'templates', 3=>'users');

		$results = array();

		$firstColumn = (int) $dsSettings['firstColumn'];// whether first column will list pages|templates|users => relevant only to selector
		$firstColumnFindCode = isset($dsSettings['firstColumnFindCode']) ? trim($dsSettings['firstColumnFindCode']) : '';// supercedes selector below
		$firstColumnSelector = isset($dsSettings['firstColumnSelector']) ? trim($dsSettings['firstColumnSelector']) : '';// used if code above empty

		if($firstColumnFindCode) $firstColumnData = $this->findDataCode($firstColumnFindCode);
		elseif($firstColumnSelector) {
			$type = $initialDataType[$firstColumn];
			$firstColumnData = $this->wire($type)->find($firstColumnSelector);
		}

		if ($firstColumnData->count()) {
			foreach ($firstColumnData as $data) {

				$class = get_class($data);

				if($class == 'Template' && $data->flags && Template::flagSystem) continue;// skip system templates
				elseif($class == 'User' && $data->name == 'guest') continue;// skip PW user named 'guest'
				elseif ($class == 'Page') {
					#if($data->is(Page::statusUnpublished)) continue;// @note: not needed since it uses dev/editor-set selector/PHP code to find this result
				}

				// if firstColumn is a template: multilingual check
				if($firstColumn == 2) {
					$languageID = $this->dsUtilities->setLanguage();// if no language, returns null
					if($languageID) {
						$value = $data->get("label{$languageID}");
						// if no template label for that language, get default label OR name if no label there either
						if(!$value) $value = $data->get("label|name");
					}
				}
				// else firstColumn is a page or user (@note: works out-of-the-box with multilingual)
				else $value = $data->get('title|label|name');// @note: we only display name as a last resort. Potential security issue noted in Docs (RE Users)

				$results[$data->id] = $value;


			}// end foreach firstColumnData

			/*
				@note: @see DynamicSelects::validateInitialSelect(): We create an initial cache when validating ajax request from first column if we didn't find a cache (that should have been built using below method). This could happen if the cache had expired and had not been regenerated. getInitialData() is only called when page is (re)loaded, not during an ajax request, hence the above.
			 */
			## *** CACHING: FRONTEND ONLY *** ##
			if($frontend) $this->processInitialDataCache($dsSettings, $uniqueid, $firstColumnName, $results);

		}// end if(firstColumnData->count())

		return $results;

	}

	/**
	 * Fetch children of selected page.
	 *
	 * For data-relationship == 1.
	 *
	 * @access private
	 * @return Array $results Data to populate dependent select options. 
	 *
	 */
	private function getChildData() {

		$results = array();
		$id = (int) $this->dataObj;// id of the parent page whose children to return
		$triggerColumn = $this->triggerColumn;
		
		## Trigger Validation ##
		// @access-control: cached first column data (here dataObj will always be from first/initial select)
		// @note: only applies if we are in frontend
		if($this->triggerColumnIsFirst && $this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect($id, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}				

		/*
			@note:
			- for security, we use a find instead of a get
			- hidden, unpublished and template-access controlled will be rejected
			- $parent = $this->wire('pages')->get("id=$id, check_access=1");// @note: this will let hidden pages through, so we use below instead
		 */
		$parent = $this->wire('pages')->find("id=$id, limit=1");
		if ($parent->count()) {
			
			$parent = $parent->first();// @note: changing variable to first

			## Trigger Validation ##
			// @access-control: admin pages
			if(!$this->dsUtilities->validateAdminPages($parent)) return $results;			
			// @access-control: included and excluded templates and pages
			if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($parent->template->id, $this->includedExcludedIDs, $triggerColumn, $parent->id)) return $results;

			## Trigger Validation passed: good to go ##
			// get only visible children
			#if(count($parent->numChildren(true)));
			// @todo: if limiting here would have been configurable. We cannot determine how many selectable options the dev/editor wants! For now we leave it to devs to ensure only reasonable number of children available to selects(?)
			
			if($parent->numChildren) {
				
				## filtering out/in ##
				$selector = '';
				// if some pages should be included/excluded from the results based on the templates and/or pageIDs
				if(count($this->includedTemplates) || count($this->excludedTemplates) || count($this->includedPages) || count($this->excludedPages)) {
					$selector = $this->dsUtilities->buildSelector($this->includedTemplates, $this->excludedTemplates, $this->includedPages, $this->excludedPages);
				}
				// @note: $parent->children() uses a find so it is OK...
				$results = $this->getData($this->dataSource, $parent->children($selector));// @note: dataSource was sanitized earlier
			}

		}	

		return $results;

	}

	/**
	 * Fetch the parent of the selected page.
	 *
	 * For data-relationship == 2.
	 *
	 * @access private
	 * @return Array $results Data to populate dependent select options. 
	 *
	 */
	private function getParentData() {

		$results = array();
		$id = (int) $this->dataObj;// id of the child page whose parent to return
		$triggerColumn = $this->triggerColumn;

		## Trigger Validation ##		
		// @access-control: cached first column data (if dataObj from first/initial select)
		// @note: only applies if we are in frontend
		if($this->triggerColumnIsFirst && $this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect($id, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}

		/*
			@note:
			- for security, we use a find instead of a get
			- hidden, unpublished and template-access controlled will be rejected
			- $child = $this->wire('pages')->get("id=$id, check_access=1");// @note: this will let hidden pages through, so we use below instead
		 */
		$child = $this->wire('pages')->find("id=$id, limit=1");
		if ($child->count()) {
			
			$child = $child->first();// @note: changing variable to first

			## Trigger Validation ##
			// @access-control: admin pages
			if(!$this->dsUtilities->validateAdminPages($child)) return $results;
			// @access-control: included and excluded templates and pages
			if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($child->template->id, $this->includedExcludedIDs, $triggerColumn, $child->id)) return $results;	

			## Trigger Validation passed: good to go ##
			$parent = $child->parent;
			/* 
				@note: only in this case, since $child->parent seems to use a get rather than a find...we check access ourselves
				...we avoid $parent->viewable() since that would mean parents without template files will also be excluded
				...which is not always desirable
			*/
			if($this->wire('user')->hasPermission('page-view', $parent) && !$parent->is(Page::statusUnpublished) && !$parent->is(Page::statusHidden)) {
				$pages = new PageArray();// @note: using PageArray for the WireArray::iterable condition in $this->getData()
				$pages->add($parent);
				// @note: filtering in/out doesn't make sense here; expecting only 1 parent!
				$results = $this->getData($this->dataSource, $pages);// @note: dataSource was sanitized earlier
			}

		}

		return $results;

	}

	/**
	 * Fetch pages that use the selected template.
	 *
	 * For data-relationship == 3
	 *
	 * @access private
	 * @return Array $results Data to populate dependent select options.
	 *
	 */
	private function getPageData() {

		$results = array();
		$id = (int) $this->dataObj;// id of the template whose pages to return
		$triggerColumn = $this->triggerColumn;

		## Trigger Validation ##
		// @access-control: cached first column data (here dataObj will always be from first/initial select)
		// @note: only applies if we are in frontend
		if($this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect($id, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}
		// @access-control: included and excluded templates
		if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($id, $this->includedExcludedIDs, $triggerColumn)) return $results;

		## Trigger Validation passed: good to go ##		
		$t = $this->wire('templates')->get($id);
		
		if (is_object($t) && $t && $t->id > 0 ) {
			// skip system templates
			if($t->flags && Template::flagSystem) return $results;

			## filtering out/in ##
			$selector = "template=$t";

			// if some pages should be included/excluded from the results based on the pageIDs
			/*
				@note:
					- it does not make sense here to include/exclude [filter] results by templates since results here are returned by a given template!
					- we ignore any include/exclude templates settings
			 */
			if(count($this->includedPages) || count($this->excludedPages)) {
				$sel = $this->dsUtilities->buildSelector(array(), array(), $this->includedPages, $this->excludedPages);
				if($sel) $selector .= ", $sel";
			}

			// @todo: if limiting here would have been configurable. We cannot determine how many selectable options the dev/editor wants! For now we leave it to devs to ensure only reasonable number of children available to selects(?)
			// find pages that use the named template 
			$pages = $this->wire('pages')->find("$selector");
			if($pages->count()) $results = $this->getData($this->dataSource, $pages);// @note: dataSource was sanitized earlier

		}

		return $results;

	}
	
	/**
	 * Fetch pages that have the given 'page category' in their named pagefield.
	 *
	 * Here the relationship is we have a 'category' and we want pages that use this 'category'.
	 * In other words, get the pages 'grouped' under the given 'category' page {$dataObj}
	 * For data-relationship == 4.
	 *
	 * @access private
	 * @return Array $results Data to populate dependent select options. 
	 *
	 */
	private function getGroupData() {

		$results = array();
		$id = (int) $this->dataObj;// id of the group page to find in the specified pagefield
		$triggerColumn = $this->triggerColumn;

		## Trigger Validation ##
		// @access-control: cached first column data (if dataObj from first/initial select)
		// @note: only applies if we are in frontend
		if($this->triggerColumnIsFirst && $this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect($id, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}

		/*
			@note:
			- for security, we use a find instead of a get
			- hidden, unpublished and template-access controlled will be rejected
			- $group = $this->wire('pages')->get("id=$id, check_access=1");// @note: this will let hidden pages through, so we use below instead
		 */
		$group = $this->wire('pages')->find("id=$id, limit=1");
		if ($group->count()) {
			
			$group = $group->first();// @note: changing variable to first

			## Trigger Validation ##
			// @access-control: admin pages
			if(!$this->dsUtilities->validateAdminPages($group)) return $results;
			// @access-control: included and excluded templates and pages
			if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($group->template->id, $this->includedExcludedIDs, $triggerColumn, $group->id)) return $results;

			## Trigger Validation passed: good to go ##

			// check for and grab the pagefield
			$f = $this->wire('fields')->get($this->dataSource);// @note: dataSource was sanitized earlier
			if(!$f) return $results;
			
			// fetch pages that have this page category selected in their pagefields
			$fieldName = $f->name;

			## filtering out/in ##
			$selector = "$fieldName=$group";
			// if some pages should be included/excluded from the results based on the templates and/or pageIDs
			if(count($this->includedTemplates) || count($this->excludedTemplates) || count($this->includedPages) || count($this->excludedPages)) {
				$sel = $this->dsUtilities->buildSelector($this->includedTemplates, $this->excludedTemplates, $this->includedPages, $this->excludedPages);
				if($sel) $selector .= ", $sel";
			}
			
			// @todo: if limiting here would have been configurable. We cannot determine how many selectable options the dev/editor wants! For now we leave it to devs to ensure only reasonable number of children available to selects(?)			
			$pages = $this->wire('pages')->find($selector);

			// @note: here $dataSource changes! In group relationships, we can only return the titles of the pages
			//...so we pass title field as $dataSource
			if($pages->count()) {
				$dataSource = $this->wire('fields')->get('title')->id;
				$results = $this->getData($dataSource, $pages);
			}
		}

		return $results;

	}

	/**
	 * Fetch the fields of a given page.
	 *
	 * For data-relationship == 5.
	 *
	 * @access private
	 * @return Array $results Data to populate dependent select options. 
	 *
	 */
	private function getFieldData() {		

		/* @note:
			- this method is only called by a PAGE trigger!
			- some fields not selectable in <select> or we don't allow them due to security considerations
			- some fields should not be returned even though they are compatible fields (e.g. roles)
			- site editors/devs can set some fields to be excluded from displaying in a 'field:fields' data-relationship:data-source select
			- ditto for included fields
		 */

		$results = array();
		$id = (int) $this->dataObj;// id of the page whose fields to return
		$triggerColumn = $this->triggerColumn;
		$dependentColumn = $this->dependentColumn;

		## Trigger Validation ##
		// @access-control: cached first column data (here dataObj will always be from first/initial select)
		// @note: only applies if we are in frontend
		if($this->triggerColumnIsFirst && $this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect($id, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}

		/*
			@note:
			- for security, we use a find instead of a get
			- hidden, unpublished and template-access controlled will be rejected
			- $p = $this->wire('pages')->get("id=$id, check_access=1");// @note: this will let hidden pages through, so we use below instead
		 */
		$p = $this->wire('pages')->find("id=$id, limit=1");
		if ($p->count()) {
			
			$p = $p->first();// @note: changing variable to first

			## Trigger Validation ##
			// @access-control: admin pages
			if(!$this->dsUtilities->validateAdminPages($p)) return $results;
			// @access-control: included and excluded templates and pages
			if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($p->template->id, $this->includedExcludedIDs, $triggerColumn, $p->id)) return $results;

			## Trigger Validation passed: good to go to fields ##

			################# - grab fields - #################

			$fields = $p->fields;
			foreach ($fields as $f) {

				/*
					@note:
					- we DON'T need to do validate trigger against included/excludedFields here!
					- this is because, only pages can trigger display of fields
					- this method executes display of fields
					- fields themselves cannot trigger display of fields
					- however, since this method returns its own results (i.e. does not pass through getData())
					- we need to do $results {dependent column} validations to satisfy user-set controls (included/excluded fields)
					- needed here to protect against displaying unwanted fields
					- note that this is not a trigger check but a dependent check, i.e. the column itself check
					- fields as triggers validation is done in getValueData()
				 */

				## Dependent Validation/Filtering in/out ##
				$fieldExtra = array('type' => get_class($f->type), 'name' => $f->name);	

				// @access-control: included and excluded fields, allowed and disallowed fields {for DEPENDENT COLUMN [as set by dev/editor]}
				if(!$this->dsUtilities->validateIncludedExcludedFields($f->id, $this->includedExcludedIDs, $dependentColumn, $fieldExtra)) continue;
				## Dependent Validation passed: good to go ##
				if(!is_null($this->multiLingual)) {// @note: multilingual check
					$label = $f->get("label{$this->multiLingual}");
					if(!$label) $label = $f->get("label|name");
				}
				else $label = $f->get("label|name");

				$results[$p->id . '|' . $f->id] = $label;

			}// end foreach $fields

			################# - end grab fields - #################
			
		}// end if page found

		// @note: update cache if caching is being used in the frontend
		if(count($results) && $this->frontCache) $this->updateSelectsCache($results);

		return $results;

	}

	/**
	 * Fetch the value(s) of a given field for a given page.
	 *
	 * For data-relationship == 6.
	 *
	 * @access private
	 * @param Int $dataPageID the pageID to fetch the requested value from. Used in backend when page loads (i.e. non-ajax request).
	 * @return Array $results Data to populate dependent select options. 
	 *
	 */
	private function getValueData($dataPageID) {

		/* @note:
			- if $dataSource > 0: we are dealing with a named-field
			- else it means it is -2, hence field=>varies
			- in that case, $dataObj will be in the format 'pageID|fieldID' if from Ajax
			- validation dependends on whether the triggerID (dataObj) is a page or a field
			- both can return 'instant' values
			- e.g.: 'field->emailID=>me@me.com' OR 'page->populationID=>10,000,000'
			- in respect to validation, remember we are dealing with either pages or fields as triggers!
		 */

		$results = array();

		$dataObj = $this->dataObj;// @note: to be sanitized below according to whether dataObj is a field or page
		$dataSource = $this->dataSource;// @note: dataSource was sanitized earlier
		$triggerColumn = $this->triggerColumn;		

		#************************* value varies ****************************#

		## Trigger Validation ## 
		// @access-control: cached first column data (if here dataObj will always be from first/initial select)
		// @note: only applies if we are in frontend
		if($this->triggerColumnIsFirst && $this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect((int) $dataObj, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}
		
		// if value=>varies (coming from a field trigger)
		if(0 > $dataSource) {

			$IDs = explode('|', $dataObj);
			$dataObj = (int) $IDs[0];

			if(isset($IDs[1])) {
				$fieldID = (int) $IDs[1];// value coming in from ajax (pageID|fieldID)
			}

			else {
				$fieldID = $dataObj;// value from DB {where we saved the fieldID as this column's trigger}
				$dataObj = (int) $dataPageID;// value from field property {the ID of the page that has this field}
			}

			// check for and grab the field
			$f = $this->wire('fields')->get($fieldID);
			if(!$f) return $results;

			## Trigger Validation ##
			$fieldExtra = array('type' => get_class($f->type), 'name' => $f->name);
			// @access-control: included and excluded fields, allowed and disallowed fields
			if(!$this->dsUtilities->validateIncludedExcludedFields($f->id, $this->includedExcludedIDs, $triggerColumn, $fieldExtra)) return $results;

			## validation passed for FIELD: good to go for FIELD ONLY ## @NOTE: we do page-specific validations below			
			// @note change in dataSource!
			$dataSource = $f->id;

		}// end if negative dataSource (meaning from a field trigger [value: varies])

		#************************* instant values ****************************#

		$id = (int) $dataObj;// id of the page whose field value is to be returned
		/*
			@note:
			- for security, we use a find instead of a get
			- hidden, unpublished and template-access controlled will be rejected
			- $p = $this->wire('pages')->get("id=$id, check_access=1");// @note: this will let hidden pages through, so we use below instead
		 */
		$p = $this->wire('pages')->find("id=$id, limit=1");
		if ($p->count()) {
			
			$p = $p->first();// @note: changing variable to first

			## Trigger Validation ##
			// @access-control: admin pages
			if(!$this->dsUtilities->validateAdminPages($p)) return $results;
			// @access-control: included and excluded templates and pages
			if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages($p->template->id, $this->includedExcludedIDs, $triggerColumn, $p->id)) return $results;
			
			## Trigger Validation passed: good to go ##
			$pages = new PageArray();// @note: need so as to satisfy my WireArray::iterable condition!
			$pages->add($p);
			$results = $this->getData($dataSource, $pages);
		}

		return $results;

	}

	/**
	 * Fetch the fields (propeties) for a given user.
	 *
	 * For data-relationship == 7.
	 *
	 * @access private
	 * @return Array $results Data to populate dependent select options. 
	 *
	 */
	private function getUserPropertyData() {		

		/* @note:
			- this method is only called by a USER trigger!
			- some fields not selectable in <select> or we don't allow them due to security considerations
			- some fields should not be returned even though they are compatible fields (e.g. roles)
			- site editors/devs can set some fields to be excluded from displaying in a 'field:fields' data-relationship:data-source select
			- ditto for included fields
		 */

		$results = array();
		$id = (int) $this->dataObj;// id of the user whose properties(fields) to return
		$triggerColumn = $this->triggerColumn;
		$dependentColumn = $this->dependentColumn;

		## Trigger Validation ## 
		// @access-control: cached first column data (here dataObj will always be from first/initial select)
		// @note: only applies if we are in frontend
		if($this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect($id, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}
		
		// @access-control: included and excluded users (@note: users are actually they are pages too + will be listed in inc/excluded pages textarea)	
		if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages('', $this->includedExcludedIDs, $triggerColumn, $id)) return $results;

		$u = $this->wire('users')->get($id);
		if ($u && $u->id > 0 && !$u->isSuperuser()) {// @note: skip superusers

			//@note: included and excluded templates and viewable/access validation checks don't apply here!
			## Trigger Validation passed: good to go to properties(fields) ##

			################# - grab fields - #################
			
			$fields = $u->fields;
			foreach ($fields as $f) {

				/*
					@note:
					- we DON'T need to do validate trigger against included/excludedFields here!
					- this is because, only users can trigger display of user:properties (fields)
					- this method executes display of user:properties (fields)
					- user:properties themselves cannot trigger display of user:properties
					- however, since this method returns its own results (i.e. does not pass through getData())
					- we need to do $results {dependent column} validations to satisfy user-set controls (included/excluded user:properties(fields))
					- NEEDED HERE TO PROTECT AGAINST DISPLAYING UNWANTED USER:PROPERTIES
					- NOTE THAT THIS IS NOT A TRIGGER CHECK BUT A DEPENDENT CHECK, I.E. THE COLUMN ITSELF CHECK
					- fields as triggers validation is done in getUserValueData()

				 */

				## Dependent Validation/Filtering in/out ##
				$fieldExtra = array('type' => get_class($f->type), 'name' => $f->name);				

				// @access-control: included and excluded fields, allowed and disallowed fields {for DEPENDENT COLUMN [as set by dev/editor]}
				if(!$this->dsUtilities->validateIncludedExcludedFields($f->id, $this->includedExcludedIDs, $dependentColumn, $fieldExtra)) continue;
				
				## Trigger Validation passed: good to go ##
				if(!is_null($this->multiLingual)) {// @note: multilingual check
					$label = $f->get("label{$this->multiLingual}");
					if(!$label) $label = $f->get("label|name");
				}
				else $label = $f->get("label|name");

				$results[$u->id . '|' . $f->id] = $label;// e.g. 1234|45 (userID|fieldID)


			
			}
			
			################# - end grab fields - #################

		}

		// @note: update cache if caching is being used in the frontend
		if(count($results) && $this->frontCache) $this->updateSelectsCache($results);

		return $results;

	}

	/**
	 * Fetch the value(s) of a given field (propety) for a given user.
	 *
	 * For data-relationship == 8.
	 *
	 * @access private
	 * @param Int $dataPageID the userID to fetch the requested value from. Used when page loads (i.e. non-ajax request).
	 * @return Array $results Data to populate dependent select options.
	 *
	 */
	private function getUserValueData($dataPageID) {

		/* @note:
			- if $dataSource > 0: we are dealing with a named-field
			- else it means it is -2, hence field=>varies
			- in that case, $dataObj will be in the format 'userID|fieldID' if from Ajax
			- validation dependends on whether the triggerID (dataObj) is a user (page) or a field
			- both can return 'instant' values
			- e.g.: 'field->emailID=>me@me.com' OR 'user->populationID=>10,000,000'
		 */

		$results = array();

		$dataObj = $this->dataObj;// @note: to be sanitized below according to whether dataObj is a field or user
		$dataSource = $this->dataSource;// @note: dataSource was sanitized earlier
		$triggerColumn = $this->triggerColumn;

		## Trigger Validation ##
		// @access-control: cached first column data (if here dataObj will always be from first/initial select)
		// @note: only applies if we are in frontend
		if($this->triggerColumnIsFirst && $this->frontend) {
			if(!$this->dsUtilities->validateInitialSelect((int) $dataObj, $this->dsName, $this->firstColumnName, $this->dsSettings, $this->frontend)) return $results;
		}

		// if user:value=>varies (coming from a user:property [field] trigger)
		if(0 > $dataSource) {

			$IDs = explode('|', $dataObj);
			$dataObj = (int) $IDs[0];
			
			if(isset($IDs[1])) {
				$fieldID = (int) $IDs[1];// value coming in from ajax (userID|fieldID)
			}

			else {
				$fieldID = $dataObj;// value from DB {where we saved the fieldID as this column's trigger}
				$dataObj = (int) $dataPageID;// value from field property {the ID of the user that has this field}
			}
			
			// check for and grab the source field
			$f = $this->wire('fields')->get($fieldID);
			if(!$f) return $results;

			## Trigger Validation ##
			$fieldExtra = array('type' => get_class($f->type), 'name' => $f->name);
			// @access-control: included and excluded fields, allowed and disallowed fields
			if(!$this->dsUtilities->validateIncludedExcludedFields($f->id, $this->includedExcludedIDs, $triggerColumn, $fieldExtra)) return $results;
			## validation passed for FIELD: good to go for FIELD ONLY ## @NOTE: we do page-specific validations below			
			// @note change in dataSource!
			$dataSource = $f->id;
		}
		
		$id = (int) $dataObj;// id of the user whose property (field) value is to be returned

		## Trigger Validation ##
		// @access-control: included and excluded users
		if(!$this->dsUtilities->validateIncludedExcludedTemplatesPages('', $this->includedExcludedIDs, $triggerColumn, $id)) return $results;

		$u = $this->wire('users')->get($id);
		if ($u && $u->id > 0 && !$u->isSuperuser()) {// @note: skip superusers
			//@note: included and excluded templates and viewable/access validation checks don't apply here!
			## Trigger Validation passed: good to go ##
			$users = new WireArray();// @note: need so as to satisfy my WireArray::iterable condition!
			$users->add($u);
			$results = $this->getData($dataSource, $users);
		}

		return $results;

	}

	
	/**
	 * Fetch data from an external server that returns JSON data.
	 *
	 * For data-relationship == 9. 	 
	 *
	 * @access private
	 * @param Int $dataObj ID of the data source to request data for.
	 * @return Array $results Values to populate dependent select options.
	 *
	 */
	public function getExternalJSONData($dataObj) {		
		// @todo: incomplete; tbd if there's demand for it
		$results = array();
		return $results;
	}

	/**
	 * Fetch data from an 'external' database.
	 *
	 * For data-relationship == 10. 
	 *
	 * @access private
	 * @param Int $dataObj ID of the data source to request data for.
	 * @return Array $results Values to populate dependent select.
	 *
	 */
	public function getExternalTablesData($dataObj) {
		// @todo: incomplete; tbd if there's demand for it
		$results = array();
		return $results;
	}

	/* ######################### - SET VALUES TO CLASS PROPERTIES - ######################### */

	/**
	 * Set values to class properties.
	 *
	 * These properties are used in all get-data methods. 
	 * Mainly settings of a given column of a Dynamic Selects but settings are universal for the Dynamic Selects.
	 * We don't return anything here; just set values to properties.
	 *
	 * @access private
	 * @param Array $columnOptions Settings of a given column of a Dynamic Selects.
	 *
	 */
	private function setOptions(Array $columnOptions) {

		/*
			Sets values to the following class properties:
				1.	$this->dataObj;
				2.	$this->triggerColumn;
				3.	$this->triggerColumnIsFirst;
				4.	$this->dependentColumn;
				5.	$this->dataRelationship;
				6.	$this->dataSource;
				7.	$this->dsName;
				8.	$this->firstColumnName;
				9.	$this->columnNames;	
				10.	$this->frontCache;
				11.	$this->cacheTime;	
				12.	$this->includedExcludedIDs;	
				13.	$this->includedTemplates;
				14.	$this->excludedTemplates;
				15.	$this->includedPages;
				16.	$this->excludedPages;
				17.	$this->dsSettings;
				18.	$this->multiLingual;// @NOTE: set in this method
				19.	$this->dsCacheName;// @NOTE: set in this method

			@note: some of the above only set if in frontend context and/or not in initial render (i.e. ajax-context)

		 */

		// check for multi-lingual environment - save the current user's language		
		$columnOptions['multiLingual'] = $this->dsUtilities->setLanguage();// if no language, returns null
	
		// set values to required class properties
		foreach($columnOptions as $key => $value) $this->$key = $value;

		$this->dsCacheName = $this->dsName . $this->dsUtilities->setLanguageSuffix();

		// set current column's included/excluded templates/pages values
		// @note: needed for use in $this->dsUtilities->buildSelector()
		$allInclTpls = $this->includedExcludedIDs['includedTemplates'];
		$allExclTpls = $this->includedExcludedIDs['excludedTemplates'];
		$allInclPgs = $this->includedExcludedIDs['includedPages'];
		$allExclPgs = $this->includedExcludedIDs['excludedPages'];		
		
		$depCol = $this->dependentColumn;
		$this->includedTemplates = isset($allInclTpls[$depCol]) ? $allInclTpls[$depCol] : array();
		$this->excludedTemplates = isset($allExclTpls[$depCol]) ? $allExclTpls[$depCol] : array();

		$this->includedPages = isset($allInclPgs[$depCol]) ? $allInclPgs[$depCol] : array();
		$this->excludedPages = isset($allExclPgs[$depCol]) ? $allExclPgs[$depCol] : array();
	
	}

	/* ######################### - CACHE OPERATIONS - ######################### */

	/**
	 * Process the cache of the first/initial column in a given Dynamic Selects.
	 *
	 * @param Array $dsSettings Settings of a given Dynamic Selects initial cache we are processing.
	 * @param String $uniqueid Unique ID of the Dynamic Selects.
	 * @param String $firstColumnName Name of the first/initial column in this Dynamic Selects.
	 * @param Array $results Fetched data triggered/generated by the $triggerID for the given dependent select.
	 *
	 */
	public function processInitialDataCache($dsSettings, $uniqueid, $firstColumnName, Array $results) {

		// @note: if cache expired we will auto-create one in DynamicSelectsUtilities::validateInitialSelect()!

		$firstColumnOnly = isset($dsSettings['frontCache']) && (int) $dsSettings['frontCache'] === 1 ? false : true;
		## create or update first column cache ##
		$this->dsName = $this->wire('sanitizer')->pageName($uniqueid);			
		$this->columnNames = $this->dsUtilities->getColumnNames($dsSettings, $firstColumnOnly);
		$this->dependentColumn = $this->dsUtilities->sanitizeFieldName($firstColumnName);// @note: not really a dependent here!
		$this->dataObj = 0;		
		$this->cacheTime = isset($dsSettings['cacheTime']) ? (int) $dsSettings['cacheTime'] : 86400;// defaults to 1 day
		$this->dsCacheName = $this->dsName . $this->dsUtilities->setLanguageSuffix();

		$cache = $this->wire('cache');			
		$cacheName = 'dynamic-selects-' . $this->dsCacheName;
		$cacheData = $cache->get($cacheName);

		// if we got the cache and our first column index...
		// ...update it only if there have been changes
		if(is_array($cacheData) && isset($cacheData[$this->dependentColumn][0])) {
			if($results != $cacheData[$this->dependentColumn][0]) $this->updateSelectsCache($results);
		}
		// no cache found; create one and update it
		else $this->updateSelectsCache($results);

	}

	/**
	 * Fetch cached data of a given dependent select in a specified Dynamic Selects.
	 *
	 * @param String $cacheName Name of the Dynamic Selects whose cache we want to retrieve.
	 * @param String $columnName Name of the dependent select whose specific cache we will be fetching.
	 * @return Array $cacheData Data to populate dependent select.
	 *
	 */
	public function getSelectsCache($cacheName, $columnName) {		
		$cacheName = 'dynamic-selects-' . $this->wire('sanitizer')->pageName($cacheName);
		$cacheData = $this->wire('cache')->get($cacheName);
		$cacheData = is_array($cacheData) && isset($cacheData[$columnName]) ? $cacheData[$columnName] : array();	
		return $cacheData;
	}

	/**
	 * Update cache of a given dependent select in a specified Dynamic Selects.
	 *
	 * @param Array $columnOptions fetched data triggered/generated by the $triggerID for the given dependent select.
	 * @param Int $cacheTime Maximum age of cache before it expires. Obtained from this Dynamic Selects settings.
	 *
	 */
	public function updateSelectsCache(Array $columnOptions) {

		$cache = $this->wire('cache');
		$cacheName = 'dynamic-selects-' . $this->wire('sanitizer')->pageName($this->dsCacheName);
		$cacheData = $cache->get($cacheName);

		// if cache doesn't exist (e.g. recently expired), create one
		if(!is_array($cacheData)) {
				$this->createSelectsCache($this->columnNames);// 'empty' cache with only column names
				$cacheData = $cache->get($cacheName);				
		}

		$columnName = $this->dsUtilities->sanitizeFieldName($this->dependentColumn);// enforce lower case		
		// update the cache array at the given index
		// $columnOptions is an array with $optionValue => $optionLabel
		$cacheData[$columnName][$this->dataObj] = $columnOptions;

		$cache->save($cacheName, $cacheData, $this->cacheTime);// update (save) the cache

	}

	/**
	 * Create 'empty' initial cache for a Dynamic Selects that will be caching data.
	 *
	 * This consists of associative array where $keys are the Dynamic Selects columns and $values are empty.
	 *
	 * @param Array $columnNames Array of Names of the columns in this Dynamic Selects.
	 *
	 */
	public function createSelectsCache(Array $columnNames) {
		$cacheName = 'dynamic-selects-' . $this->wire('sanitizer')->pageName($this->dsCacheName);
		$this->wire('cache')->save($cacheName, $columnNames, $this->cacheTime);// save the cache
	}

	/**
	 * Delete given Dynamic Selects cache.	 
	 *
	 * @param Array $dsName Name of the Dynamic Selects to delete.
	 *
	 */
	public function deleteSelectsCache($dsName) {
		$cacheName = 'dynamic-selects-' . $this->wire('sanitizer')->pageName($dsName) . $this->dsUtilities->setLanguageSuffix();
		$this->wire('cache')->delete($cacheName);// delete the cache
	}

}