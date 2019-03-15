<?php

/**
* Dynamic Selects: Installer
*
* This file forms part of the Dynamic Selects Suite.
* It is an install wizard for Dynamic Selects and is only run once when installing the module.
* It installs a field and template required for 'dynamic selects pages'.
* If the above already exist (i.e., same names); this installer aborts wholesale.
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

class DynamicSelectsInstaller extends WireData {

	const PAGE_NAME = 'dynamic-selects';// the process' name

	/**
	 * Check if similar field, template and dynamic selects page exist before install.
	 *
	 * @access public
	 * @param null|integer $mode Whether to verify install possible (null) or commence install (1).
	 * @return If $mode == 1: $this->createFields(); if null: true|WireException depending on validity of install.
	 *
	 */	
	public function verifyInstall($mode = null) {

		// if we have already verified install, proceed directly to first step of installer
		if($mode == 1) return $this->createFields();

		// 1. ###### First we check if Dynamic Selects Admin page, field and template already exist. 
		// If yes to any of these, we abort installation and return error messages	

		// check if Dynamic Selects page already exists in Admin
		$pageCheck = '';
		$parent = $this->pages->get($this->config->adminRootPageID);
		$page = $this->pages->get("parent=$parent, template=admin, include=all, name=".self::PAGE_NAME);
		if($page->id && $page->id > 0) $pageCheck = $page->title;

		// check for if page, field and template identical to those needed by Dynamic Selects already in use
		$pageExists = $pageCheck ? true : false;
		$fieldExists = $this->wire('fields')->get('ds_settings') ? true : false;
		$templateExists = $this->wire('templates')->get('dynamic-selects') ? true : false;
		
		if($pageExists) $this->error($this->_("Dynamic Selects: Cannot install Dynamic Selects Admin page. A page named 'dynamic-selects' is already in use under Admin."));
		if($fieldExists) $this->error($this->_("Dynamic Selects: Cannot install the Dynamic Selects field. An identical field called 'ds_settings' is already in use."));
		if($templateExists)	$this->error($this->_("Dynamic Selects: Cannot install the Dynamic Selects template. An identical template called 'dynamic-selects' is already in use."));

		//if any of our checks returned true, we abort early
		if($pageExists || $fieldExists || $templateExists) {
			throw new WireException($this->_('Dynamic Selects: Due to the above errors, Dynamic Selects did not install. Make necessary changes and try again.'));
			//due to above errors, we stop executing install of the following 'templates', 'fields' and 'pages'
		}
	
		// if no errors, pass on to first step of install
		// return true to OK first step of install
		return true;
	
	}

	/**
	 * Create the Dynamic Selects settings field.
	 *
	 * @access private
	 * @return $this->createTemplates().
	 *
	 */	
	private function createFields() {

		// 2. ###### We create the field we will need to add to the dynamic selects template ######
		
		// create the ds_settings field
		// field will hold individual settings for each dynamic select created in ProcessDynamicSelects		
		$f = new Field(); // create new field object
		$f->type = $this->wire('modules')->get('FieldtypeTextarea');
		$f->name = 'ds_settings';
		$f->label = 'Dynamic Selects Settings';
		$f->description = $this->_("JSON values of this dynamic selects' settings. You don't need to edit these directly. Use ProcessDynamicSelects instead.");
		$f->collapsed = 5;// collapsed when populated
		$f->rows = 10;
		$f->tags = '-dynamic-selects';
		$f->save();

		// grab our newly created field and the title field, assigning them to variables. We'll later add the fields to our templates
		$f = $this->wire('fields');

		// set some Class properties on the fly. We will use this in createTemplates()
		$this->title = $f->get('title');
		$this->settings = $f->get('ds_settings');

		// lets create some templates and add our fields to them
		return $this->createTemplates();

	}

	/**
	 * Create Dynamic Selects template.
	 *
	 * Create the template to be used by dyanamic selects pages.
	 * @see https://processwire.com/talk/topic/12130-process-module-with-certain-permission-not-showing-up/?p=112674
	 * @access private
	 *
	 */	
	private function createTemplates() {

		// 3. ###### We create the one template needed by Dynamic Selects ######

		/** create our the one template to be used by dynamic selects pages **/
		// new fieldgroup
		$fg = new Fieldgroup();
		$fg->name = 'dynamic-selects';

		// add title and ds_settings field to the template 'dynamic-selects'
		$fg->add($this->title);
		$fg->add($this->settings);

		// save fieldgroup
		$fg->save();
		
		// create a new template to use with this fieldgroup
		$t = new Template();
		$t->name = 'dynamic-selects';
		$t->fieldgroup = $fg;// add the fieldgroup

		// add template settings we need
		$t->label = 'Dynamic Selects';
		$t->noChildren = 1;// the pages using this template should not have children
		$t->parentTemplates = array($this->wire('templates')->get('admin')->id);// needs to be added as array of template IDs. Allowed template for parents = 'admin'
		$t->tags = '-dynamic-selects';

		// save new template with fields and settings now added
		$t->save();
		$this->message('Dynamic Selects: Created Template Dynamic Selects');

	}

	

}