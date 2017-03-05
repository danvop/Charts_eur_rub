<?php
require('core/bootstrap.php');

use app\core\database\DB;

$XML=simplexml_load_file("https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/rub.xml");
$db = new DB;
foreach ($XML->DataSet->Series->Obs as $rate) {
    if ($rate["TIME_PERIOD"] > '2014-01-02') {
        //insert to DB
        $db->insert('ecb_rate', [
        'date' => $rate["TIME_PERIOD"],
        'rate' => $rate["OBS_VALUE"]
         ]);
    }
    
    // echo $rate["TIME_PERIOD"].' '.'1&euro;='.' '.$rate["OBS_VALUE"].'<br/>';
}
