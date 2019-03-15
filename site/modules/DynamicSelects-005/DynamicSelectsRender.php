<?php

/**
* Dynamic Selects: Render
*
* This file forms part of the Dynamic Selects Suite.
* Renders markup for output in various places in the module.
* For both backend and frontend use.
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

class DynamicSelectsRender extends ProcessDynamicSelects {

	/**
	* Set some key properties for use throughout the class.
	*
	* @access public
	*
	*/
	public function __construct() {
		parent::__construct();
		$this->dsUtilities = new DynamicSelectsUtilities();
		$this->dsActions = new DynamicSelectsActions();
	}


/* ######################### - MARKUP RENDERERS - ######################### */


	/* ######################### - RENDER DYNAMIC SELECTS MARKUP - ######################### */


	/**
	 * Render input forms for ProcessDynamicSelects module landing page.
	 *
	 * @access public
	 * @param String $cookieName Name of cookie for current user to remember limit of items to show on dashboard.
	 * @param Int $showLimit Number of items to show per page in the dashboard.
	 * @return String $form Rendered form markup showing list of dynamic selects.
	 *
	 */
	public function renderDynamicSelectsDashboard($cookieName = '', $showLimit = '') {

		// create a new form
		$form = $this->wire('modules')->get('InputfieldForm'); 
		$form->attr('id', 'dynamic-selects'); 
		$form->action = './';
		$form->method = 'post';

		// create a new wrapper
		$w = new InputfieldWrapper;
	
		// quick 'dynamic selects' create code
		$m = $this->wire('modules')->get('InputfieldMarkup');
		$m->label = $this->_('Add Selects');		
		$m->description = $this->_('One dynamic select (parent) title per line.');
		$m->collapsed = Inputfield::collapsedYes;

		$txa = $this->wire('modules')->get('InputfieldTextarea');
		$txa->attr('name', 'ds_create');
		$txa->skipLabel = Inputfield::skipLabelHeader;// we don't want a label displayed here

		$m->add($txa);

		// submit button to save quick 'dynamic selects' create [save unpublished!]
		$s = $this->wire('modules')->get('InputfieldSubmit'); 
		$s->attr('id+name', 'ds_create_unpublished_btn'); 
		$s->attr('value', $this->_('Save Unpublished'));

		$m->add($s);

		// submit button to save AND publish quick 'dynamic selects' create
		$s = $this->wire('modules')->get('InputfieldSubmit'); 
		$s->attr('id+name', 'ds_create_published_btn'); 
		$s->attr('value', $this->_('Publish'));
		
		$m->add($s);

		$w->add($m);

		// ...end - quick 'dynamic selects' create

		// create an inputfield markup: will hold list of dynamic selects table
		$m = $this->wire('modules')->get('InputfieldMarkup');
			
		// create a new table: for dynamic selects
		$t = $this->wire('modules')->get('MarkupAdminDataTable');
		$t->setEncodeEntities(false);
		$t->setClass('ds_table');
		
		// set header rows
		$t->headerRow(array(
			'<input type="checkbox" class="toggle_all">',
			$this->_('Title'),
			$this->_('Number of Columns'),
			$this->_('Published'),
			$this->_('Locked'),
			$this->_('Frontend Access'),
			$this->_('Cached'),
			$this->_('Modified'),
		));

		// Determine number of dynamic selects to show per page in dynamic selects table. Default = 10 {see $this->showLimit}
		
		// if user selects a limit ($input->post->show_limit)...
		//... we set that as the limit and set a cookie {see $this->cookieName} with that value to save state for session.
		if ($this->input->post->show_limit) {
				$showLimit = $this->input->post->show_limit;
				setcookie($cookieName, $showLimit , 0, '/');
		}

		// if no custom limit selected but there is a cookie set, we use the cookie value
		elseif ($this->input->cookie[$cookieName]) {
				$showLimit = (int) $this->input->cookie[$cookieName];
		}

		// grab a limited number of dynamic selects (excluding any in the trash) to show in dynamic selects table. Limit is determined as shown above
		$dynamicSelects = $this->wire('pages')->find("template=dynamic-selects, include=all, sort=title, limit={$showLimit}, parent!=7");

		if($dynamicSelects->count()) {

			foreach ($dynamicSelects as $ds) {

					// count number of select items in each 'dynamic select'
					$dsSettingsJSON = $ds->ds_settings;
					$dsItems = $dsSettingsJSON ? json_decode($dsSettingsJSON, true) : array();
					$dsItemsCnt = isset($dsItems['numCols']) ? $dsItems['numCols'] : 0;
					
					// check if dynamic select is published or not
					$ds->is(Page::statusUnpublished) ? $pubStatus = '<span class="highlight">' . $this->_('No') . '</span>' : $pubStatus = $this->_('Yes');
					// check if dynamic selct is locked for editing
					$ds->is(Page::statusLocked) ? $editStatus = '<span class="highlight">' . $this->_('Yes') . '</span>' : $editStatus = $this->_('No');
					// frontend view access
					$frontAccess = $this->dsUtilities->frontAccessStatus($dsItems);
					// frontend cached data status (returns human readable time period - years....seconds)
					$frontCache = $this->dsUtilities->cacheStatus($dsItems);// @todo. Do we need to be this specific?
					// when was the dynamic select last modified
					$modified = wireRelativeTimeStr($ds->modified);

					// set table rows
					$dsTable = array(
							"<input type='checkbox' name='ds_action[]' value='{$ds->id}' class='toggle'>",// disabled sorting on this in .js file
							"<a href='{$this->wire('page')->url}edit/?id={$ds->id}'>$ds->title</a>",
							$dsItemsCnt,// count of selects in this 'dynamic select'
							$pubStatus,// published status
							$editStatus,// locked status
							$frontAccess,// frontend view/access status
							$frontCache,// frontend cache data status
							$modified,					
					);
					
					// render the table rows with variables set above
					$t->row($dsTable);

			}// end foreach $dynamicSelects as $ds
		
		}// end if count $dynamicSelects

		
		// prepare values for 'Show XX Items', i.e. number of dynamic selects to show per page in dynamic selects table
		$limitSelect = '';
		$limitSelect .= '<span class="limit-select">' . $this->_('Show ') . '<select id="limit" name="show_limit">';

		$limits = array( '', 5, 10, 15, 25, 50, 75, 100);

		foreach ($limits as $limit) {
			$limitSelect .='<option value="' . $limit . '"' . ($showLimit == $limit ? 'selected="selected"':'') . '>' . $limit . '</option>';
		}

		$limitSelect .= '</select>'. $this->_(' Items') . '</span>';

		// display a headline indicating quantities. We'll add this to dynamic selects table
		$start = $dynamicSelects->getStart()+1;
		$end = $start + count($dynamicSelects)-1;
		$total = $dynamicSelects->getTotal();

		if($total) $dynamicSelectsCount = "<h4>" . sprintf(__('Selects %1$d to %2$d of %3$d'), $start, $end, $total) . "</h4>";

		// add a description to dynamic selects table {dynamicSelectsCount, limitSelect and instruction OR no dynamic selects found status}
		$m->description = $total == 0 ? $this->_('No dynamic selects found.') : $dynamicSelectsCount . $this->_('Click on a title to edit the Dynamic Select.') . $limitSelect;
		$m->textFormat = Inputfield::textFormatNone;// make sure ProcessWire renders the HTML
		// table notes
		$m->notes = $this->_('Note: (i) Number of columns: Shows number of individual selects within a Dynamic Selects. At least 2 selects are needed for the Dynamic Selects to work; (ii) Frontend Access: Who can view a Dynamic Selects.');

		//$currentUrl = $this->wire('page')->url . $this->wire('input')->urlSegmentsStr."/";// get the url segment string.
		$currentUrl = $this->wire('page')->url . $this->wire('input')->urlSegmentsStr;// get the url segment string.
		$pagination = $dynamicSelects->renderPager(array('baseUrl' => $currentUrl));// just foolproofing

		$m->attr('value', $pagination . $t->render() . $pagination);// wrap our table with pagination

		$w->add($m);

		/*## ACTIONS ##*/

		// dynamic selects bulk actions panel
		$actions = array(
							'publish' => $this->_('Publish'),
							'unpublish' => $this->_('Unpublish'),
							'lock' => $this->_('Lock'),
							'unlock' => $this->_('Unlock'),
							'trash' => $this->_('Trash'),
							'delete' => $this->_('Delete'),

		);

		// @access-control: publish/unpublish
		// if in effect, check if user has permission to publish
		if($this->noPublish) {
			unset($actions['publish']);
			unset($actions['unpublish']);
		}

		// @access-control: lock/unlock
		// if in effect, check if user has permission to lock
		if($this->noLock) {
			unset($actions['lock']);
			unset($actions['unlock']);
		}

		// @access-control: trash/delete
		// if in effect, check if user has permission to lock
		if($this->noDelete) {
			unset($actions['trash']);
			unset($actions['delete']);
		}

		// only show actions if dynamic selects found AND if we have not unset ALL $actions
		if($total !=0 && count($actions)) {			

			$modules = $this->wire('modules');

			$m = $modules->get('InputfieldMarkup');
			$m->label = $this->_('Actions');
			$m->collapsed = 1;
			$m->description = $this->_('Choose an Action to be applied to the selected Dynamic Selects.');
			
			$is = $modules->get('InputfieldSelect');
			$is->label = $this->_('Action');
			$is->attr('name+id', 'ds_action_select');
			$is->addOptions($actions);
			
			$s = $modules->get('InputfieldSubmit'); 
			$s->attr('id+name', 'ds_bulk_actions_btn');
			$s->class .= " ds_action";// add a custom class to this submit button
			$s->attr('value', $this->_('Apply')); 
			
			$m->add($is);// add the input select
			$m->add($s);// add the apply button

			$w->add($m);

		}

		$form->add($w);
		
		$post = $this->wire('input')->post;

		// @note: methods in DynamicSelectsActions.php do the saving
		// send input->post values to the Method save();
		// creating new dynamic selects
		if($post->ds_create_unpublished_btn || $post->ds_create_published_btn) $this->save($form, 1);
		// applying an action to multiple dynamic selects (bulk actions)
		elseif($post->ds_bulk_actions_btn) $this->save($form, 2);
		
		// render the final form
		return $form->render();

	}

	/**
	 * Render input forms for editing a single dynamic select.
	 *
	 * @access public
	 * @param String $tabID ID for the tabs in edit-single-dynamic-selects mode.
	 * @return Strung $formm Rendered form markup with inputs for saving/displaying ds column settings.
	 *
	 */
	public function renderDynamicSelectsSingleEdit($tabID) {

		$modules = $this->wire('modules');

		$post = $this->wire('input')->post;
		$form = $modules->get('InputfieldForm');

		// get the dynamic selects (page) we are editing
		$dsID = (int) $this->input->get->id;
		$ds = $this->wire('pages')->get("id=$dsID, include=all, parent!=7");// only get non-trashed pages!

		// if we found a valid dynamic selects page
		if($ds->id) {

			// check if dynamic select is locked for editing
			$ds->is(Page::statusLocked) ? $locked = 1 : $locked = '';
			$editStatusNote = $locked ? $this->_(' (locked for edits)') : '';

			// add a breadcrumb that returns to our main page @todo - don't show non-superusers breadcrumbs?
			$this->breadcrumbs->add(new Breadcrumb('../', $this->wire('page')->title));
			$this->headline(sprintf(__('Edit select: %s'), $ds->title) . $editStatusNote); // headline when editing a dynamic select

			$form->attr('id', 'DynamicSelectsEdit'); 
			$form->action = './';
			$form->method = 'post';


			############################################ - prepare tabs used in executeEdit() - ############################################			

			// fetch this dynamic selects' settings. These are saved as a JSON string
			$dsSettingsJSON = $ds->ds_settings;
			$dsSettingsArray = $dsSettingsJSON ? json_decode($dsSettingsJSON, true) : array();

			// @note: new WireData() to hold our array in order to access as object properties
			// also helps avoid isset and PHP notices about missing properties
			$dsSettings = new WireData();
			$dsSettings->setArray($dsSettingsArray);// set an array of properties at once
						
			$form->add($this->buildTab($tabID, $dsSettings));// 1st Tab: Build dynamic selects
			$form->add( $this->settingsTab($tabID, $ds, $dsSettings));// 2nd Tab: Other settings
			if(!$this->noDelete && !$locked) $form->add($this->deleteTab($tabID, $ds->id));// 3rd Tab: Delete @note: only if they can delete and/or not locked for edits

			/***************** Add hidden inputs for control *****************/

			$h = $modules->get('InputfieldHidden'); 
			$h->attr('name', 'ds_id'); 
			$h->attr('value', $dsID); 
			$form->add($h);

			$h = $modules->get('InputfieldHidden'); 
			$h->attr('name', 'ds_old_name'); 
			$h->attr('value', $ds->name); 
			$form->add($h);

			/***************** Add input buttons for use in all tabs *****************/			 

			$s = $modules->get('InputfieldSubmit'); 
			$s->class .= ' head_button_clone';
			$s->attr('id+name', 'ds_save');
			$s->attr('value', $this->_('Save')); 
			$form->add($s); 

			$s = $modules->get('InputfieldSubmit'); 
			$s->attr('id+name', 'ds_save_exit'); 
			$s->class .= " ui-priority-secondary";
			$s->attr('value', $this->_('Save & Exit')); 
			$form->add($s);

			
			return $form->render();

		}// end if $ds->id

		############################################ - if input->post - ############################################			

		// saving single dynamic select
		elseif($post->ds_save || $post->ds_save_exit) $this->save($form, 3);
		// deleting single dynamic select
		elseif($post->ds_delete) $this->save($form, 4);
		// else invalid dynamic select ID or no ID provided (e.g. /edit/)
		else $this->wire('session')->redirect($this->wire('page')->url);// redirect to landing page

	}

	/**
	 * Render table with inputs for column settings.
	 *
	 * @access public
	 * @param Array $columns Settings of a given Dynamic Selects.
	 * @return String $m Rendered table markup with inputs for saving/displaying the Dynamic Selects column settings.
	 *
	 */
	public function renderTable($columns) {

		/*###########################

			$columns Array structure:
				0=>name,
				1=label,
				2=data-trigger,
				3=data-relationship,
				4=data-source,

		###########################*/
	
		$out = '';
		$confirmDBChanges = $this->_('Confirm Delete Columns');
		$save = '<strong>' . $this->_("'Save'") . '</strong>';
		$cancel = '<strong>' . $this->_("'Cancel'") . '</strong>';

		$confirmDeleteDBColumnsText = sprintf(__('The following columns will be permanently deleted from the database schema resulting in data loss. Please confirm this by clicking  %1$s. Any other changed field settings will also be saved. If you do not want to proceed with any of these changes click %2$s to discard the action.'), $save, $cancel);
		
		// @note: Will only kick-in in FieldtypeDynamicSelects
		$confirmDeleteDBColumnsDialog = '<div id="ds_db_column_delete_confirm" title="'. $confirmDBChanges .'" style="display:none; padding:20px 20px 5px 20px;">' .
  											'<p><i class="fa fa-lg fa-exclamation-triangle"></i>' . $confirmDeleteDBColumnsText . '</p>' .
										'</div>';

		$t = $this->wire('modules')->get('MarkupAdminDataTable');
		$t->setEncodeEntities(false);
		$t->setClass('sortable');
		$t->setID('ds_settings_table');

		// set header rows
		$settingsTableHeaders = array(
			"<i class='fa fa-arrows'></i>",
			$this->_('Name'),
			$this->_('Label'),
			$this->_('Trigger'),
			$this->_('Relationship'),
			$this->_('Data Source'),
			"<a title='Delete All' href='#' class='ds_delete'><span class='ui-icon ui-icon-trash'></span></a>",
		);

		$t->headerRow($settingsTableHeaders);

		$i = 1;

		foreach ($columns as $name => $settings) {

			$label = isset($settings[0]) ? $settings[0] : '';
			$trigger = isset($settings[1]) ? $settings[1] : 0;
			$relationship = isset($settings[2]) ? $settings[2] : 0;
			$dataSource = isset($settings[3]) ? $settings[3] : '';

			$displaySelects = $this->renderDataSourceSelects($dataSource);
			$relationshipSelects = $this->renderRelationshipsSelects($relationship);

			//$inputCSS = "style='font-size:95%; margin-bottom:5px;'";
			$style = "style='width:100%;'";

			// set table rows
			$settingsTable = array(
									array($i,'move'),
									"<input type='hidden' name='ds_old_name[]' value='$name'><input type='text' name='ds_name[]' value='$name' class='ds_required' $style>",
									"<input type='text' name='ds_label[]' value='$label' $style>",// label
									"<input type='text' name='ds_trigger[]' value='$trigger' class='ds_trigger ds_required' $style>",// trigger
									$relationshipSelects,// ds_relationship
									$displaySelects,// ds_datasource
									"<a href='#' class='ds_delete ui-helper-clearfix'><span class='ui-icon ui-icon-trash'></span></a>
									<input class='ds_delete' type='hidden' name='ds_delete[]' value='0'>",
			
			);
			
			$t->row($settingsTable, array('class'=>'ds_row'));

			$i++;
		
		}// end foreach

		$addRow = "<a class='addcolumn' href='#'>" . $this->_('add column') . "</a>";
		$addRow .= "<input type='hidden' id='ds_confirm' value='0'>";

		$m = $this->wire('modules')->get('InputfieldMarkup');
		$m->label = 'Dynamic selects columns settings';
		$m->notes = $this->_('For Name use only lowercase: _a-z0-9; \'data\', \'pages_id\', \'sort\', \'extradata\' and \'columns\' are reserved words and should not be used for Names; Name and Trigger cannot be empty; First column Trigger must be 0 (zero), Relationship must be \'None\' and Data Source \'Initial\'; For other columns, Trigger must be the exact Name of a previous column. A dependent dropdown cannot come before its trigger.');
		$m->description = $addRow;
		$m->textFormat = Inputfield::textFormatNone;// make sure ProcessWire renders the HTML
		$m->attr('value', $t->render() . $confirmDeleteDBColumnsDialog);

		return $m;

	}
	
	/**
	 * Render a select list of all potential data relationships.
	 *
	 * We use this to select the 'relationship' of one column to its trigger.
	 * This is used when setting up dynamic selects.
	 *
	 * @access private
	 * @param Int $relationshipID Array index to match saved option in relationships select.
	 * @return String $out Selects for choosing property to show for selected value.
	 *
	 */
	private function renderRelationshipsSelects($relationshipID = '') {

		$relationships = $this->dsUtilities->relationships();

		$out = '<select name="ds_relationship[]" style="width:100%;" class="ds_relationship">';
		//$out .=  '<option selected disabled hidden>Choose here</option>';
		$out .=  '<option selected disabled>' . $this->_('Please select') . '</option>';
		foreach ($relationships as $id => $value) {
			$cssClass = $this->dsUtilities->relationshipCSS($id);
			$selected = $id == (int) $relationshipID ? 'selected' : '';
			$out .= '<option value="'. $id .'" '. $selected . ' class="' . $cssClass . '">' . $value . '</option>';
		}
		
		$out .= '</select>';
		
		return $out;

	}

	/**
	 * Render a select list of all allowed fields.
	 *
	 * We use this to select the 'property' of a page/user to display.
	 * For instance show the title  (or the email field, etc).
	 * This is used when setting up dynamic selects.
	 *
	 * @access private
	 * @param Int $selectedID Array index to match saved option in data sources select.
	 * @return String $out Selects for choosing property to show for selected value.
	 *
	 */
	private function renderDataSourceSelects($selectedID = '') {

		// some fields not selectable in <select> or we don't allow them for security
		$allowedFieldTypes = $this->dsUtilities->allowedFieldTypes();
		// we don't need to return these fields even though they are compatible fields
		$disallowedFields = $this->dsUtilities->disallowedFields();

		// @note: here and below CSS classes to match data-source to data-relatonship
		
		$out = '<select name="ds_datasource[]" style="width:100%;" class="ds_datasource">';
		//$out .=  '<option selected disabled hidden>Choose here</option>';
		//$out .=  '<option selected disabled>' . $this->_('Please select') . '</option>';
		$cssClass = $this->dsUtilities->dataSourceCSS(0);
		// first dropdown data-source (i.e. initial)
		$out .= '<option value="0" class="' . $cssClass .'">' . $this->_('Initial') . '</option>';

		$cssClass = $this->dsUtilities->dataSourceCSS(1);
		// named-field data-sources
		foreach ($this->wire('fields') as $f) {
			//if (!in_array(get_class($f->type), $allowedFieldTypes)) continue;
			// @note: using strrchr to account for namespaced classes
			$baseClass = substr(strrchr('\\'.get_class($f->type), '\\'), 1);
			if (!in_array($baseClass, $allowedFieldTypes)) continue;
			if(in_array($f->name, $disallowedFields)) continue;
			// for matching 'Group' relationships with ONLY PAGEFIELDS
			$groupCssClass = $f->type == 'FieldtypePage' ? ' ' . $this->dsUtilities->dataSourceCSS(2) : '';
			$selected = $f->id == (int) $selectedID ? "selected" : '';

			// get multilingual label if applicable
			$languageID = $this->dsUtilities->setLanguage();// if no language, returns null
			if(!is_null($languageID)) {// @note: multilingual check
					$label = $f->get("label{$languageID}");
					if(!$label) $label = $f->get("label|name");
				}
			else $label = $f->get("label|name");
			
			//$out .= '<option value="'. $f->id .'" '. $selected . ' class="' . $cssClass . $groupCssClass .'">' . ($f->label ? $f->label : $f->name) . '</option>';
			$out .= '<option value="'. $f->id .'" '. $selected . ' class="' . $cssClass . $groupCssClass .'">' . $label . '</option>';
		}

		// preset data-sources
		$extraOptions = array(
								3 => array($this->_('Fields'), -1),
								4 => array($this->_('Varies'), -2),
								5 => array($this->_('User: Properties'), -3),
								6 => array($this->_('User: Varies'), -4),

		);

		foreach ($extraOptions as $key => $value) {
			$cssClass = $this->dsUtilities->dataSourceCSS($key);
			$selected = $value[1] == (int) $selectedID ? "selected" : '';
			$out .= '<option value="'. $value[1] .'" '. $selected . ' class="' . $cssClass . '">' . $value[0] . '</option>';
		}
		
		$out .= '</select>';
		
		return $out;

	}	

	/**
	 * Render the ajax-driven cascading/chained selects.
	 *
	 * Use in MarkupDynamicSelects and InputfieldDynamicSelects.
	 *
	 * @access public
	 * @param Array $dsSettings currently saved settings for the Dynamic Select. For Field this will be value of $field->data.
	 * @param Object $values In InputfieldDynamicSelects, these are the saved values of the FieldtypeDynamicSelects field.
	 * @param String $uniqueid Used to distinguish between groups of dynamic selects on one page.
	 * @param Bool $frontend Whether this selects are being used in the front or backend. We always assume in the frontend for security.
	 * @return String $out Render dynamic selects output including initial Data + saved values as applicable.
	 *
	 */
	public function renderSelects($dsSettings, $values, $uniqueid = '', $frontend = true) {

		$results = array();
		// @note: for checkDataRelationship()
		$columnOptions = array();

		$ds = $values;
		$dataObj = '';// @note: this is the column trigger!
		#$dataRelationship = '';// @note: not needed here
		#$dataSource = '';/ @note: -ditto-
		$columnTrigger = '';// @NOTE: @field settings level! not the specific one for each page
		
		// check if setting to hide empty selects in effect
		$hideEmptySelects = isset($dsSettings['hideEmptySelects']) ? $dsSettings['hideEmptySelects'] : 0;
		$emptyClass = '';

		// grab any data IDs to be filter in/out
		$columnOptions['includedExcludedIDs'] = $this->dsUtilities->filterByIDs($dsSettings);
		
		################

		$columnSettings = $dsSettings['columns'];

		// for first/initial dynamic selects column 
		$firstColumnFindCode = isset($dsSettings['firstColumnFindCode']) ? trim($dsSettings['firstColumnFindCode']) : '';// supercedes selector below
		$firstColumnSelector = isset($dsSettings['firstColumnSelector']) ? trim($dsSettings['firstColumnSelector']) : '';// used if code above empty

		if(!$firstColumnFindCode && !$firstColumnSelector) return null;

		// @note...could have used $ds here too
		$extraData = count($values->extraData) ? $values->extraData : array();

		## cache ##
		$frontCache = 0;// @note: need to save to variable first since reused below
		$columnOptions['frontCache'] = $frontCache;
		if($frontend) {
			if(isset($dsSettings['frontCache']) && (int) $dsSettings['frontCache'] === 1) $frontCache = (int) $dsSettings['frontCache'];
			$columnOptions['frontCache'] = $frontCache;
		}		
		
		// build the selects
		$out = '';
		// @note: $uniqueid needed to distinguish between multiple instances of Dynamic Selects on a single page
		$out .= "\n\t<div class='ds' id='" . $uniqueid . "'>";
		$dataReset = 1;

		if(!$frontend) {
			$uniqueid = explode('|', $uniqueid);
			$uniqueid = $uniqueid[0];
		}

		foreach ($columnSettings as $columnName => $columnValues) {

			$results = array();

			## get selects properties ##
			$columnLabel = $columnValues[0];
			$columnTrigger = $columnValues[1];// @note: need to save to variable first since reused below
			$columnOptions['triggerColumn'] = $columnTrigger;
			$columnOptions['dependentColumn'] = $columnName;
			$columnOptions['dsName'] = $uniqueid;
			$columnOptions['frontend'] = $frontend;

			$columnRelationship = $columnValues[2];// @note: need to save to variable first since reused below
			$columnOptions['dataRelationship'] = $columnRelationship;
			$columnOptions['dataSource'] = $columnValues[3];

			$dataObj = $ds->{"{$columnName}TriggerID"};// @note: need to save to variable first since reused below
			$columnOptions['dataObj'] = $dataObj;
			#$dataRelationship = $ds->{"{$columnName}RelationshipID"};// @note: not needed here
			#$dataSource = $ds->{"{$columnName}SourceID"};// @note: -ditto-
			$dataID = $ds->{"{$columnName}ID"};// page|template|field|user ID
			
			// @note: page|user ID ONLY SPECIFIC TO value=>varies and user=>varies RELATIONSHIPS for field=>fields and user:property=>user:properties TRIGGERS
			$columnOptions['dataPageID'] = $ds->{"{$columnName}PageID"};

			// @note: for ID uniqueness when we have multiple selects and user is reusing column names			
			$id = $uniqueid . "-" . $columnName;

			$dataCache = $id . $this->dsUtilities->setLanguageSuffix();;

			// spinner
			$spinner = "\n\t\t\t<span id='" . $id . "_spinner' class='ds_spinner'>" .
							"<i class='fa fa-lg fa-spin fa-spinner ds_spinner'></i>" . 
						"</span>";

			$out .= "\n\t\t<label class='ds$emptyClass' for='" . $id . "'>" . $columnLabel;
			
			$out .= "\n\t\t\t<select " . 
							
							"id='" . $id . "' " .
							"class='ds' " .
							"name='" . $columnName . "' " .// @todo: still clashing if multiple ds on page with similarly named columns!
							"data-trigger='" . $uniqueid . "-" . $columnTrigger . "' ".
							"data-reset='" . $dataReset . "' " .// for JS on-change trigger, reset dependents
							"data-hide='" . $hideEmptySelects . "'" . // for JS; hide/show selects if empty/populated
							"data-cache='" . $dataCache . "'" . // for JS; for cache identification @note: multilingual sensitive
					">";
			// if setting to hide empty selects in effect
			// set to hide select whose trigger select has no saved value
			if($hideEmptySelects) $emptyClass = $dataID ? '' : ' ds_empty';
			
			## grab selects <option>s data ##
			// on first select/column
			if($columnRelationship == 0) $results = $this->dsActions->getInitialData($dsSettings, $uniqueid, $columnName, $frontend);
			elseif(!$frontend) {
				$results = $this->dsActions->checkDataRelationship($columnOptions);
				if($columnRelationship == 5 || $columnRelationship == 7) $dataID = $dataObj . '|' . $dataID;// pageID|fieldID OR userID|fieldID
				elseif($columnRelationship == 6 || $columnRelationship == 8) {
						$extraFileName = isset($extraData[$columnName]) ? $extraData[$columnName] : '';
						$dataID .= '|' . $extraFileName;// pageID|filename.ext => e.g. 1234|my_file.ext
				}
			}// end if backend
			
			## build the <option>s for the <select> ##
			$out .= $this->renderOptions($results, $dataID);
			$out .= "\n\t\t\t</select>". $spinner . "\n\t\t</label>";

			// @note: we do not cache INITIAL/FIRST SELECT (locally [client-side]). We do so in WireCache [server-side]) though..
			// ...but only for security checks for frontend use.
			if($frontCache && $dataReset !== 1) $out .= $this->renderLocalCache($uniqueid, $columnName);

			$dataReset++;

		}// end foreach

		$out .= "\n\t</div>\n";

		return $out;

	}

	/**
	 * Render the <options> for each <select> in Dynamic Selects.
	 *
	 * @access private
	 * @param Array $results data of $key=>$value pairs to populate dynamic selects.
	 * @param Int|Mixed $selectedOption ID of the selected (saved) option for the specified dynamic select.
	 * @return String $out <option>s for the given dynamic select.
	 *
	 */
	private function renderOptions($results, $selectedOption = '') {

		$out = '';
		$out .=  "\n\t\t\t\t<option value='0'>" . $this->_('Please select') . "</option>";
	
		if(!count($results)) return $out;// if no results found, nothing to do, return
		foreach ($results as $key => $value) {
			$selected = $key == $selectedOption ? "selected" : '';// @note: sanitized earlier
			$out .= "\n\t\t\t\t<option value='". $key ."' ". $selected .">" . $value . "</option>";
		}
		
		return $out;

	}

	/**
	 * Render (css-hidden) unordered list to be used as locale cache for successfully fetched results.
	 *
	 * Server-side: Populate list with results.
	 * Client-side: Use JS to populate list after any successful ajax-request (as there will be no page reload).
	 * Only kicks-in when cache is enabled for a Dynamic Selects.
	 *
	 * @access private
	 * @param String $dsName the Dynamic Selects we are dealing with.
	 * @param String $columnName dependent select whose cached options to build.
	 * @return String $out hidden <ul><li>s for the given dynamic select to act as local cache.
	 *
	 */
	private function renderLocalCache($dsName, $columnName) {

		$languageSuffix = $this->dsUtilities->setLanguageSuffix();

		$out = '';
		// @note: hidden element on page to act as local caceh
		#$out.= "<ul class='ds_cached' data-select-id='" . $dsName . "-" . $columnName . "'>" . 
		$out.= "<ul class='ds_cached' data-select-cache='" . $dsName . "-" . $columnName  . $languageSuffix . "'>" . 
		 			"<li data-select-option-trigger='0' data-select-option-value='0'></li>";// @note: just an empty placeholder
		
		/* if we have cached results of the given dependent select, grab them
		 
			example array expected

			 [1179] => Array// $triggerID
	                (
	                    [1193] => Jaws// $value => $label (to eventually populate <option value=$value>$label</option> from this cache)
	                    [1201] => Minority Report
	                    [1202] => Close Encounters
	                )

	        [1181] => Array
	                (
	                    [1199] => Star Trek
	                )
		*/

		$dsCacheName = $dsName . $languageSuffix;
		$cachedResults = $this->dsActions->getSelectsCache($dsCacheName, $columnName);// 2-D array

		if(is_array($cachedResults) && count($cachedResults)) {
			foreach ($cachedResults as $triggerID => $options) {
				foreach ($options as $value => $label) {
					$out .= '<li data-select-option-trigger="' . $triggerID . '" data-select-option-value="' . $value . '"">' . $label . '</li>';
				}				
			}
		}

		$out .= '</ul>';

		return $out;

	}

	############################ RENDER DYNAMIC SELECTS COLUMNS SETTINGS INPUT MARKUP ############################


	/**
	 * Render the radio input for selecting the type of First column data source.
	 *
	 * Could be templates, pages or users.
	 *
	 * @access public
	 * @param Int $value Current saved value.
	 * @return String $out Input markup.
	 *
	 */
	public function renderFirstColumnDataSourceInput($value = 1) {

		// radios: initial/first dynamic select column settings
		// determine whether initial column will list pages, templates OR users		
		$f = $this->wire('modules')->get('InputfieldRadios');
		$f->attr('name', 'firstColumn');
		$f->attr('value', $value ? $value : 1);
		$f->label =  $this->_('First column data source');
		$f->description = $this->_('Set the data source for the first column.');
		$f->notes = $this->_('A selector or custom PHP code that matches your selection here has to entered below to return data for the first column (first dropdown select).');

		$radioOptions = array (
						 1 => __('Pages'),
						 2 => __('Templates'),
						 3 => __('Users'),
	 	);

		$f->addOptions($radioOptions);

		return $f;
		
	}

	/**
	 * Render the text input for specifying whether to hide empty selects.
	 *
	 * @access public
	 * @param String $value Current saved value.
	 * @return String $out Input markup.
	 *
	 */
	public function renderFirstColumnSelectorInput($value = '') {

		// text: selector for finding 'first column' pages|templates|users
		$f = $this->wire('modules')->get("InputfieldText");
		$f->attr('name', 'firstColumnSelector');
		$f->attr('value', $value);
		$f->label = $this->_('First column selector');
		$f->collapsed = 5;// collapsed when populated
		$f->description = $this->_('Enter a valid ProcessWire selector to find pages|templates|users for the first column (first dropdown select).');
		$f->notes = $this->_('This must match the data source specified in the radios above. Example selector: parent=/products/, template=product, sort=name');

		return $f;
		
	}

	/**
	 * Render the textarea input for specifying whether to hide empty selects.
	 *
	 * @access public
	 * @param String $value Current saved value.
	 * @return String $out Input markup.
	 *
	 */
	public function renderFirstColumnFindCodeInput($value = '') {

		// textarea: input for custom php code for finding pages|templates|users to be used as data source for the first dynamic select column		
		$f = $this->wire('modules')->get("InputfieldTextarea");
		$f->attr('name', 'firstColumnFindCode');
		$f->attr('value', $value);
		$f->label = $this->_('First column custom PHP code');
		$f->collapsed = 1;// always collapsed. (if want collapsed when populated = 5)
		$f->description = $this->_('Enter valid PHP code to find pages|templates|users for the first column (first dropdown select). This statement has access to the $page, $pages, $templates and $users API variables, where $page refers to the page being edited. The snippet should only return a WireArray derived object (e.g. a PageArray or group of templates). This overrides the above First Column selector.');
		$f->notes = $this->_('This must match the data source specified in the radios above. Example PHP code: return $page->children("limit=10"); OR return $templates->find("selector");');

		return $f;
		
	}

	/**
	 * Render the textareas input for specifying whether to hide empty selects.
	 *
	 * @access public
	 * @param String $value Current saved value.
	 * @param Int $mode Determines which include/exclude we are dealing with (templates, pages or fields).
	 * @return String $out Input markup.
	 *
	 */
	public function renderFilterByIDsInput($value='', $mode) {

		$notes = $this->_('Only one column per line. Example: product,1,2,3,4,5-10,11,13,15-25.');

		$filters = array(

			1 => array(
				'name' => 'includedTemplates',
				'label' => $this->_('Included Templates'),
				'desc' => $this->_("Include pages that use the specified template IDs. The IDs must be preceeded by the name of the column as shown in the example below."),
				'notes' => $notes
			),

			2 => array(
				'name' => 'excludedTemplates',
				'label' => $this->_('Excluded Templates'),
				'desc' => $this->_("Exclude pages that use the specified template IDs. The IDs must be preceeded by the name of the column as shown in the example below."),
				'notes' => $notes

			),

			3 => array(
				'name' => 'includedPages',
				'label' => $this->_('Included Pages'),
				'desc' => $this->_("Include pages with the following IDs. The IDs must be preceeded by the name of the column as shown in the example below."),
				'notes' => $notes

			),

			4 => array(
				'name' => 'excludedPages',
				'label' => $this->_('Excluded Pages'),
				'desc' => $this->_("Exclude pages with the following IDs. The IDs must be preceeded by the name of the column as shown in the example below."),
				'notes' => $notes
			),

			5 => array(
				'name' => 'includedFields',
				'label' => $this->_('Included Fields'),
				'desc' => $this->_("Include fields with the following IDs. The IDs must be preceeded by the name of the column as shown in the example below."),
				'notes' => $notes
			),

			6 => array(
				'name' => 'excludedFields',
				'label' => $this->_('Excluded fields'),
				'desc' => $this->_("Exclude fields with the following IDs. The IDs must be preceeded by the name of the column as shown in the example below."),
				'notes' => $notes
			)

		);

		$f = $this->wire('modules')->get("InputfieldTextarea");
		$f->attr('name', $filters[$mode]['name']);
		$f->attr('value', $value);
		$f->label = $filters[$mode]['label'];
		$f->collapsed = 1;// always collapsed
		$f->description = $filters[$mode]['desc'];
		$f->notes = $filters[$mode]['notes'];

		return $f;
		
	}

	/**
	 * Render the radio input for specifying whether to hide empty selects.
	 *
	 * @access public
	 * @param Int $value Current saved value.
	 * @return String $out Input markup.
	 *
	 */
	public function renderHideEmptySelectsInput($value = '') {

		$f = $this->wire('modules')->get("InputfieldCheckbox");
		$f->attr('name', 'hideEmptySelects');
		$f->attr('value', 1);
		$f->attr('checked', $value ? 'checked' : ''); 
		$f->label = $this->_('Hide empty selects');
		$f->label2 = $this->_('Hide');
		$f->collapsed = 1;// always collapsed
		$f->notes = $this->_('Hide all empty selects whose trigger select has no selected value until a selection is made.');

		return $f;
		
	}	

	/**
	 * Render the radio input for specifying whether to hide empty selects.
	 *
	 * @access public
	 * @param Int $value Current saved value.
	 * @return String $out Input markup.
	 *
	 */
	public function renderFinalSingleSelectInput($value = '') {

		#@note: not currently in use; will add if there's enough demand for this + will be a JS solution

		$f = $this->wire('modules')->get("InputfieldCheckbox");
		$f->attr('name', 'autoFinalSingleSelect');
		$f->attr('value', 1);
		$f->attr('checked', $value ? 'checked' : ''); 
		$f->label = $this->_('Auto-select value in the last select');
		$f->label2 = $this->_('Auto-select last value');
		$f->collapsed = 1;// always collapsed
		$f->notes = $this->_("Only applies if only one value is present in the last select. If this option is checked, that value will be auto-selected when the last select is triggered. This means that a user will not be shown a 'Please select' option in that last select.");

		return $f;
		
	}
	/**
	 * Render usage notes for included/excluded template/pages/fields textareas.
	 *
	 * @access public
	 * @param Bool $frontend. If true, we render extra notes specific for frontend usage.
	 * @return String $out Ordered list markup.
	 *
	 */
	public function renderIncludeExcludeNotes ($frontend=true) {
		
		$notes = array(

				$this->_('If using Dynamic Selects in the frontend, it is highly recommended that you use these inclusion/exclusion settings to control the results returned in your selects.'),
				$this->_('In the frontend, these settings will also help guard against malicious manipulation of the markup in the frontend that would allow visitors to request data they are not authorised to view.'),
				$this->_('Note that admin pages, password fields, unpublished and locked pages are never returned in the Dynamic Selects results.'),
				$this->_('Please thoroughly test your inclusion/exclusion filters first before using your Dynamic Selects.'),
				$this->_('You can use any combination of inclusions and exclusions as long as they are not of the same type. For instance, included templates and excluded templates cannot be used together. The former will supersede the latter.'),
				$this->_('Use comma-separated IDs or a range of IDs (min-max) or both. For instance, any of these would work: 1,2,3 OR 1-3 OR 1,2-3 OR 1,2-3,5,7,8-10.'),
				$this->_('The order of the specified values does not matter. For instance, you can specify 2,3,4, etc.'),				
				$this->_("The filters are column-specific. For instance, country,2,3,4, etc. Please see notes under each filter's textarea."),				
				$this->_('Included Templates+Included Pages: Limit results to pages that use the specified templates but also include pages with the specified IDs even though they use a different template.'),
				$this->_('Included Templates+Excluded Pages: Limit results to pages that use the specified templates but also exclude pages with the specified IDs even though they use the specified included templates.'),
				$this->_('Excluded Templates+Included Pages: Limit results to pages that DO NOT use the specified templates but include pages with the specified IDs even though they use the specified excluded templates'),
				$this->_('Excluded Templates+Excluded Pages: Limit results to pages that DO NOT use the specified templates as well as exclude pages with the specified IDs even though they DO NOT use the specified excluded templates'),
				$this->_('Included Templates: Limit results to ONLY pages that use the specified templates.'),
				$this->_('Excluded Templates: Limit results to pages that DO NOT use the specified templates.'),
				$this->_('Included Pages: Limit results to ONLY pages with the specified IDs.'),
				$this->_('Excluded Pages: Limit results to pages that DO NOT have the specified IDs.'),
				$this->_('Included Fields: For columns/dropdowns that display fields, limit results to ONLY the fields with the specified IDs.'),
				$this->_('Excluded Fields: For columns/dropdowns that display fields, DO NOT include fields with the specified IDs.'),

		);

		$out = '';
		$out .= '<ol id="ds_include_exclude_notes">';		
		$i = 0;
		foreach($notes as $note ) {
			// skip frontend-specific usage notes
			if((!$frontend) && ($i < 2)) {
				$i++;
				continue;
			}
			
			$out .= '<li>' . $note . '</li>';
			$i++;
		}

		$out .='</ol>';

		return $out;
	}

	############################ RENDER TABS ############################

	/**
	 * First tab contents for executeEdit()
	 *
	 * @access private
	 * @param String $tabID Classname to form part of the ID of this tab.
	 * @param Object $dsSettings Settings of the dynamic select being edited.
	 * @return Object $tab Unrendered InputfieldWrapper.
	 *
	 */
	private function buildTab($tabID, $dsSettings) {

		// First Tab. Only show if a dynamic select exists
		$tab = new InputfieldWrapper();
		$tab->attr('title', $this->_('Build'));
		$tabID = $tabID . 'Build';
		$tab->attr('id', $tabID); 
		$tab->class .= " WireTab";

		// radios: initial/first dynamic select column settings
		// determines whether initial column will list pages, templates OR users
		$f = $this->renderFirstColumnDataSourceInput($dsSettings->firstColumn);
		$tab->add($f);

		// text: selector for finding 'first column' pages|templates|users
		$f = $this->renderFirstColumnSelectorInput($dsSettings->firstColumnSelector);
		$tab->add($f);

		// textarea: input for custom php code for finding pages|templates|users to be used as data source for the first dynamic select column		
		$f = $this->renderFirstColumnFindCodeInput($dsSettings->firstColumnFindCode);
		$tab->add($f);

		// textarea: inclusion + exclusion settings =>
		// @note: we wrap these settings in a fieldset	
		$fs = $this->wire('modules')->get("InputfieldFieldset");
		$fs->label = $this->_('Include/Exclude: Templates, Pages, Fields');
		$fs->collapsed = 1;// always collapsed
		$fs->description = $this->_('Please read the usage notes first.');

		// inclusions/exclusions usage notes
		$f = $this->wire('modules')->get('InputfieldMarkup');
		$f->label = $this->_('Usage Notes');
		$f->collapsed = Inputfield::collapsedYes;
		$f->value = $this->renderIncludeExcludeNotes();
		$fs->add($f);

		// included + excluded templates
		$f = $this->renderFilterByIDsInput($dsSettings->includedTemplates, 1);
		$fs->add($f);
		$f = $this->renderFilterByIDsInput($dsSettings->excludedTemplates, 2);
		$fs->add($f);

		// included + excluded pages
		$f = $this->renderFilterByIDsInput($dsSettings->includedPages, 3);
		$fs->add($f);
		$f = $this->renderFilterByIDsInput($dsSettings->excludedPages, 4);
		$fs->add($f);

		// included + excluded fields
		$f = $this->renderFilterByIDsInput($dsSettings->includedFields, 5);
		$fs->add($f);
		$f = $this->renderFilterByIDsInput($dsSettings->excludedFields, 6);
		$fs->add($f);

		$tab->add($fs);

		// render dynamic columns settings table
		$blankArray[''] = array();
		// @note: if not empty, $dsSettings is a PHP stdClass object; otherwise a WireData object
		$columns = $dsSettings->columns ? $dsSettings->columns : $blankArray;
		$t = $this->renderTable($columns);

		$tab->add($t);

		return $tab;

	}

	/**
	* Second tab contents for executeEdit().
	* 
	* @access private
	* @param String $tabID Classname to form part of the ID of this tab.
	* @param Page $ds A dynamic select page (where its settings are saved).
	* @param Object $dsSettings dynamic select settings for this page.
	* @return Object $tab Unrendered InputfieldWrapper.
	*
	*/
	private function settingsTab($tabID, $ds, $dsSettings) {

		// @note: permissions check for editing settings if present, will kick in in DynamicSelectsActions::actionEdit()

		// check if dynamic select is published or not
		$ds->is(Page::statusUnpublished) ? $unpublished = 1 : $unpublished = '';

		// check if dynamic select is locked for editing
		$ds->is(Page::statusLocked) ? $locked = 1 : $locked = '';

		$modules = $this->wire('modules');

		$tab = new InputfieldWrapper();
		$tab->attr('title', $this->_('Settings')); 
		$tabID = $tabID . 'Settings';
		$tab->attr('id', $tabID);
		$tab->class .= ' WireTab';

		// dynamic selects: title (text)
		$f = $modules->get('InputfieldText');
		$f->label = $this->_('Dynamic Selects title');
		$f->required = true;
		$f->attr('name', 'ds_title');
		$f->attr('value', $ds->title); 
		$f->description = $this->_('A title is required.');
		$f->notes = $this->_('Please note that changing the title will reset the cache for this Dynamic Selects.');

		//$notes = ($unpublished || $locked) ? $this->_('Dynamic Selects status: ') : '';
		//if($unpublished) $notes .= $this->_('Unpublished, ');
		//if($locked) $notes .= $this->_('Locked');
		//$f->notes .= rtrim($notes, ', ');
		
		$tab->add($f);

		// dynamic selects: publish (checkbox)
		$f = $modules->get("InputfieldCheckbox");
		$f->attr('name', 'ds_publish');
		$f->attr('value', 1);
		$f->attr('checked', !$unpublished ? 'checked' : ''); 
		$f->label = $this->_('Set this select as published');
		$f->label2 = $this->_('Published');
		$f->notes = $this->_('Unpublished selects are not viewable in the frontend.');
		$tab->add($f);

		// dynamic selects: lock (checkbox)
		$f = $modules->get("InputfieldCheckbox");
		$f->attr('name', 'ds_lock');
		$f->attr('value', 1);
		$f->attr('checked', $locked ? 'checked' : ''); 
		$f->label = $this->_('Lock this select for editing');
		$f->label2 = $this->_('Locked');
		$f->notes = $this->_('Locked selects are neither editable nor deletable.');

		$tab->add($f);

		// dynamic selects: hide empty selects (checkbox)
		$f = $this->renderHideEmptySelectsInput($dsSettings->hideEmptySelects);
		$tab->add($f);

		/* @todo: will add if there's enough demand for this + will be a JS solution
		// dynamic selects: auto-select final/last select if single value (checkbox)
		$f = $this->renderFinalSingleSelectInput($dsSettings->autoFinalSingleSelect);
		$tab->add($f);
		*/

		// dynamic selects: frontend access (radios)
		$f = $modules->get('InputfieldRadios');
		$f->attr('name', 'frontAccess');
		$f->attr('value', $dsSettings->frontAccess ? $dsSettings->frontAccess : 1);// @note: defaults to logged in users only
		$f->label =  $this->_('Which users can view this select in the frontend?');
		$f->description = $this->_('Access control for who can view this Dynamic Selects in the frontend.');
		$f->notes = $this->_('If using option 2, you will have to first create the permission yourself.');
		
		$radioOptions = array (
						 1 => $this->_('Logged in users'),
						 2 => $this->_("Users with the permission 'dynamic-selects-front-view'"),
						 3 => $this->_('All users including guests'),
	 	);

		$f->addOptions($radioOptions);

		$tab->add($f);

		// dynamic selects: action if no access in frontend (radios)
		$f = $modules->get('InputfieldRadios');
		$f->attr('name', 'noFrontAccessAction');
		$f->attr('value', $dsSettings->noFrontAccessAction ? $dsSettings->noFrontAccessAction : 1);
		$f->label =  $this->_('What to do when user attempts to view a select and has no access?');
		$f->description = $this->_('Access control for what action to take if user has no view access to this Dynamic Selects in the frontend.');
		
		$radioOptions = array (
						 1 => $this->_('Output nothing'),
						 2 => $this->_('Show a 404 Page'),// unsure about the usefulness of this one?
						 3 => $this->_('Show the Login page'),
						 4 => $this->_('Redirect to another URL'),
						 5 => $this->_('Show a custom message'),
	 	);

		$f->addOptions($radioOptions);

		$tab->add($f);

		// dynamic selects: redirect URL if no access (text)
		$f = $modules->get('InputfieldText');
		$f->label = $this->_('Enter the URL you want to redirect to when a user does not have access');
		$f->attr('name', 'noFrontAccessRedirectURL');
		$f->attr('value', $dsSettings->noFrontAccessRedirectURL);
		$f->description = $this->_("Only applicable if you specified 'Redirect to another URL' in the field above.");
		$f->showIf = 'noFrontAccessAction=4';
		$f->requiredIf = 'noFrontAccessAction=4';

		$tab->add($f);

		// dynamic selects: custom message if no access (text)
		$f = $modules->get('InputfieldText');
		$f->label = $this->_('Enter the custom message to show when a user does not have access');
		$f->attr('name', 'noFrontAccessCustomText');
		$f->attr('value', $dsSettings->noFrontAccessCustomText);
		$f->description = $this->_("Only applicable if you specified 'Show a custom message' in the field above.");
		$f->showIf = 'noFrontAccessAction=5';
		$f->requiredIf = 'noFrontAccessAction=5';

		$tab->add($f);

		// dynamic selects: enable cache frontend selects (checkbox)
		$f = $modules->get("InputfieldCheckbox");
		$f->attr('name', 'frontCache');
		$f->attr('value', 1);
		$f->attr('checked', $dsSettings->frontCache ? 'checked' : ''); 
		$f->label = $this->_('Cache ajax responses');
		$f->label2 = $this->_('Cache selects data');
				
		$tab->add($f);

		// dynamic selects: cache time for frontend selects (integer)
		$f = $modules->get('InputfieldInteger'); 
		$f->attr('name', 'cacheTime');
		$f->label = $this->_('Cache time');
		$f->description = $this->_('To cache the output of this Dynamic Selects, enter the time (in seconds) that the output should be cached. Caching can help significantly with server-load on resource-heavy pages. Caching should not be used if expected data in this select will constantly be changing.');
		$f->notes = $this->_('For example: 60 = 1 minute, 600 = 10 minutes, 3600 = 1 hour, 86400 = 1 day, 604800 = 1 week, 2592000 = 1 month.');
		$f->attr('value', abs($dsSettings->cacheTime)); 
		$f->showIf = 'frontCache!=0';
		$f->requiredIf = 'frontCache!=0';
		
		$tab->add($f);

		return $tab;

	}

	/**
	* Third tab contents for executeEdit().
	*
	* @access private
	* @param String $tabID Classname to form part of the ID of this tab.
	* @param Int $dsID ID of the dynamic select to be deleted.
	* @return Object $tab Unrendered InputfieldWrapper.
	*
	*/
	private function deleteTab($tabID, $dsID) {

		$tab = new InputfieldWrapper();
		$tab->attr('title', $this->_('Delete'));
		$tabID = $tabID . 'Delete';
		$tab->attr('id', $tabID); 
		$tab->class .= " WireTab";
		
		$f = $this->wire('modules')->get('InputfieldCheckbox'); 
		$f->attr('id+name', 'ds_delete_confirm'); 
		$f->attr('value', $dsID);
		$f->icon = 'trash-o';
		$f->label = $this->_('Move to Trash');
		$f->description = $this->_('Check the box to confirm you want to do this.');
		$f->label2 = $this->_('Confirm'); 
		$tab->add($f);

		$f = $this->wire('modules')->get('InputfieldButton');
		$f->attr('id+name', 'ds_delete'); 
		$f->value = $this->_('Move to Trash');
		$tab->append($f);

		return $tab;

	}

	
}