<?php
// get_row_details.php
// print_r($_GET);
header('Content-type: application/json; charset=utf-8');
session_start();
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php';

// if($_GET){
//   $manufacturer = $_GET['manufacturer'];
// }
// else {
//   $manufacturer = '%';
// }
// echo $manufacturer;

// $where = " WHERE `manufacturer` = '" . $manufacturer . "' ";

// $manufacturer = "ford";

$truncate = "TRUNCATE TABLE `team`.`rates_combined`";
$result2 = $conn->query($truncate) or die(mysqli_error());

$query = "SELECT 
  mr1.code AS `cap_id`, mr1.capcode AS `cap_code`, mr2.src AS source , mr1.man AS `manufacturer`, mr1.mod AS `model`, mr1.cap_desc AS `descr`, mr2.vlp AS `vehicle_list`, mr2.votrp AS `vehicle_otr`, mr2.p11p AS `p11d`, mr2.co2 AS `CO2_no`, mr2.term AS `term`, mr2.mileage AS `mileage`, mr2.rent AS `rental`, `notes`
  FROM
  (
    SELECT 
      `manufacturer` AS `man`, `model` AS `mod`, `description` AS `cap_desc`, `cap_id` AS `code`, `cap_code` AS `capcode`
    FROM
      `team`.`vehicles`
  ) AS mr1
  LEFT JOIN
  (
    (
      SELECT 
        'arval' AS src, '24M' AS `term`, '8K' AS `mileage`, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '24M' AS `term`, '8K' AS `mileage`,`24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '24M' AS `term`, '8K' AS `mileage`,`24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '24M' AS `term`, '8K' AS `mileage`,`24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '24M' AS `term`, '10K' AS `mileage`, `24_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '24M' AS `term`, '15K' AS `mileage`, `24_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '24M' AS `term`, '15K' AS `mileage`,`24_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '24M' AS `term`, '15K' AS `mileage`,`24_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '24M' AS `term`, '15K' AS `mileage`,`24_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '36M' AS `term`, '15K' AS `mileage`, `36_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '36M' AS `term`, '15K' AS `mileage`, `36_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '36M' AS `term`, '15K' AS `mileage`, `36_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '36M' AS `term`, '15K' AS `mileage`, `36_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '48M' AS `term`, '15K' AS `mileage`, `48_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '48M' AS `term`, '15K' AS `mileage`, `48_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '48M' AS `term`, '15K' AS `mileage`, `48_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '48M' AS `term`, '15K' AS `mileage`, `48_15K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '24M' AS `term`, '20K' AS `mileage`, `24_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '24M' AS `term`, '20K' AS `mileage`,`24_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '24M' AS `term`, '20K' AS `mileage`,`24_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '24M' AS `term`, '20K' AS `mileage`,`24_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '36M' AS `term`, '20K' AS `mileage`, `36_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '36M' AS `term`, '20K' AS `mileage`, `36_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '36M' AS `term`, '20K' AS `mileage`, `36_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '36M' AS `term`, '20K' AS `mileage`, `36_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '48M' AS `term`, '20K' AS `mileage`, `48_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '48M' AS `term`, '20K' AS `mileage`, `48_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '48M' AS `term`, '20K' AS `mileage`, `48_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '48M' AS `term`, '20K' AS `mileage`, `48_20K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '24M' AS `term`, '25K' AS `mileage`, `24_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '24M' AS `term`, '25K' AS `mileage`,`24_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '24M' AS `term`, '25K' AS `mileage`,`24_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '24M' AS `term`, '25K' AS `mileage`,`24_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '36M' AS `term`, '25K' AS `mileage`, `36_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '36M' AS `term`, '25K' AS `mileage`, `36_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '36M' AS `term`, '25K' AS `mileage`, `36_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '36M' AS `term`, '25K' AS `mileage`, `36_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '48M' AS `term`, '25K' AS `mileage`, `48_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '48M' AS `term`, '25K' AS `mileage`, `48_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '48M' AS `term`, '25K' AS `mileage`, `48_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '48M' AS `term`, '25K' AS `mileage`, `48_25K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '24M' AS `term`, '30K' AS `mileage`, `24_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '24M' AS `term`, '30K' AS `mileage`,`24_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '24M' AS `term`, '30K' AS `mileage`,`24_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '24M' AS `term`, '30K' AS `mileage`,`24_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '36M' AS `term`, '30K' AS `mileage`, `36_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '36M' AS `term`, '30K' AS `mileage`, `36_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '36M' AS `term`, '30K' AS `mileage`, `36_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '36M' AS `term`, '30K' AS `mileage`, `36_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, '48M' AS `term`, '30K' AS `mileage`, `48_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, '48M' AS `term`, '30K' AS `mileage`, `48_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, '48M' AS `term`, '30K' AS `mileage`, `48_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, '48M' AS `term`, '30K' AS `mileage`, `48_30K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `deal_notes` AS `notes`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
  ) AS mr2
  ON mr1.code = mr2.capid
  -- WHERE mr2.rent IS NOT NULL
  ORDER BY rental DESC
";
// echo $query; 
$result = $conn->query($query) or die(mysqli_error($conn));

// iterate over every row
$row = 1;

while ($row = mysqli_fetch_assoc($result)) {
  // for every field in the result..
  $insert = "INSERT INTO `team`.`rates_combined` VALUES ('','" . $row['cap_id'] . "', '" . $row['cap_code'] . "', '" . $row['source'] . "', '" . $row['manufacturer'] . "', '" . $row['model'] . "', '" . $row['descr'] . "', '" . $row['vehicle_list'] . "', '" . $row['vehicle_otr'] . "', '" . $row['p11d'] . "', '" . $row['CO2_no'] . "', '" . $row['term'] . "', '" . $row['mileage'] . "', '" . $row['rental'] . "')";
  echo $insert;
  $result3 = $conn->query($insert) or die(mysqli_error($conn));
  $row++;
}
