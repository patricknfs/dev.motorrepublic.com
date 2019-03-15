<?php

/**
* Dynamic Selects: DynamicSelects
*
* This file forms part of the  Dynamic Selects Suite.
* Used in FieldtypeDynamicSelects::.getBlankValue
* Also implements a toString() method for the fieldtype (i.e. used when a field of this type is directly echoed)
* 
* @author Francis Otieno (Kongondo)
* @version 0.0.4
*
* This is a Copyrighted Commercial Module. Please do not distribute or host publicly. The license is not transferable.
*  
* Dynamic Selects for ProcessWire
* Copyright (C) 2016 by Francis Otieno
* Licensed under a Commercial Licence (see README.txt)
*
*/

class DynamicSelects extends WireData {

	/**
	 * Keep a copy of the $page that owns this Dynamic Selects so that we can follow its outputFormatting state and change our output per that state.
	 *
	 */
	protected $page;// @todo...needed?

	/**
	 *
	 */
	public function __construct() {
		// @todo: needed?
		$this->page = wire('page');
	}

	/**
	 * Provide a default rendering for a Dynamic Selects.
	 *	 
	 * Called by toString() method.
	 *
	 * @return String $out Table markup of saved selects/columns and their respective values.
	 *
	 */
	public function renderDynamicSelect() {

		$pages = $this->wire('pages');

		// remember page's output formatting state
		$of = $this->page->of();
		// turn on output formatting for our rendering (if it's not already on)
		if(!$of) $this->page->of(true);

		$out = '';

		$columnNames = $this->columnNames;
		$columnLabels = $this->columnLabels;

		$empty = '<p>' . $this->_('This field is not yet populated') . '</p>';

		if(!count($columnNames)) return $empty;

		$th = '';
		$tbody = '';

		foreach ($columnNames as $key => $property) {
			$th .= '<th>' . $columnLabels[$key] . '</th>';
			$tbody .= '<td>' . $this->$property . '</td>';
		}

		$out .= '<table class="ds">' .
					'<thead>' .
						'<tr>' . $th . '</tr>' .
					'</thead>' .
					'<tbody><tr>' . $tbody . '</tr></tbody>' .
				'</table>'
				;
		
		if(!$of) $this->page->of(false);// turn it off again

		return $out;

	}

	/**
	 * Return a string representing this Dynamic Selects.
	 *
	 * Kicks in if field is directly echoed in the frontend.
	 *
	 * @return method renderDynamicSelect() that outputs table markup of saved columns and their respective values.
	 *
	 */
	public function __toString() {
		return $this->renderDynamicSelect();
	}


}