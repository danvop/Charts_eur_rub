<?php
require('core/bootstrap.php');

use app\core\database\DB;

$XML=simplexml_load_file("https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/rub.xml");
$db = new DB;
$start_date = date('2014-01-01');

foreach ($XML->DataSet->Series->Obs as $rate) {
    if ($rate["TIME_PERIOD"] > $start_date) {
        $tmp_date = $tmp_date ?? $rate["TIME_PERIOD"];
        //if rate on date is null
        while ($rate["TIME_PERIOD"] != $tmp_date) {
            // echo "{$tmp_date} {$rate["OBS_VALUE"]}</br>";
            $db->insert('ecb_rate', [
                'date' => $tmp_date,
                'rate' => $rate["OBS_VALUE"]
            ]);
            $tmp_date = date('Y-m-d', strtotime("$tmp_date + 1 day"));
        }
        // echo "{$rate["TIME_PERIOD"]} {$rate["OBS_VALUE"]}</br>";
        //insert to DB
        $db->insert('ecb_rate', [
        'date' => $rate["TIME_PERIOD"],
        'rate' => $rate["OBS_VALUE"]
         ]);
        $tmp_date = date('Y-m-d', strtotime("$tmp_date + 1 day"));
    }
}
