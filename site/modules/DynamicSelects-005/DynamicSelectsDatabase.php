<?php

/**
* Dynamic Selects: Database
*
* This file forms part of the Dynamic Selects Suite.
* Executes various Database CRUD operations on demand.
* Creates, Updates or Deletes database columns for FieldtypeDynamicSelects to match field settings.
* This is because the fields database schema cannot be determined in advance and depends of the field settings.
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

class DynamicSelectsDatabase extends WireData {

	/**
	 * Set some key properties for use throughout the class.
	 *
	 * @access public
	 *
	 */
	public function __construct() {
		parent::__construct();
	}


/* ######################### - DATABASE OPERATIONS - ######################### */
	
	/**
	 * Create database columns for each Dynamic Selects column.
	 *
	 * Alter this field's db table.
	 *
	 * @access public
	 * @param Array $columns Names of db columns to be created in this field's table.
	 * @param Object $field This FieldtypeDynamicSelect.
	 *
	 */
	public function dbCreateColumns(Array $columns, $field) {

		$database = $this->wire('database');
		$table = $database->escapeTable($field->getTable());

		foreach ($columns as $columnName) {
			try {
					$sql = "ALTER TABLE `$table` 
								ADD COLUMN `$columnName` INT UNSIGNED DEFAULT NULL,
								ADD INDEX `$columnName` (`$columnName`)
					";

					$query = $database->prepare($sql); 
					$query->execute();
			}
			catch(Exception $e) {
					$this->error($e->getMessage());
			}
		}

	}

	/**
	 * Update database columns for each specified Dynamic Selects column.
	 *
	 * Alter this field's db table.
	 * Renaming column names.
	 *
	 * @access public
	 * @param Array $columns of names of db columns to be renamed in this field's table.
	 * @param Object $field This FieldtypeDynamicSelect.
	 *
	 */
	public function dbUpdateColumns(Array $columns, $field) {

		$database = $this->wire('database');
		$table = $database->escapeTable($field->getTable());

		// @note: $columns array structure is ['oldName'] => 'newName'
		foreach ($columns as $oldName => $newName) {

			// first we drop the old index
			try {
					$sql = "ALTER TABLE `$table` 
								DROP INDEX `$oldName`";

					$query = $database->prepare($sql); 
					$query->execute();
			}
			catch(Exception $e) {
					$this->error($e->getMessage());
			}

			// second: change column name + create new index
			try{

					$sql = "ALTER TABLE `$table` 
								CHANGE COLUMN `$oldName` `$newName` INT UNSIGNED DEFAULT NULL,
								ADD INDEX `$newName` (`$newName`)
					";

					$query = $database->prepare($sql); 
					$query->execute();
			}
			catch(Exception $e) {
				$this->error($e->getMessage());
			}

		}

	}

	/**
	 * Delete database columns for each specified Dynamic Selects column.
	 *
	 * Alter this field's db table.
	 *
	 * @access public
	 * @param Array $columns of names of db columns to be deleted from this field's table.
	 * @param Object $field This FieldtypeDynamicSelect.
	 *
	 */
	public function dbDeleteColumns(Array $columns, $field) {

		// @note: we only execute query if user confirms form submission
		$database = $this->wire('database');
		$table = $database->escapeTable($field->getTable());

		foreach ($columns as $columName) {
			try {
					$sql = "ALTER TABLE `$table` 
								DROP COLUMN `$columName`
					";// @note: column index dropped automatically since no other columns in that index

					$query = $database->prepare($sql); 
					$query->execute();
			}
			catch(Exception $e) {
					$this->error($e->getMessage());
			}
		}

	}

	


}