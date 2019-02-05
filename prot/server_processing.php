<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/site/templates/inc/config.php');
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'rates_combined';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'src',	'dt' => 'src' ),
	array( 'db' => 'updated',	'dt' => 'updated' ),
	array( 'db' => 'cap_id', 'dt' => 'cap_id' ),
	array( 'db' => 'cap_code',	'dt' => 'cap_code' ),
	array( 'db' => 'manufacturer',	'dt' => 'manufacturer' ),
	array( 'db' => 'model',	'dt' => 'model' ),
	array( 'db' => 'descr',	'dt' => 'descr' ),
	array( 'db' => 'term',	'dt' => 'term' ),
	array( 'db' => 'mileage',	'dt' => 'mileage' ),
	array( 'db' => 'rental',	'dt' => 'rental' ),
	array( 'db' => 'vehicle_list_price', 'dt' => 'vehicle_list_price' ),
	array( 'db' => 'vehicle_otr_price', 'dt' => 'vehicle_otr_price' ),
	array( 'db' => 'p11d_price', 'dt' => 'p11d_price' ),
	array( 'db' => 'CO2', 'dt' => 'CO2' )
);

// SQL server connection information
$sql_details = array(
	'user' => MR_DB_USERNAME,
	'pass' => MR_DB_PASSWORD,
	'db'   => 'team',
	'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( MR_PATH . '/inc/ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);