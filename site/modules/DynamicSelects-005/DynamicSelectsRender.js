/** 
*
* Javascript file for the Commercial ProcessWire Module Dynamic Selects (Inputfield)
*
* @author Francis Otieno (Kongondo) <kongondo@gmail.com>
*
* Copyright (C) 2016 by Francis Otieno
*
*/

$(document).ready(function(){

	/*************************************************************/
	// GLOBALS

	urlDynamicSelects = '';
	error = 'There was an error fetching data';
	uid = '';
	dependent = '';
	trigger = '';

	/*************************************************************/
	// GET CONFIGS

	/**
	 * configs from InputfielDynamicSelects
	 *
	 */
	ajaxDynamicSelectsConfig = config.DynamicSelects;

	if(!jQuery.isEmptyObject(ajaxDynamicSelectsConfig)) {
			urlDynamicSelects = ajaxDynamicSelectsConfig.config.ajaxURL;
			if(ajaxDynamicSelectsConfig.config.fetchError) error = ajaxDynamicSelectsConfig.config.fetchError;
	}//end if ajaxDynamicSelectsConfig not empty

	
	/*************************************************************/
	// FUNCTIONS

	/**
	 * Populate debug ordered list.
	 * 
	 * @note: For debugging results/data. Not really for production use!
	 *
	 * @param Int mode Determines whether to empty or populate debug list.
	 * @param Object dependent The dependent select to debug.
	 * @param String dataID The ID of the data item that will populate the dependent select.
	 * @param String datalabel The text of the data item that will populate the dependent select.
	 *
	*/
	resultsDebugger = function(mode, dependent, dataID='', datalabel='') {		
		uid = getUniqueID(dependent);// unique ID for this group of dynamic selects (get from parent 'div')
		var debugList = $("ol[data-debug-ds-id='"+uid+"']");	
		if(!debugList.length) return;
		// empty debug list
		if(mode==1) debugList.empty();
		// populate debug list with results
		else if(mode==2) debugList.append($('<li/>', {text : datalabel + ' ('+dataID+')'}));
	}

	/**
	 * spinner for UX.
	 *
	 * @param Object sp Spinner <i> element to show/hide.
	 * @param String mode Whether to show or hide i element.
	 *
	 */
	spinner = function(sp, mode){				
		if(!sp.length) return;				
		if(mode == 'in')sp.removeClass('ds_spinner');
		else {
				setTimeout(function(){
					$(sp).addClass('ds_spinner');
				},700)
		}
	}

	/**
	 * Resets dependent selects options + removes their duplicates on trigger's/parent's selection change.
	 * 
	 * @note: although we check using 'data-reset', dependents that share a trigger do not affect each other.
	 *
	 * @param Object trigger Select to be used to determine which dependent selects to reset.
	 *
	*/
	resetDependentSelections = function(trigger) {

		// empty debug list if activated
		resultsDebugger(1, trigger);

		var sort = parseInt(trigger.attr('data-reset'));// selected dropdown's sort number from which dependent dropdowns are sought.
		var triggerID = trigger.attr('data-trigger');// An element's 'data-trigger' to determine whether there are adjacent dependent dropdowns
		uid = getUniqueID(trigger);// unique ID for this group of dynamic selects (get from parent 'div')

		// grab all dependent selects in this group [filtering against the one just changed]
		//var a = $("div#" + uid + " select").filter(function() {
		var a = $("div[id='"+uid+"'] select").filter(function() {
			return  $(this).attr('data-reset') > sort;
		});
		// if we found elements, reset them and remove dupes in one swoop
		if (a.length) {
			$(a).each( function() {
				// if adjacent dropdowns share a trigger, don't affect the latter ones; 'continue'
				if($(this).attr('data-trigger') == triggerID) return;
				// reset and remove dupes
				$('option:gt(0)', this).remove();
				//$('option:selected', this).removeAttr('selected');
				if(a.attr('data-hide') == 1) a.closest('label').addClass('ds_empty');
			});
		}
	}

	/**
	 * Build dynamic selects.
	 * 
	 * @param Object dependent Dependent select to populate.
	 * @param Object data JSON with data to build select options.
	 * @param String dataObj value of the option that triggered the dependent select.
	 *
	*/
	buildSelects = function(dependent, data, dataObj = ''){

		// if using raw JS
		/*for (var key in makes) {
			var make = makes[key];
		}*/
		
		// grab the CACHE attribute of the select to populate
		//var dependentColumnID = dependent.attr('id');
		var dependentColumnDataCache = dependent.attr('data-cache');

		// USING jQuery: looping through JSON data to create <options> for each of our selects
		$.each(data, function (index, value) {
			//if(index == 'message' || index == 'sort') return;
			if(index == 'message' || index == 'selectid') return;
			$(dependent).append($('<option/>', { 
				value: index,
				text : value
			}));

			// update 'local cache' (only if we got data from ajax) so that next time we get data from this 'local cache'
			if(dataObj) {
				//$('ul[data-select-id='+dependentColumnID+']').append($('<li/>', {
				$('ul[data-select-cache='+dependentColumnDataCache+']').append($('<li/>', {
					'data-select-option-trigger': dataObj,
					'data-select-option-value': index,
					text : value
				}));
			}// end if dataObj

			// build debug list if activated
			resultsDebugger(2, dependent, index, value);

		})// end each data

	}

	/**
	 * Get the uniqueid of the given select.
	 *	 
	 * @param Object sel Selected <select>.
	 *
	*/
	getUniqueID = function(sel) {
		uid = $(sel).closest('div.ds').attr('id');
		return uid;
	}

	/**
	 * Fetch JSON data from server.
	 *	 
	 * @param Object trigger Selected Trigger.
	 * @param Object dependent Depedendent Select dropdown.
	 *
	*/
	getData = function(trigger, dependent) {

		var dataUniqueID = getUniqueID(trigger);
			
		// TRIGGER SELECT
		var dataObj = trigger.val();// page|template|field|user ID
		var triggerColumnID = trigger.attr('id');		

		// DEPENDENT SELECT
		var dependentColumnID = dependent.attr('id');

		// CACHE SOURCE
		var dependentColumnDataCache = dependent.attr('data-cache');

		var sp = $('span#' + dependentColumnID + '_spinner i');

		// @note: first check if data in cache (hidden element on page) - if none, make we'll fetch from server (ajax request)
		//var cachedData = $('ul[data-select-id='+dependentColumnID+']').children("li[data-select-option-trigger='"+dataObj+"']");
		var cachedData = $('ul[data-select-cache='+dependentColumnDataCache+']').children("li[data-select-option-trigger='"+dataObj+"']");
		// grab from cache if found
		if(cachedData.length) {
			var data = {};// @note: empty object
			$(cachedData).each(function(){
				data[$(this).attr('data-select-option-value')] = $(this).text();// populate object
			});
			
			// build selects from 'local cache'
			spinner(sp, mode='in');
			buildSelects(dependent, data);// @note: we will also update our cache
			spinner(sp, mode='out');

		}
		
		// build selects from ajax
		else {

				$.ajax({
							url: urlDynamicSelects,
							type: 'POST',
							data: {
									dataUniqueID:dataUniqueID,
									// trigger select
									dataObj:dataObj,
									triggerColumn:triggerColumnID,
									// dependent select
									dependentColumn: dependentColumnID,
							},   
							dataType: 'json',
							beforeSend: spinner(sp, mode='in'),
						})
						
						.done(function(data) {
								// @note: [dependentColumnID] is variable above!
								if(data[dependentColumnID] && data[dependentColumnID].message == 'success') {
									// build selects from ajax
									buildSelects(dependent, data[dependentColumnID], dataObj);
									spinner(sp, mode='out');
								}
								else alert(error);
						})
						.fail(function() {alert(error); })

		}

	}// end getData()

});


