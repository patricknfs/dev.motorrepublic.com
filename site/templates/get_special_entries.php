<?php
// get_row_details.php
// print_r($_GET);
header('Content-type: application/json; charset=utf-8');
// session_start();
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php';

foreach($forms->get("specials_upload")->entries->find() as $e){
  $insert = "INSERT INTO `team`.`rates_combined` VALUES ('','" . $e['cap_id'] . "', '" . $e['cap_code'] . "', '" . $e['source'] . "', '" . $e['updated'] . "', '" . strtoupper($e['manufacturer']) . "', '" . $e['model'] . "', '" . $e['description_1'] . "', '" . $e['term'] . "', '" . $e['mileage'] . "', '" . $e['rental'] . "', '" . $e['vehicle_list_price'] . "', '" . $e['vehicle_otr_price'] . "', '" . $e['p11d_price'] . "', '" . $e['co2'] . "', '" . $e['lcv'] . "'), TRUE";
  echo $insert;
  $result3 = $conn->query($insert) or die(mysqli_error($conn));
}


// $query = "SELECT 
//   mr1.code AS `cap_id`, mr1.capcode AS `cap_code`, mr2.src AS source , mr1.man AS `manufacturer`, mr1.mod AS `model`, mr1.cap_desc AS `descr`, mr2.vlp AS `vehicle_list`, mr2.votrp AS `vehicle_otr`, mr2.p11p AS `p11d`, mr2.co2 AS `CO2_no`, mr2.term AS `term`, mr2.mileage AS `mileage`, mr2.rent AS `rental`
//   FROM
//   (
//     SELECT 
//       `manufacturer` AS `man`, `model` AS `mod`, `description` AS `cap_desc`, `cap_id` AS `code`, `cap_code` AS `capcode`
//     FROM
//       `team`.`vehicles`
//   ) AS mr1
//   LEFT JOIN
//   (
//     (
//       SELECT 
//         'arval' AS src, '24M' AS `term`, '8K' AS `mileage`, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_arval` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'ald' AS src, '24M' AS `term`, '8K' AS `mileage`,`24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_ald` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'hitachi' AS src, '24M' AS `term`, '8K' AS `mileage`,`24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_hitachi` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'leaseplan' AS src, '24M' AS `term`, '8K' AS `mileage`,`24_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_leaseplan` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//         'arval' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_arval` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'ald' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_ald` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'hitachi' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_hitachi` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'leaseplan' AS src, '36M' AS `term`, '8K' AS `mileage`, `36_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_leaseplan` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//         'arval' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_arval` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'ald' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_ald` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'hitachi' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_hitachi` HAVING rent IS NOT NULL
//     )
//     UNION
//     (
//       SELECT 
//       'leaseplan' AS src, '48M' AS `term`, '8K' AS `mileage`, `48_8K_PA_rental_m` AS rent, `cap_id` AS `cap_id`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`
//       FROM
//         `team`.`rates_leaseplan` HAVING rent IS NOT NULL
//     )
//   ) AS mr2
//   ON mr1.code = mr2.capid
// ";
// // echo $query; 
// $result = $conn->query($query) or die(mysqli_error($conn));

// // iterate over every row
// $row = 1;



// mysqli_close($conn);