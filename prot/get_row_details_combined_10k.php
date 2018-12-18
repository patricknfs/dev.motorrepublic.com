<?php
// get_row_details.php
// print_r($_GET);
header('Content-type: application/json; charset=utf-8');
session_start();
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php';
echo memory_get_usage() . "\n";
$query = "SELECT 
  mr1.code AS `cap_id`, mr1.capcode AS `cap_code`,  mr2.src AS src , mr2.updated AS `updated`, mr1.man AS `manufacturer`, mr1.mod AS `model`, mr1.cap_desc AS `descr`, mr2.vlp AS `vehicle_list`, mr2.votrp AS `vehicle_otr`, mr2.p11p AS `p11d`, mr2.co2 AS `CO2_no`, mr2.term AS `term`, mr2.mileage AS `mileage`, mr2.rent AS `rental`, mr2.lcv AS `lcv`
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
        'arval' AS src, `updated`, '24M' AS `term`, '10K' AS `mileage`, `24_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, `updated`, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, `updated`, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, `updated`, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ogilvie' AS src, `updated`, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_ogilvie` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'lex' AS src, `updated`, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_lex` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'alphabet' AS src, `updated`, '24M' AS `term`, '10K' AS `mileage`,`24_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_alphabet` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, `updated`, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, `updated`, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, `updated`, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, `updated`, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ogilvie' AS src, `updated`, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_ogilvie` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'lex' AS src, `updated`, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_lex` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'alphabet' AS src, `updated`, '36M' AS `term`, '10K' AS `mileage`, `36_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_alphabet` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
        'arval' AS src, `updated`, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_arval` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ald' AS src, `updated`, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_ald` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, `updated`, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_hitachi` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'leaseplan' AS src, `updated`, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_leaseplan` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'ogilvie' AS src, `updated`, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_ogilvie` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'lex' AS src, `updated`, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_lex` HAVING rent IS NOT NULL
    )
    UNION
    (
      SELECT 
      'alphabet' AS src, `updated`, '48M' AS `term`, '10K' AS `mileage`, `48_10K_PA_rental_m` AS rent, `cap_id` AS `capid`, `vehicle_list_price` AS `vlp`, `vehicle_otr_price` AS `votrp`, `p11d_price` AS `p11p`, `CO2` as `co2`, `lcv` AS `lcv`
      FROM
        `team`.`rates_alphabet` HAVING rent IS NOT NULL
    )
  ) AS mr2
  ON mr1.code = mr2.capid
  WHERE mr1.code = mr2.capid
  ORDER BY rental DESC
";
// echo $query; 
$result = $conn->query($query) or die(mysqli_error($conn));

// iterate over every row
$row = 1;

while ($row = mysqli_fetch_assoc($result)) {
  // for every field in the result..
  $insert = "INSERT INTO `team`.`rates_combined` VALUES ('','" . $row['cap_id'] . "', '" . $row['cap_code'] . "', '" . $row['src'] . "', '" . $row['updated'] . "', '" . $row['manufacturer'] . "', '" . $row['model'] . "', '" . $row['descr'] . "', '" . $row['term'] . "', '" . $row['mileage'] . "', '" . $row['rental'] . "', '" . $row['vehicle_list'] . "', '" . $row['vehicle_otr'] . "', '" . $row['p11d'] . "', '" . $row['CO2_no'] . "', '" . $row['lcv'] . "')";
  // echo $insert;
  $result3 = $conn->query($insert) or die(mysqli_error($conn));
  $row++;
}
// Free result set
mysqli_free_result($result3);
echo memory_get_usage() . "\n";