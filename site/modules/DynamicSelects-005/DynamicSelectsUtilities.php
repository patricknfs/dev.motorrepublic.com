<?php

/**
* Dynamic Selects: Utilities
*
* This file forms part of the Dynamic Selects Suite.
* Provides various utility methods (validation, filtration, conversions, etc) for use throughout the module.
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

class DynamicSelectsUtilities extends ProcessDynamicSelects {


	/* ######################### - MARKUP HELPERS - ######################### */

	/**
	 * Return key => value pairs of pre-defined data-relationships for setting up Dynamic Selects.
	 *
	 * @access public
	 * @return $relationships Array of pre-defined data-relationships.
	 *
	 */
	public function relationships() {

		$relationships = array (
							0 => $this->_('None'),
							1 => $this->_('Child'),
							2 => $this->_('Parent'),
							3 => $this->_('Page'),
							4 => $this->_('Group'),
							5 => $this->_('Field'),
							6 => $this->_('Value'),
							7 => $this->_('User: Property'),								
							8 => $this->_('User: Value'),								
		);

		return $relationships;

	}

	/**
	 * Return CSS Class for a given preset HTML option for data sources.
	 *
	 * We use this to match valid 'data-relationship' for the given 'data-source' in JS.
	 * Used in Dynamic Selects definition table.
	 *
	 * @access public
	 * @param $id Int array index to determine CSS Class to apply to HTML options in data sources select.
	 * @return $cssClasses[$id] String CSS Class to apply to HTML options.
	 *
	 */
	public function dataSourceCSS($id) {

		$cssClasses = array(
							0 => 'ds_none_source',// initial
							1 => 'ds_page_source ds_value_source ds_user_value_source',// named-field
							2 => 'ds_group_source',// named-pagefields only
							3 => 'ds_field_source',// fields
							4 => 'ds_value_source',// named-field, varies
							5 => 'ds_user_property_source',// user: properties
							6 => 'ds_user_value_source',// named-field, user: varies
					);

		return $cssClasses[$id];

	}

	/**
	 * Return CSS Class for a given preset HTML option for data relationships.
	 *
	 * We use this to match valid 'data-sources' for the given 'data-relationship' in JS.
	 *
	 * @access public
	 * @param $id Int array index to determine CSS Class to apply to HTML options in relationships select.
	 * @return $cssClasses[$id] String CSS Class to apply to HTML options.
	 *
	 */
	public function relationshipCSS($id) {

		$cssClasses = array(
							0 => 'ds_none',// none
							1 => 'ds_page',// child
							2 => 'ds_page',// parent
							3 => 'ds_page',// page
							4 => 'ds_group',// group
							5 => 'ds_field',// field
							6 => 'ds_value',// value
							7 => 'ds_user_property',// user: property
							8 => 'ds_user_value',// user: value
					);

		return $cssClasses[$id];

	}

	/**
	 * Determine status of frontend caching of a given dynamic selects' ajax data.
	 *
	 * @access public
	 * @param Array $dsItem Settings of a dynamic select.
	 * @return String $cacheStatus Cache status information.
	 *
	 */
	public function cacheStatus(Array $dsItem) {
		$cacheStatus = $this->_('No');	
		if(isset($dsItem['cacheTime'])) {
				$seconds = (int) $dsItem['cacheTime'];
				$cacheStatus = $this->secondsToHumanReadable($seconds);
		}		
		return $cacheStatus;
	}

	/**
	 * Determine status of frontend view/access for a given dynamic select.
	 *
	 * @access public
	 * @param Array $dsItem Settings of a dynamic select.
	 * @return String $frontAccessStatus Frontend view access status information.
	 *
	 */
	public function frontAccessStatus(Array $dsItem) {

		$frontendAccessOptions = array(
					1 => $this->_('Logged in users'),
					2 => $this->_('Permitted users'),
					3 => $this->_('Everyone'),
		);

		$frontAccessStatus = isset($dsItem['frontAccess']) ? $frontendAccessOptions[$dsItem['frontAccess']] : $frontendAccessOptions[1];
		
		return $frontAccessStatus;

	}

	/* ######################### - ALLOWED/DISALLOWED FIELDS - ######################### */

	/**
	 * Return array of allowed Fieldtypes for this module.
	 *
	 * @access public
	 * @return $allowedFieldTypes Array of allowed Fieldtypes.
	 *
	 */
	public function allowedFieldTypes() {
		$allowedFieldTypes = array ('FieldtypeDatetime', 'FieldtypeEmail', 'FieldtypeFile', 'FieldtypeFloat', 'FieldtypeImage', 'FieldtypeInteger', 'FieldtypeOptions', 'FieldtypePage', 'FieldtypePageTitle', 'FieldtypePageTitleLanguage', 'FieldtypeText', 'FieldtypeTextLanguage', 'FieldtypeURL', );
		return $allowedFieldTypes;
	}

	/**
	 * Return array of disallowed Fields for this module.
	 *
	 * @access public
	 * @return $disallowedFields Array of allowed Fields.
	 *
	 */
	public function disallowedFields() {
		$disallowedFields= array('permissions', 'roles');
		return $disallowedFields;
	}

	/* ######################### - VALIDATORS - ######################### */

	/**
	 * Validate if a the relationship of a given trigger is valid for the relationship of the select being triggered.
	 *
	 * In the case of 'value' and 'user: value' we also look at the data source of the trigger.
	 * If it is a named-pagefield, then it is a valid trigger.
	 *
	 * @access public
	 * @param $triggerRelationship Int relationship type of trigger select to validate.
	 * @param $triggerDataSource Int data-source of trigger to validate if 'value' relationship can be a trigger.
	 * @param $relationship Int relationship type of triggered select to validate.
	 * @param $dataSource Int ID of the source of data for the given column.
	 * @param $first Int Denotes the type of data to return in first column (page|template|user).
	 * @return $valid Bool valid|invalid trigger relationship.
	 *
	 */
	public function validateTrigger($triggerRelationship, $triggerDataSource, $relationship, $dataSource, $first) {

		$triggerRelationship = (int) $triggerRelationship;
		$triggerDataSource = (int) $triggerDataSource;
		$relationship = (int) $relationship;
		$dataSource = (int) $dataSource;
		$first = (int) $first;

		$valid = true;

		// @note: $key: $triggerRelationship; $value: invalid $relationship
		$invalidRelationshipTriggers = array(
							0 => array(0),// none
							1 => array(0,3,7,8),// child
							2 => array(0,3,7,8),// parent
							3 => array(0,3,7,8),// page
							4 => array(0,3,7,8),// group
							5 => array(0,1,2,3,4,5,7,8),// field
							6 => array(0,3,7,8),// value @see notes below
							7 => array(0,1,2,3,4,5,6,7),// user: property
							8 => array(0,3,7,8),// user: value @see notes below
					);

		$validTrigger = $invalidRelationshipTriggers[$triggerRelationship];// array
		if(in_array($relationship, $validTrigger)) $valid = false;

		// for a 'field' relationship trigger, it can only trigger a 'value' relationship if the triggered select's data-source is 'varies'
		if($triggerRelationship == 5 && $relationship == 6 && $dataSource != -2) $valid = false;

		// validation related to initial column
		if($triggerRelationship == 0) {
			if($first == 1 && in_array($relationship, array(3,7,8))) $valid = false;// 'pages' initial cannot trigger 'page|user:property|user:value' relationships
			elseif($first == 2 && $relationship !=3) $valid = false;// 'templates' initial can only trigger 'page' relationship
			elseif($first == 3 && ($relationship !=7) && ($relationship !=8))  $valid = false;// 'users' initial can only trigger 'user:property|user|value' relationships
		}

		// for a 'child|parent|page|group' relationship trigger, it can only trigger a 'value' relationship if the triggered select's data-source is NOT 'varies'
		if($triggerRelationship < 5 && $relationship == 6 && $dataSource == -2) $valid = false;

		// for a 'value' OR a 'user: value' relationship trigger, it can only be a trigger if its data-source is a named-pagefield
		if(($triggerRelationship == 6 || $triggerRelationship == 8) && $triggerDataSource > 0) {
			$f = $this->wire('fields')->get($triggerDataSource);
			if($f && $f->id > 0)  {
				if($f->type != 'FieldtypePage') $valid = false;
			}
							
		}

		// for a 'user: property' relationship trigger, it can only trigger a 'user: value' relationship if the triggered select's data-source is 'user: varies'
		if($triggerRelationship == 7 && $relationship == 8 && $dataSource != -4) $valid = false;

		return $valid;

	}

	/**
	 * Validate if the frontend ajax-request is genuine and safe to honour.
	 *
	 * Here we guard against malicious manipulation of the DOM in order to gain access to data.
	 * We perform various checks as stated below.
	 * For frontend use (MarkupDynamicSelects)
	 *
	 * @access public
	 * @param Object $input Input from Ajax request for the Dynamic Selects we are validating.
	 * @param Bool $frontend If true, we will validate for user access (i.e. frontend use).
	 * @return Array $valid If valid, returns various settings for the given Dynamic Select.
	 *
	 */
	public function validateRequest($input, $frontend = true) {
		
		/*
			@access-controls: => validating...
				1. If Dynamic Selects name is valid
				2. If Dynamic Selects exists
				3. If current user is allowed to view this Dynamic Selects
				4. If trigger and dependent columns names are genuine for the given Dynamic Selects
				5. If trigger is the one saved in the settings (server-side) for the specified dependent column
		 */

		$valid = array();
		$valid['valid'] = true;

		## 1. validation: Do we have a Dynamic Selects with this name? ##
		if(!$frontend) {
			$backendID = explode('|', $input->dataUniqueID);
			$uniqueid = $backendID[0];
			$fieldID = (int) $backendID[1];
		}

		else $uniqueid = $input->dataUniqueID;

		$dsName = $this->wire('sanitizer')->pageName($uniqueid);
		if(!$dsName) return $valid['valid'] = false;

		## 2. validation: Does the given Dynamic Selects exist? ##
		$dsSettings = array();

		// check if we are in the backend or frontend
		if($frontend) {
			#$ds = $this->wire('pages')->get($this->config->adminRootPageID)->child('name=dynamic-selects, check_access=0')->child("name=$dsName, check_access=0, include=hidden");
			// @note: changed to below ['include=all'] in order to work in frontend Multi-Lingual setups
			// @note: this is because ds parent and child pages do not get their non-default languages 'active' setting/flag set on creation.
			$ds = $this->wire('pages')->get($this->config->adminRootPageID)->child('name=dynamic-selects, include=all')->child("name=$dsName, include=all");
			if($ds && $ds->id > 0) $dsSettings = json_decode($ds->ds_settings, true);
		}

		// if in backend, we get settings from field
		else {
			$ds = $this->wire('fields')->get($fieldID);
			if($ds && $ds->id > 0) $dsSettings = $ds->data;
		}

		if(!count($dsSettings)) return $valid['valid'] = false;

		## 3. validation: Can current user can view this Dynamic Selects? (Frontend Only! [MarkupDynamicSelects]) ##
		if($frontend && $this->checkAccess($dsSettings)) return $valid['valid'] = false; 

		## 4. validation: Do the given trigger and dependent columns exist in this Dynamic Selects? ##		
		// remove prefix: @note: for ID uniqueness when we have multiple selects and user is reusing column names...
		// ...our IDs are formatted as 'dsName-columnName'...so we need to remove the prefix first 
		$prefix = $dsName . '-';

		$triggerColumn = str_replace($prefix, '', $input->triggerColumn);
		$triggerColumn = $this->sanitizeFieldName($triggerColumn);	
		
		$dependentColumn = str_replace($prefix, '', $input->dependentColumn);
		$dependentColumn = $this->sanitizeFieldName($dependentColumn);
		if(!isset($dsSettings['columns'][$triggerColumn]) || !isset($dsSettings['columns'][$dependentColumn]) ) return $valid['valid'] = false;

		## 5. validation: Is the given trigger the TRUE TRIGGER for the given dependent column in this Dynamic Selects? ##
		if($dsSettings['columns'][$dependentColumn][1] !== $triggerColumn) return $valid['valid'] = false;


		################################ validation passed: good to go ################################	

		$valid['dsName'] = $dsName;

		// the trigger object (page|template|field|user) - this is the trigger <select> 
		$valid['dataObj'] = $input->dataObj;// @note sanitized futher on in DynamicSelectsAction methods

		// dependent column (that will be dynamically populated)
		$valid['dependentColumn'] = $dependentColumn;
		// trigger column that triggered the dependent select. Will use this for further 'trigger' validation
		$valid['triggerColumn'] = $triggerColumn;
		
		// type of relationship in the DEPENDENT select
		$valid['dataRelationship'] = (int) $dsSettings['columns'][$dependentColumn][2];
		// dataSource of the values to return. E.g. could be Title of a page, or Email of a user, or 'SomeField' of a page
		$valid['dataSource'] = (int) $dsSettings['columns'][$dependentColumn][3];

		// included + excluded templates, pages|users, fields		
		$valid['includedExcludedIDs'] = $this->filterByIDs($dsSettings);

		// check if given trigger column is the first/initial select. Need this for 'dataObj stored-in-cache' validation later on
		$first = '';
		foreach ($dsSettings['columns'] as $key => $value) {
			$first = $this->sanitizeFieldName($key);
			$valid['firstColumnName'] = $first;
			break;
		}
		$valid['triggerColumnIsFirst'] = $first === $triggerColumn ? true : false;

		$valid['columnNames'] = $this->getColumnNames($dsSettings);// @note: needed e.g. in DynamicSelectsActions::createInitialSelectsCache()

		$valid['frontend'] = $frontend;
		$valid['frontCache'] = isset($dsSettings['frontCache']) && (int) $dsSettings['frontCache'] === 1 ? (int) $dsSettings['frontCache'] : 0;
		$valid['cacheTime'] = isset($dsSettings['cacheTime']) ? (int) $dsSettings['cacheTime'] : 0;// @todo...may need to change since now using default?

		// @see notes here DynamicSelectsActions::processDataRequest()
		if($frontend) $valid['dsSettings'] = $dsSettings;

		return $valid;

	}

	/**
	 * Check if the given triggerID (dataObj) for the first/initial column is valid.
	 *
	 * We check if the triggerID is valid compared to allowed IDs stored in the cache.
	 * For frontend use (MarkupDynamicSelects).
	 *
	 * @access public
	 * @param Int $id The triggerID sent from the triggered select to validate.
	 * @param String $dsName The name of the Dynamic Selects whose initial select we are validating.
	 * @param String $firstColumnName The name of the first/initial column in this Dynamic Selects.
	 * @param Array $dsSettings The settings of the given Dynamic Selects.
	 * @param Bool $frontend Whether we are in the frontend (MarkupDynamicSelects) or backend (FieldtypeDynamicSelects).
	 * @return Bool $valid valid|invalid triggerID.
	 *
	 */
	public function validateInitialSelect($id, $dsName, $firstColumnName, $dsSettings, $frontend) {
		
		// @access-control: cached ids of initial select (here dataObj will always be from first/initial select)
 		$valid = true;

 		/*
 			@note: 
 				- for security, in cases where cache has expired and has not been rebuilt...
 				- this function first rebuilds the first/initial cache based on first column/select...
 				- it then validates initial (ajax) request based on that
 				- this is for frontend use only
 		 */

		// check if we have a cache for this Dynamic Selects (@note: we should always have at least the first/initial column's cache)
		$dsCache = $this->wire('cache')->get('dynamic-selects-' . $dsName . $this->setLanguageSuffix());
 		// if we didn't get a cache, it must have expired or was deleted. Let's at least create an initial cache to validate against
 		if(!is_array($dsCache)) {
 				$dsActions = new DynamicSelectsActions();
 				$dsActions->getInitialData($dsSettings, $dsName, $firstColumnName, $frontend);
  				// get the newly created cache
 				$dsCache = $this->wire('cache')->get('dynamic-selects-' . $dsName . $this->setLanguageSuffix());
 				// if we didn't get the cache for the second time, we abort, assuming request is invalid/forged
 				if(!is_array($dsCache)) return $valid = false;
 		}
		
		// if we got here $dsCache must be an array
		if(!isset($dsCache[$firstColumnName][0][$id])) $valid = false;

		return $valid;

	}

	/**
	 * Validate that the given page IS NOT an Admin page.
	 *
	 * @access public
	 * @param Object $page The trigger page sent from the trigger select to validate.
	 * @return $valid Bool valid|invalid $page.
	 *
	 */
	public function validateAdminPages($page) {
		$valid = true;
		if($page->rootParent->id == $this->wire('config')->adminRootPageID || $page->template->name == 'admin' || $page->id == 7) $valid = false;
		return $valid;
	}
	
	/**
	 * Check if the given trigger (dataObj) is valid.
	 *
	 * We check if the triggerID is either in an inclusion or exclusion list.
	 * Checks can be for templates, pages, users or fields.
	 * We do some extra checks in the case of fields.
	 *
	 * @access public
	 * @param Int $templateID ID OF The triggerID sent from the trigger select to validate.
	 * @param Array $includedExcludedIDs IDs of triggers (dis)allowed in the given trigger select.
	 * @param String $column Name of the TRIGGER column (select) to validate.
	 * @param Int $pageID ID of the trigger page to be validated.
	 * @return $valid Bool valid|invalid trigger.
	 *
	 */
	public function validateIncludedExcludedTemplatesPages($templateID, $includedExcludedIDs, $column, $pageID='') {

 		$valid = true;

 		$incTemplates = isset($includedExcludedIDs['includedTemplates'][$column]) ? $includedExcludedIDs['includedTemplates'][$column] : array();
		$excTemplates = isset($includedExcludedIDs['excludedTemplates'][$column]) ? $includedExcludedIDs['excludedTemplates'][$column] : array();

		$incPages = isset($includedExcludedIDs['includedPages'][$column]) ? $includedExcludedIDs['includedPages'][$column] : array();
		$excPages = isset($includedExcludedIDs['excludedPages'][$column]) ? $includedExcludedIDs['excludedPages'][$column] : array();

		#1. include-exception-in
		if(count($incTemplates) && count($incPages)) {
			$validTemplateID = $this->rangeCheck($templateID, $incTemplates);
			$rangeTemplates = $validTemplateID['valid'];
			$validPageID = $this->rangeCheck($pageID, $incPages);
			$rangePages = $validPageID['valid'];		
			if( (!in_array($templateID, $incTemplates) && $rangeTemplates == 0) && (!in_array($pageID, $incPages) && $rangePages == 0) ) $valid = false;
		}
		
		#2. include-exception-out
		elseif(count($incTemplates) && count($excPages)) {
			$validTemplateID = $this->rangeCheck($templateID, $incTemplates);
			$rangeTemplates = $validTemplateID['valid'];
			$validPageID = $this->rangeCheck($pageID, $excPages);
			$rangePages = $validPageID['valid'];
			if( (!in_array($templateID, $incTemplates) && $rangeTemplates == 0) || (in_array($pageID, $excPages) || $rangePages == 1) ) $valid = false;
		}

		#3. exclude-exception-in
		elseif(count($excTemplates) && count($incPages)) {
			$validTemplateID = $this->rangeCheck($templateID, $excTemplates);
			$rangeTemplates = $validTemplateID['valid'];
			$validPageID = $this->rangeCheck($pageID, $incPages);
			$rangePages = $validPageID['valid'];
			if( (in_array($templateID, $excTemplates) || $rangeTemplates == 1) && (!in_array($pageID, $incPages) && $rangePages == 0) ) $valid = false;
		}

		#4. exclude-exception-out
		elseif(count($excTemplates) && count($excPages)) {
			$validTemplateID = $this->rangeCheck($templateID, $excTemplates);
			$rangeTemplates = $validTemplateID['valid'];
			$validPageID = $this->rangeCheck($pageID, $excPages);
			$rangePages = $validPageID['valid'];
			if( (in_array($templateID, $excTemplates) || $rangeTemplates == 1) || (in_array($pageID, $excPages) || $rangePages == 1) ) $valid = false;
		}

		#5. count included templates only
		elseif(count($incTemplates)) {
			$validTemplateID = $this->rangeCheck($templateID, $incTemplates);
			$rangeTemplates = $validTemplateID['valid'];		
			if(!in_array($templateID, $incTemplates) && $rangeTemplates == 0) $valid = false;
		}
		
		#6. count excluded templates only
		elseif(count($excTemplates)) {
			$validTemplateID = $this->rangeCheck($templateID, $excTemplates);
			$rangeTemplates = $validTemplateID['valid'];		
			if(in_array($templateID, $excTemplates) || $rangeTemplates == 1) $valid = false;
		}
		
		#7. count included pages only
		elseif(count($incPages)) {
			$validPageID = $this->rangeCheck($pageID, $incPages);
			$rangePages = $validPageID['valid'];		
			if(!in_array($pageID, $incPages) && $rangePages == 0) $valid = false;
		}
		
		#8. count excluded pages only
		elseif(count($excPages)) {
			$validPageID = $this->rangeCheck($pageID, $excPages);
			$rangePages = $validPageID['valid'];
			if(in_array($pageID, $excPages) || $rangePages == 1) $valid = false;
		}

		return $valid;
		
	}

	/**
	 * Check if the given field is valid.
	 *
	 * We skip excluded fields or allow only included fields.
	 * We also check for allowed and disallowed fieldtypes.
	 * Used for both trigger and dependent columns/selects.
	 *
	 * @access public
	 * @param Int $fieldID The trigger field ID sent from the trigger select to validate.
	 * @param Array $includedExcludedIDs IDs of triggers (dis)allowed in the given trigger select.
	 * @param String $column Name of the TRIGGER column (select) to validate.
	 * @param Array $fieldExtra Extra field properties to validate against.
	 * @return $valid Bool valid|invalid $page.
	 *
	 */
	public function validateIncludedExcludedFields($fieldID, $includedExcludedIDs, $column, Array $fieldExtra) {
		
		$valid = true;

		$incFields = isset($includedExcludedIDs['includedFields'][$column]) ? $includedExcludedIDs['includedFields'][$column] : array();
		$excFields = isset($includedExcludedIDs['excludedFields'][$column]) ? $includedExcludedIDs['excludedFields'][$column] : array();
		
		// @access-control: included fields
		if(count($incFields)) {
			$validFieldID = $this->rangeCheck($fieldID, $incFields);
			$rangeFields = $validFieldID['valid'];		
			if(!in_array($fieldID, $incFields) && $rangeFields == 0) $valid = false;		
		}
		// @access-control: excluded fields
		elseif(count($excFields)) {
			$validFieldID = $this->rangeCheck($fieldID, $excFields);
			$rangeFields = $validFieldID['valid'];
			if(in_array($fieldID, $excFields) || $rangeFields == 1) $valid = false;
		}		

		// @access-control: allowed fields [skip incompatible field types]
		if(!in_array($fieldExtra['type'], $this->allowedFieldTypes())) $valid = false;
		// @access-control: disallowed fields [skip roles and permissions]
		if(in_array($fieldExtra['name'], $this->disallowedFields())) $valid = false;
		
		return $valid;

	}

	/* ######################### - ARRAY FILTERS - ######################### */

	/**
	 * Check if the given trigger (dataObj) is valid.
	 *
	 * Given a range, we check if the triggerID is either in an inclusion or exclusion list.
	 * Checks can be for templates, pages, users or fields.
	 *
	 * @access private
	 * @param Int $id triggerID sent from the trigger select to validate if in range.
	 * @param Array $includedExcludedItemsIDs List and/or Range of included/excluded IDs of the trigger items to be validated.
	 * @return Array $valid Validity result.
	 *
	 */
	private function rangeCheck($id, $includedExcludedItemsIDs) {

		$valid['valid'] = 0;
		$valid['message'] = '';

		// check if we have a range
		$rangeIncludedExcludedItemsIDs = $this->getRangeItems($includedExcludedItemsIDs);

		$rangeCnt = count($rangeIncludedExcludedItemsIDs);

		if($rangeCnt == 0) $valid['message'] = 'no_range';	
		elseif($rangeCnt == count($includedExcludedItemsIDs)) $valid['message'] = 'range_only';
		else $valid['message'] = 'mixed';

		// if 'no range' return early @note: DOES NOT MEAN $id not valid! just that we need to do a normal check only
		if($valid['message'] == 'no_range') return $valid;
		
		foreach ($rangeIncludedExcludedItemsIDs as $range) {
					$minMax = explode('-', $range);
					$min = $minMax[0];
					$max = $minMax[1];
					
					$checkedID = filter_var(
								$id,
								FILTER_VALIDATE_INT,
								array(
										// @note: these assoc $keys are PHP's inbuilt (including the 'options')
										'options' => array( 
															#'default' => 'invalid', 
															'default' => 0,
															'min_range' => $min,
															'max_range' => $max
										)
								) 
						);

						if($checkedID !== 0) {
							$valid['valid'] = 1;
							break;
						}
		}

		return $valid;

	}

	/* ######################### - GETTERS - ######################### */

	/**
	 * Get the value of a Title|Text field in a given language.
	 *
	 * @param String $fieldName Name of field in $page.
	 * @param Object $page Name of field in $page.
	 * @param Null|Int $languageID Null or language ID of the current user.
	 * @return String $value Value of the field.
	 *
	 */
	public function getLanguageValue($fieldName, $page, $languageID) {
		$pages = $this->wire('pages');
		$value = $page->$fieldName;
		if($languageID != null && method_exists($pages->get($page->id)->$fieldName, 'getLanguageValue')) {
			$value = $pages->get($page->id)->$fieldName->getLanguageValue($languageID);
			// if title|text value for that language is empty, fall back on default language's value
			if(!$value) {
				$languageID = $this->wire('languages')->getDefault();
				$value = $pages->get($page->id)->$fieldName->getLanguageValue($languageID);
			}
		}
		return $value;
	}	 

	/**
	 * Check if given array of included/excluded items has 'range' items.
	 *
	 * A range is defined as minimum-maximum values such as 100-135,250-300, etc.
	 * The range must be delimited by a '-' [hyphen].
	 * We return an array with any ranges found or blank array if none found.
	 * Array keys are preserved.
	 *
	 * @access private
	 * @param Array $includedExcludedItemsIDs Array of included/excluded items to check for and return range items only.
	 * @return Array $rangeItemIDs List of range items.
	 *
	 */
	private function getRangeItems(Array $includedExcludedItemsIDs) {
		// check if we have a range
		// @note: array_filter preserves keys (just what we need)
		$rangeText = '-';// range delimiter
		$rangeItemIDs = array_filter($includedExcludedItemsIDs, function($arr) use ($rangeText) {
		return (strpos($arr, $rangeText) !== false);
		});
		return $rangeItemIDs;
	}

	/**
	 * Check if given array of included/excluded items has 'no range' items.
	 *
	 * A non-range is defined as normal $key => $value, where value equals one item ID, e.g. 0=>100,2=>250, etc.
	 * We return an array with all range items removed (if present) or blank array if none found.
	 * Array keys are preserved.
	 *
	 * @access private
	 * @param Array $rangeItemIDs Array of included/excluded range items (if any) to remove.
	 * @param Array $includedExcludedItemsIDs Array of included/excluded items (if any) to check for and return non-range items.
	 * @return Array $noRangeItemIDs List of non-range items.
	 *
	 */
	private function getNoRangeItems(Array $rangeItemIDs, Array $includedExcludedItemsIDs) {
		// check if we are dealing with 'range_only', 'no_range',  or 'mixed' $includedExcludedItemsIDs
		$noRangeItemIDs = array();
		if(count($rangeItemIDs) && $rangeItemIDs != $includedExcludedItemsIDs) $noRangeItemIDs = array_diff_key($includedExcludedItemsIDs, $rangeItemIDs);
		elseif(!count($rangeItemIDs)) $noRangeItemIDs = $includedExcludedItemsIDs;
		return $noRangeItemIDs;
	}

	/**
	 * Return 'empty' list of column names in the given Dynamic Selects.
	 *
	 * @access public
	 * @param Array $dsSettings Settings of a the Dyynamic Selects.
	 * @param Bool $firstColumnOnly Whether to return list with only the first/initial column.
	 * @return Array $columnNames Array listing key(columnName)=>value(empty) pairs of columns in the given Dynamic Selects.
	 *
	 */
	public function getColumnNames(Array $dsSettings, $firstColumnOnly = false) {
		$keys = array_keys($dsSettings['columns']);// array
		$values = array_fill(0, count($keys), '');// array @note: empty values; could as well have set keys values to array or null
		$columnNames = array_combine($keys, $values);
		// @note: if not caching, we still cache first/initial column for security checks
		if($firstColumnOnly) $columnNames = array_slice($columnNames, 0, 1);
		return $columnNames;
	}

	/* ######################### - SETTERS - ######################### */

	/**
	 * Set the value of a Title|Text field in a given language.
	 *
	 * @return String $value Value of the field.
	 *
	 */
	public function setLanguage() {
		$language = $this->wire('user')->language ? $this->wire('user')->language : null;		
		return $language;
	}

	/**
	 * Set the name of user's language as suffix for use in JS.
	 *
	 * @return String $value Value of the field.
	 *
	 */
	public function setLanguageSuffix() {
		$language = $this->setLanguage();
		$languageSuffix = $language ?  "-" . $language->name : '';
		return $languageSuffix;
	}





	/* ######################### - SELECTORS - ######################### */

	/**
	 * Determine and build a valid selector string from a set of specified conditions.
	 *
	 * Used for filtering-in/out items in a find call.
	 * Those items will then be included/excluded from the search results at the DataBase query level.
	 *
	 * @access public
	 * @param Array $incTemplates Templates that need to be returned in the find call.
	 * @param Array $excTemplates Templates to exclude from find.
	 * @param Array $incPages Pages that need to be returned in the find call.
	 * @param Array $excPages Pages to exclude from find.
	 * @return String $selector ProcessWire selector string to filter-in/out items in a find call.
	 *
	 */
	public function buildSelector($incTemplates, $excTemplates, $incPages, $excPages) {

 		$selector = '';

 		// templates
 		$rangeTemplateIDs =  array();
 		if(count($incTemplates)) {
 			$rangeTemplateIDs = $this->getRangeItems($incTemplates);
 			$noRangeTemplateIDs = $this->getNoRangeItems($rangeTemplateIDs, $incTemplates);
 		}
 		elseif(count($excTemplates)) {
 			$rangeTemplateIDs = $this->getRangeItems($excTemplates);
 			$noRangeTemplateIDs = $this->getNoRangeItems($rangeTemplateIDs, $excTemplates);
 		}
		
		// pages
		$rangePageIDs = array();
 		if(count($incPages)) {
 			$rangePageIDs = $this->getRangeItems($incPages);
 			$noRangePageIDs = $this->getNoRangeItems($rangePageIDs, $incPages);
 		}
 		elseif(count($excPages)) {
 			$rangePageIDs = $this->getRangeItems($excPages);
 			$noRangePageIDs = $this->getNoRangeItems($rangePageIDs, $excPages);
 		}

 		#####################################################################

		#1. include-exception-in (included Templates + included Pages)
		if(count($incTemplates) && count($incPages)) {
			// build Templates range and non-range items selector first
			if(count($rangeTemplateIDs)) $selector .= $this->buildRangeSelector($rangeTemplateIDs, 'template', 1);
			if(count($noRangeTemplateIDs)) $selector .= $this->buildNoRangeSelector($noRangeTemplateIDs, 'template', 4);

			// build Pages range and non-range items selector
			if(count($rangePageIDs)) $selector .= $this->buildRangeSelector($rangePageIDs, 'id', 1);
			if(count($noRangePageIDs)) $selector .= $this->buildNoRangeSelector($noRangePageIDs, 'id', 4);
		}
		
		#2. include-exception-out (included Templates + excluded Pages)
		elseif(count($incTemplates) && count($excPages)) {
			// build Templates range and non-range items selector first
			$noRangeTemplateMode = 1;// if no range, use normal And selector
			if(count($rangeTemplateIDs)) {
				$selector .= $this->buildRangeSelector($rangeTemplateIDs, 'template', 1);
				$noRangeTemplateMode = 4;// we have a range so need to use OR:groups selector here
			}
			if(count($noRangeTemplateIDs)) $selector .= $this->buildNoRangeSelector($noRangeTemplateIDs, 'template', $noRangeTemplateMode);

			// build Pages range and non-range items selector
			if(count($rangePageIDs)) $selector .= $this->buildRangeSelector($rangePageIDs, 'id', 2);
			if(count($noRangePageIDs)) $selector .= $this->buildNoRangeSelector($noRangePageIDs, 'id', 2);
		}

		#3. exclude-exception-in (excluded Templates + included Pages)
		elseif(count($excTemplates) && count($incPages)) {

			/*
			@note: original code before include/exclude by range feature
			$templateIDs = implode('|', $excTemplates);
			$pageIDs = implode('|', $incPages);
			$selector = "(template!=$templateIDs), (id=$pageIDs)";// 'OR:groups' selector
			 */

			############

			/*
				@notes: 

				in buildSelector() method, this condition does not work where:
					We have more than one range in 'range ONLY' or 'mixed' of excluded templates and more than one range ONLY of included pages. This is because we need to group/match the OR:groups of the pages and their templates and we cannot know in advance what pages match what templates...

				The other variation 'no range' in excluded templates in combination with any varation in included pages (range, no range and mixed) WORKS FINE. @todo: revisit this
			 */

			############

			// build Templates range and non-range items selector first
			$noRangeTemplateMode = 3;// if no range, use normal And selector
			if(count($rangeTemplateIDs)) {
				$selector .= $this->buildRangeSelector($rangeTemplateIDs, 'template', 2);
				$noRangeTemplateMode = 2;// we have a range so need to use OR:groups selector here CONFIRM NEEDED!
			}
			if(count($noRangeTemplateIDs)) $selector .= $this->buildNoRangeSelector($noRangeTemplateIDs, 'template', $noRangeTemplateMode);

			// build Pages range and non-range items selector
			if(count($rangePageIDs)) $selector .= $this->buildRangeSelector($rangePageIDs, 'id', 1);
			if(count($noRangePageIDs)) $selector .= $this->buildNoRangeSelector($noRangePageIDs, 'id', 4);
		}

		#4. exclude-exception-out (excluded Templates + excluded Pages)
		elseif (count($excTemplates) && count($excPages)) {
			// build Templates range and non-range items selector first
			if(count($rangeTemplateIDs)) $selector .= $this->buildRangeSelector($rangeTemplateIDs, 'template', 2);
			if(count($noRangeTemplateIDs)) $selector .= $this->buildNoRangeSelector($noRangeTemplateIDs, 'template', 2);

			// build Pages range and non-range items selector
			if(count($rangePageIDs)) $selector .= $this->buildRangeSelector($rangePageIDs, 'id', 2);
			if(count($noRangePageIDs)) $selector .= $this->buildNoRangeSelector($noRangePageIDs, 'id', 2);
		}

		#5. count included templates only
		elseif(count($incTemplates)) {
			// build Templates range and non-range items selector
			$noRangeTemplateMode = 1;// if no range, use normal And selector
			if(count($rangeTemplateIDs)) {
				$selector .= $this->buildRangeSelector($rangeTemplateIDs, 'template', 1);
				$noRangeTemplateMode = 4;
			}
			if(count($noRangeTemplateIDs)) $selector .= $this->buildNoRangeSelector($noRangeTemplateIDs, 'template', $noRangeTemplateMode);
		}
		
		#6. count excluded templates only
		elseif(count($excTemplates)) {
			// build Templates range and non-range items selector
			if(count($rangeTemplateIDs)) $selector .= $this->buildRangeSelector($rangeTemplateIDs, 'template', 2);
			if(count($noRangeTemplateIDs)) $selector .= $this->buildNoRangeSelector($noRangeTemplateIDs, 'template', 2);
		}
		
		#7. count included pages only
		elseif(count($incPages)) {
			// build Pages range and non-range items selector
			$noRangePageMode = 1;// if no range, use normal And selector
			if(count($rangePageIDs)) {
				$selector .= $this->buildRangeSelector($rangePageIDs, 'id', 1);
				$noRangePageMode = 4;
			}
			if(count($noRangePageIDs)) $selector .= $this->buildNoRangeSelector($noRangePageIDs, 'id', $noRangePageMode);
		}
		
		#8. count excluded pages only
		elseif(count($excPages)) {
			// build Pages range and non-range items selector
			if(count($rangePageIDs)) $selector .= $this->buildRangeSelector($rangePageIDs, 'id', 2);
			if(count($noRangePageIDs)) $selector .= $this->buildNoRangeSelector($noRangePageIDs, 'id', 2);
		}		

		$selector = trim($selector, ', ');

		return $selector;
		
	}

	/**
	 * Build a selector string from a given list of item IDs.
	 *
	 * Items here are 'non-range'.
	 *
	 * @access private
	 * @param Array $noRangeItemIDs IDs of templates or pages to find in a selector.
	 * @param String $type Denotes whether selector is dealing with pageIDs or templateIDs.
	 * @param Int $mode Determines selector type.
	 * @return String $selector A valid ProcessWire selector for the given items and conditions.
	 *
	 */
	private function buildNoRangeSelector($noRangeItemIDs, $type, $mode=1) {
		
		// @note: if 'range items' will also be part of this selector, we need to use 'OR:Groups' irrespective		
		$selector = '';
		$noRangeItems = implode('|', $noRangeItemIDs);

		if($mode == 2) $selector = "$type!=$noRangeItems, ";// no_range or NOT EQUALs range: 'normal And NOT-EQUALS' selector
		elseif($mode == 3) $selector = "($type!=$noRangeItems), ";// no_range 'OR:groups NOT EQUALS' selector
		elseif($mode == 4) $selector = "($type=$noRangeItems), ";// range present OR simply 'OR:groups EQUALS' selector		
		elseif($mode == 1) $selector = "$type=$noRangeItems, ";// no_range: 'normal And EQUALS' selector
		
		return $selector;

	}

	/**
	 * Build a selector string from a given list of item IDs.
	 *
	 * Items here are 'range'.
	 * Hence we are working with less-than and greater-than.
	 *
	 * @access private
	 * @param Array $noRangeItemIDs IDs of templates or pages to find in a selector.
	 * @param String $type Denotes whether selector is dealing with pageIDs or templateIDs.
	 * @param Int $mode Determines selector type.
	 * @return String $selector A valid ProcessWire selector for the given items and conditions.
	 *
	 */
	private function buildRangeSelector($rangeItemIDs, $type, $mode=1) {

		// @note: range selectors will always be 'OR:Groups' selectors!
		// if $mode == 1: includes; if 2: excludes
		$i = 1;
		$prefix = substr($type, 0,1);

		$selector = '';
		foreach ($rangeItemIDs as $range) {
					$minMax = explode('-', $range);
					$min = $minMax[0];
					$max = $minMax[1];

					// Excludes: 'OR:groups' {NOT EQUALS selector: less-than-minimum OR greater-than-maximum}
					if($mode == 2) $selector .= "$prefix$i=($type<$min), $prefix$i=($type>$max), ";
					// Includes: 'OR: groups' {EQUALS selector: greater-than-minimum OR less-than-maximum}
					elseif($mode == 1) $selector .= "($type>=$min, $type<=$max), ";
					
					$i++;
		}

		return $selector;

	}	

	/* ######################### - SANITIZERS - ######################### */

	/**
	 * Sanitize a field name.
	 *
	 * Same as Sanitizer::fieldName, but enforces lowercase
	 *
	 * @access public
	 * @param String $fieldName Name to validate.
	 * @param Bool $checkReserved Whether to check against reserved column names.
	 * @return String $fieldName The sanitized valid field name.
	 *
	 */
	public function sanitizeFieldName($fieldName, $checkReserved = true) {
		// credits: @rc
		$fieldName = $this->wire('sanitizer')->fieldName($fieldName); 
		$fieldName = strtolower($fieldName); 
		if($checkReserved) {
			if(in_array($fieldName, array('data', 'pages_id', 'sort', 'extradata', 'columns'))) {
				$this->error(sprintf($this->_('Dynamic Selects: You may not name a column "%s" because it is a reserved word'), $fieldName));
				$fieldName = '';
			}
		}
		return $fieldName; 
	}

	/**
	 * Sanitize site-editor set selectors.
	 *
	 * Used in DynamicSelectsActions::actionEdit().
	 *
	 * @access public
	 * @param String $selStr Mostly unsanitized selector.
	 * @return String $sel Sanitized selector string.
	 *
	 */
	public function sanitizeSelector($selStr='') {

		if(!$selStr) return;//if we got nothing, just return
		$sanitizer = $this->wire('sanitizer');

		$arr = explode(',', $selStr);
		$i = 0;
		foreach ($arr as $result) {

			if(strpos($result, '=(')) {
				$result = preg_replace('/(?<==)(.*?)=/','$1#',$result);//ensure intact passage of named OR:groups, e.g. foo=(bar=1). we get the second '='
				$delimiter = '#';//temp delimiter to ensure intact passage of named OR:groups, e.g. foo=(bar=1)
			}
			elseif(strpos($result, '[')) $delimiter = '[';
			elseif(strpos($result, '=')) $delimiter = '=';
			elseif(strpos($result, '>')) $delimiter = '>';
			elseif(strpos($result, '<')) $delimiter = '<';
		    $b = explode($delimiter, $result);
		    $f = str_replace(' ', '', $b[0]);
		    if($delimiter == '#') $delimiter = '=';//restore the replaced '=' above
		    $array[$i][$f.$delimiter] = $b[1];
		    $i++;
		}

		//gluing it all together again
		$sel = '';
		foreach ($array as $value) {
			foreach ($value as $k => $v) {
				$sel .= $sanitizer->entities($k);
				/*********************************************************************************************************************************************
				if these are in the value:
					(i)		'|' e.g. 'id=1|2|3'
					(ii)	'-' e.g. 'sort=-date'
					(iii)	'(' or ')' as part of OR-groups, e.g. (featured_from<=today, featured_to>=today), (highlighted=1)
					(iv)	'(' or ')' as part of named OR-groups, e.g. foo=(title=foo1), bar=(title=bar2), foo=(parent.id=1234), bar=(parent.title=Categories)
					(v)		']' as part of sub-selectors , e.g. template=product, company=[locations>5, locations.title%=Finland]
					(vi)	'<' or '>' as part of sub-selectors , e.g. template=product, company=[locations>5, locations.title%=Finland]
				 ***********************************************************************************************************************************************/
				if(preg_match('#(\||-|\(|\)|]|<|>)#', $v)) $sel .= $sanitizer->entities($v) . ', ';//the best we can hope to do here
				else $sel .= $sanitizer->selectorValue($v) . ', ';
			}			
		}

		return rtrim($sel, ', ');

	}	

	/* ######################### - CHECK ACCESS - ######################### */

	/**
	 * Check whether the given Dynamic Selects has access controls.
	 *
	 * The access control, if present, determines what users can view the Dynamic Selects.
	 *
	 * @access public
	 * @param Array $dsSettings Settings of a given Dyanamic Selects.
	 * @return Bool $checkAccess True if access needs to be checked, otherwise false.
	 *
	 */
	public function checkAccess(Array $dsSettings) {
		
		$checkAccess = true;// by default we check for access
		$frontAccess = '';
		
		if(isset($dsSettings['frontAccess'])) $frontAccess = (int) $dsSettings['frontAccess'];

		// if everyone can view this Dynamic Selects don't check access
		if($frontAccess == 3) $checkAccess = false;
		// if only users with permission can view and user has permission to view don't check access
		elseif($frontAccess == 2 && $this->wire('user')->hasPermission('dynamic-selects-front-view')) $checkAccess = false;
		// if only logged in users can view and user is logged in don't check access
		elseif($frontAccess == 1 && $this->wire('user')->isLoggedin()) $checkAccess = false;
		
		return $checkAccess;

	}

	/**
	 * Determine if pages not normally viewable to this user should be removed from results.
	 *
	 * This is for both MarkupDynamicSelects and InputfieldDynamicSelects use.
	 *
	 * @access public
	 * @param Array $dsItem Settings of a dynamic select.
	 * @return Bool True if to remove, otherwise false.
	 *
	 */
	/*public function pageAccessStatus(Array $dsItem) {
		// @note: not in use currently
		if(isset($dsItem['pageAccess']) &&  $dsItem['pageAccess'] == 1) return true;	
		return false;
	}*/

	/* ######################### - OTHER - ######################### */

	/**
	 * Get and format for further use included/excluded items (template,pages, fields)as set by dev/site editor.
	 *
	 * Returns array of columnName=>field IDs to be included/excluded from given column in the Dynamic Selects.
	 *
	 * @access public
	 * @param Array $dsSettings Settings of a Dynamic Selects to filter.
	 * @return Array $filteredIDs List of column name + IDs of items for inclusion/exclusion.
	 *
	 */
	public function filterByIDs(Array $dsSettings) {

		$baseIncludeExcludeKeys = array(
										'includedTemplates' => '',
										'excludedTemplates' => '',
										'includedPages' => '',
										'excludedPages' => '',
										'includedFields' => '',
										'excludedFields' => '',
		);
		
		$masterArray = array_intersect_key(array_replace($baseIncludeExcludeKeys, $dsSettings), $baseIncludeExcludeKeys);

		$filteredIDs = array();
		foreach ($masterArray as $key => $value) {
			foreach (explode("\n", $value) as $c) {
				$index = strtok($c, ',');// first string item in array is the column name where the exclusions apply
				$values = trim(str_replace(array($index, ' '), '' , $c ), ',');
				$filteredIDs[$key][$index] = array_filter(explode(',', $values));// $values is a string
			}			
		}

		return $filteredIDs;

	}

	/**
	 * Return seconds into human readable form
	 *
	 * @credits: adapted from https://snippetsofcode.wordpress.com/2012/08/25/
	 * php-function-to-convert-seconds-into-human-readable-format-months-days-hours-minutes/
	 *
	 * @access private
	 * @param Int $s Seconds (time).
	 * @return $out String Human readable time period.
	 *
	 */
	private function secondsToHumanReadable($s) {

		$out = '';
		
		$secsMin = 60;// seconds in a minute
		$secsHrs = 3600;// ... in an hour
		$secsDay = 86400;// ... in a day
		$secsMnt = 2592000;// ... in a month
		$secsYrs = 31536000;// ... in a year
		
		// calculate time
		$sec = $s % $secsMin ? $s % $secsMin . ' second(s)' : '';
		$min = (floor(($s % $secsHrs) / $secsMin)	> 0) ? 	floor(($s % $secsHrs) / $secsMin) . $this->_(' minute(s)') . ', '	: '';
		$hrs = (floor(($s % $secsDay) / $secsHrs)  	> 0) ? 	floor(($s % $secsDay) / $secsHrs) . $this->_(' hour(s)')   . ', ' 	: '';
		$day = (floor(($s % $secsMnt) / $secsDay) 	> 0) ?	floor(($s % $secsMnt) / $secsDay) . $this->_(' day(s)')    . ', '	: '';
		$mnt = (floor(($s % $secsYrs) / $secsMnt) 	> 0) ?	floor(($s % $secsYrs) / $secsMnt) . $this->_(' month(s)')  . ', '	: '';
		$yrs = (floor($s  / $secsYrs) 				> 0) ?	floor($s  / $secsYrs)			  . $this->_(' year(s)')   . ', '	: '';

		$out = $yrs . $mnt . $day . $hrs . $min . $sec;
				
		return rtrim($out, ', ');

	}	


}