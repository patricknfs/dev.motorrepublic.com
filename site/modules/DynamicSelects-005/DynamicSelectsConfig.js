/** 
*
* Inline Javascript file for the Commercial ProcessWire Module Dynamic Selects
*
* @author Francis Otieno (Kongondo) <kongondo@gmail.com>
*
* Copyright (C) 2016 by Francis Otieno
*
*/
$(document).ready(function(){

	/*************************************************************/
	//FUNCTIONS

	// add a row to field settings table
	clonePageRow = function() {
			
		$tr = $('table#ds_settings_table tr:last');
		$clone = $tr.clone(true);
		//$clone.find('input[type=text]').attr('value','');
		$clone.find('input').attr('value','');

		$('table#ds_settings_table').append($clone);
		$clone.find('input:first').focus();

		// row count: increment per clone
		$tds = $clone.find('td.move');
		if($tds.length) {
			$tds.each( function() {
				int = parseInt($(this).text()) + 1;// increment int
				$(this).text(int);
			})
		};

		// on clone apply background color to empty required inputs
		var i = $clone.find('input.ds_required');
		requiredBackgroundColor(i);

		// helper: assume clone ds_trigger is previous (cloned) column hence if not empty apply it to clone's trigger input
		var trigger = $tr.find('input.ds_required');
		if(trigger.val()) $clone.find('input.ds_trigger').val(trigger.val()).css('background-color', '');

		return false;
	}

	// apply background color to required inputs in field settings table
	requiredBackgroundColor = function(i) {
			
		// apply background color to empty required inputs
		i.css('background-color', '').filter(function () {
			return $.trim(this.value) === '';
		}).css('background-color', '#fed6da');

		// detect input changes on required fields and change background-color if input not empty
		i.on('input', function() {
			if($(this).val() == '') $(this).css('background-color', '#fed6da')
			else $(this).css('background-color', '')
		});

	}

	// disable invalid data-relationship vs data-sources
	disableInvalidDataSources = function(sel, c=0) {

		// find selected <option> in the given select with class .ds_relationship
		var selectedOpt = $(sel).find(':selected');
		// get its CSS class
		var selectedOptClass = selectedOpt.attr('class');
		// find selected options parent table row
		var row = $(selectedOpt).closest('tr');
		
		var dataSourceSelect = $(row).find('select.ds_datasource');
		// remove all 'disabled' attributes first
		$('option', dataSourceSelect).removeAttr('disabled');
		// if 'on change mode', remove 'selected' attribute from previously selected option in data-source select...
		// if it is not a valid data-source for current data-relationship...
		// then add selected to first valid data-source
		if(c) {
			var dataSourceSelectedOpt = $('option:selected', dataSourceSelect);

			if (!dataSourceSelectedOpt.hasClass(selectedOptClass + '_source')) {
				$('option:selected', dataSourceSelect).removeAttr('selected');
				$('option.' + selectedOptClass + '_source:first', dataSourceSelect).attr('selected', 'selected');
			}

		}
		// filter out valid data-sources for selected relationship and disable invalid ones
		$('option', dataSourceSelect).not('.' + selectedOptClass + '_source').attr('disabled','disabled');

	}

	// confirm delete of db columns
	confirmDBColumnsDelete = function(e, deleteColumns) {

		listDBColumnsToDelete(deleteColumns);

		var confirm = $('input#ds_confirm');

		$('div#ds_db_column_delete_confirm').dialog({
			resizable: false,
			height: 'auto',
			width: 700,// @todo...maybe auto?
			modal: true,
			buttons: {
					Save: function() {
						$(this).dialog('close');
						$(confirm).val(1);// set confirm to true
						submitForm();
					},
					Cancel: function() {
							$(this).dialog('close');
							cancelDBColumnsDelete();
					}
			}
		});

	}

	// submit form executing db schema changes
	submitForm = function() {
			$('button#Inputfield_submit_save_field').trigger('click');
	}

	// cleanup after cancelling db columns delete
	cancelDBColumnsDelete = function() {
		$('table#ds_settings_table tr').removeClass('DSTBD ui-state-error');
		var delInputs = $('input.ds_delete');
		delInputs.each(function() {
			delInputs.val(0);
		});
	}

	// list db columns set to be deleted if confirmed
	listDBColumnsToDelete = function(deleteColumns) {
		$('ol#newList').remove();// remove previously appended
		$('div#ds_db_column_delete_confirm').append("<ol id='newList' style='padding:10px; color:#ec0000;'></ol>");

		$.each(deleteColumns, function (index, value) {
			$('ol#newList').append('<li style="margin:0 10px; list-style:decimal inside;">'+value+'</li>');
		})		
	}


});

/*************************************************************/

// apply 'move cursor' to first td in column settings table
$(document).ready(function(){
	$('td.move').css('cursor', 'move');
});

// disable invalid data-relationship vs data-sources
$(document).ready(function() {
	var relationshipsSelect = $('select.ds_relationship');
	
	// on load operation
	relationshipsSelect.each(function() {
		disableInvalidDataSources($(this));
	});

	// same as above but for on change event
	$(document).on('change', 'select.ds_relationship', function() {
		disableInvalidDataSources($(this), 1);
	});

});

// delete table rows prep
// @rc (events fieldtype)
$(document).ready(function() {

	$(document).on('click', '#ds_settings_table a.ds_delete', function(e) {
		var $row = $(this).parents('tr.ds_row');
		if($row.size() == 0) {
			// delete all
			$(this).parents('thead').next('tbody').find('.ds_delete').click();
			return false;
		}
		var $input = $(this).next('input');
		if($input.val() == 1) {
			$input.val(0);
			$row.removeClass('DSTBD ui-state-error');
		}
		else {
			$input.val(1);
			$row.addClass('DSTBD ui-state-error');
		}
		return false;
	});

	// Add column - clone the last tr of the table to add extra/new select columns
	$('.addcolumn').click(clonePageRow);
});

/* sortable table of column settings */
// + fixed width fix
// + @credits: https://paulund.co.uk/fixed-width-sortable-tables
$(document).ready(function() {
	$('table.sortable tbody').sortable({
		containment: 'parent',
		helper: fixWidthHelper
	}).disableSelection();

	// fixed width solution
	function fixWidthHelper(e, ui) {
		ui.children().each(function() {
			$(this).width($(this).width());
		});
		return ui;
	}
});

// on load apply background color to empty 'required inputs'
// also detect input changes on required fields and change background-color if input not empty
$(document).ready(function() {
	var i = $('input.ds_required');
	requiredBackgroundColor(i);
});

// confirm deletion of db columns
$(document).ready(function() {
	$("button[name='submit_save_field']").click(function(e){
  		var confirm = $('input#ds_confirm');
  		var deleteColumns = [];
		var del = $('input.ds_delete');

		$(del).each(function() {
			var value = parseInt($(this).val());
			if (value === 1) {
				// find parent table row of column to be deleted
				var row = $(this).closest('tr');
				var columnDel = $(row).find("input[name='ds_name[]']");
				// gather names of columns to be deleted
				deleteColumns.push(columnDel.val());
			}
		});
	
		// if changes to database schema will occur, don't submit form until confirmed
		if (deleteColumns.length !== 0)	{
			if( $(confirm).val()==0 ) {
				confirmDBColumnsDelete(e, deleteColumns);
				return false;
			}
		}
  			
 	}); 
});









