<?php

/**
* Dynamic Selects: Cleanup.
*
* This file forms part of the Dynamic Selects Suite.
* Utility to remove Dynamic Selects components when the module is uninstalled.
* The utility will irreversibly delete the following Dynamic Selects Components:
* 	1 Field: 'ds_settings'
*	1 Template: 'dynamic-selects'
*	1 Permission: 'dynamic-selects'
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

class DynamicSelectsCleanup extends WireData {

	const PAGE_NAME = 'dynamic-selects';// the process' name

	/**
	 * Prepare cleaning up.
	 *
	 * @access public
	 * @param Int $moduleID The ID of the module whose components we will uninstall.
	 * @return $this->cleanUpPages().
	 *
	 */	
	public function cleanUp($moduleID) {
		// proceed if we got a module ID
		if($moduleID) return $this->cleanUpPages($moduleID);
	}

	/**
	 * Delete Dynamic Selects pages.
	 *
	 * @access private
	 * @param Int $moduleID The ID of the Dynamic Selects Process module whose pages we will be deleting.
	 * @return $this->cleanUpPermissions().
	 *
	 */
	private function cleanUpPages($moduleID) {
		
		$page = $this->pages->get("template=admin, process=$moduleID, name=" . self::PAGE_NAME); 	
		
		if($page->id) {
			// if we found the page, let the user know and delete it
			$this->message($this->_('Dynamic Selects: Deleted Page ') . $page->path); 
			// recursively delete the Dynamic Selects page (i.e. including all its children (the dynamic selects))
			$this->wire('pages')->delete($page, true);
			// also delete any dynamic selects pages that may have been left in the trash
			foreach ($this->wire('pages')->find('template=dynamic-selects, status>=' . Page::statusTrash) as $p) $p->delete();
		}

		return $this->cleanUpPermissions();

	}

	/**
	 * Delete Dynamic Selects permission.
	 *
	 * @access private
	 * @return $this->cleanUpTemplates().
	 *
	 */
	private function cleanUpPermissions() {
		// find and delete the Dynamic Selects permission the module installed (not custom ones!) and let the user know
		$permission = $this->wire('permissions')->get('dynamic-selects');
		if ($permission->id){
			$permission->delete();
			$this->message('Dynamic Selects: Deleted Permission dynamic-selects');
		}
		return $this->cleanUpTemplates();

	}

	/**
	 * Delete Dynamic Selects template.
	 *
	 * @access private
	 * @return $this->cleanUpFields().
	 *
	 */
	private function cleanUpTemplates() {
		// find and delete our 1 dynamic selects template
		$t = $this->wire('templates')->get('dynamic-selects');
		if ($t->id) {
			$this->wire('templates')->delete($t);
			$this->wire('fieldgroups')->delete($t->fieldgroup);// delete the associated fieldgroup
			$this->message('Dynamic Selects: Deleted Template Dynamic Selects');
		}

		return $this->cleanUpFields();

	}

	/**
	 * Delete Dynamic Selects field.
	 *
	 * @access private
	 *
	 */
	private function cleanUpFields() {
		// find and delete the 1 field used by our dynamic selects
		$f = $this->wire('fields')->get('ds_settings');
		if($f->id) $this->wire('fields')->delete($f);
		$this->message('Dynamic Selects: Deleted Field ds_settings');
	}	


}