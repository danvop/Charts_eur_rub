<?php
require('core/bootstrap.php');

use app\core\database\DB;

//Помещение в таблицу РУБ - ЕВРО по ЕСВ за текущий день

//This is aPHP(5)script example on how eurofxref-daily.xml can be parsed
//Read eurofxref-daily.xml file in memory
//For the next command you will need the config 
//option allow_url_fopen=On (default)
$XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
//$ins_date = $XML->Cube->Cube["time"];

$db = new DB;
$date = date('Y-m-d');

foreach ($XML->Cube->Cube->Cube as $rate) {
    if ($rate["currency"] == "RUB") {
        //echo "{$date} {$rate["rate"]}</br>";
        $db->insert('ecb_rate', [
        'date' => $date,
        'rate' => $rate["rate"]
         ]);
    }
}