/*************************************************************/
// INIT

/* ## On load page request dependent selects data if their trigger has a selection saved (option:selected) ## **/
// helps prevent having to deselect then reselect a trigger option for its dependents to be loaded
$(document).ready(function(){
	var sels = $('select.ds');
	if(sels.length) {
		$(sels).each(function() {
			var v = parseInt(sels.val());
			if(v) {
					var id = $(this).attr('id');// @note: ID matches the respective column name
					dependent = $('select[data-trigger='+id+']');
					trigger = $(this);

					// if we got triggered elements, request their respective data
					if (dependent.length) {
						$(dependent).each( function() {
							if (dependent.find('option').length > 1) return;// if select already populated, nothing to do, return ('continue')
							if(trigger.val() == 0) return;// if first option ('please select') don't make ajax/cache request
							getData(trigger, dependent);
						})
					}
			}

		})
	}// end if sels.length

});


/*************************************************************/
// SELECTS CHANGE

/* ## request data from server/cache 'on change' dynamic selects ## **/
$(document).on('change', 'select.ds', function() {
	
	//	1. first clear older selections in all dependent dropdowns
	trigger = $(this);
	// execute reset
	resetDependentSelections(trigger);
	
	// 2. secondly, find the child(ren) select(s), i.e. the one(s) that has/have been triggered
	// triggered elements have a data attribute [data-trigger] whose value equals THE ID of their parent dropdown/select/trigger

	/** if option is the first one, i.e. 'please select', we don't send any request **/
	if(trigger.val() == 0) return false;

	/** request data **/
	
	// id of the trigger select/dropdown
	var id = trigger.attr('id');// @note: ID matches the respective column name
	dependent = $('select[data-trigger='+id+']');
	var hide = trigger.attr('data-hide');
	
	// if we got triggered elements, request their respective data
	if (dependent.length) {
		// empty debug list if activated
		resultsDebugger(1, dependent);	
		$(dependent).each( function() {
			if(hide) dependent.closest('label.ds_empty').removeClass('ds_empty');
			getData(trigger, dependent);
		})
	}

});