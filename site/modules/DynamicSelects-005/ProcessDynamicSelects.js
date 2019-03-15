/** 
*
* Javascript file for the Commercial ProcessWire Module Dynamic Selects (Process)
*
* @author Francis Otieno (Kongondo) <kongondo@gmail.com>
*
* Copyright (C) 2016 by Francis Otieno
*
*/
$(document).ready(function(){	
	
	/* 01. #### WIRE TABS #### */
	initVariationsWireTabs();
	
	/* 02. #### MarkupAdminDataTable #### */

	/** Fix for MarkupAdminDataTable: Don't enable sorting on first column with input checkbox **/
	// disable sorting on first column of MarkupAdminDataTable
	if ($.tablesorter != undefined) $.tablesorter.defaults.headers = {0:{sorter:false}};	

	/* on change in select to limit menus show in table */
	//note: broken in PW dev 2.5.7. See issue #784 on GitHub - removeClass() fix
	$('#limit').change(function(){ $(this).closest("form").removeClass("nosubmit").submit(); });//note workaround for PW issue #784 (GitHub)

	
	/* 03. #### DELETE DYNAMIC SELECTS TAB #### */

	// trigger a submit_delete submission. this is necessary because when submit_delete is an <input type='submit'> then 
	// some browsers call it (rather than submit_save) when the enter key is pressed in a text field. This solution
	// by passes that undesirable behavior. 
	$("#ds_delete").click(function() {
		if(!$("#ds_delete_confirm").is(":checked")) {
			$("#wrap_ds_delete_confirm label").effect('highlight', {}, 500); 
			return;
		}
		$(this).before("<input type='hidden' name='ds_delete' value='1'>"); 
		$("#DynamicSelectsEdit").submit();
	});

		
});// end jQuery

/** Toggle all checkboxes in the list of Dynamic Selects tables **/
$(document).on('change', 'input.toggle_all', function() {
	if ($(this).prop('checked')) $('input.toggle').prop('checked', true);
	else $('input.toggle').prop('checked', false);
});

/**
 * Initialise JqueryWireTabs.
 *
 * We use that to set a cookie to remember accordions state.  
 *
*/
initVariationsWireTabs = function() {
	var form = $("form#DynamicSelectsEdit");	
	// remove scripts, because they've already been executed since we are manipulating the DOM below (WireTabs)
	// which would cause any scripts to get executed twice
	form.find('script').remove();

	form.WireTabs({
		items: $(".WireTab"),
		skipRememberTabIDs: ['ProcessDynamicSelectsDelete', 'ProcessDynamicSelectsSettings'],
		rememberTabs: true
		//rememberTabs: false
	});
}