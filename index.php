<?php
require('core/bootstrap.php');

use app\controllers\ChartController;

use app\models\Chart;
use app\core\database\DB;


// $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
// //the file is updated daily between 2.15 p.m. and 3.00 p.m. CET

// $ins_date = $XML->Cube->Cube["time"];


// foreach ($XML->Cube->Cube->Cube as $rate) {

//     if ($rate["currency"] == "RUB")
//     $ins_rate = $rate["rate"];
// }
// die(var_dump($ins_rate));
// ChartController::showChartByDays('cbr_rate', 'Курс EUR Европейский ЦБ', 20);
// $db = new DB;
// var_dump($db->fetchCustomLeft('ecb_rate', 10));

//require ('views/view.index.php');
//require('views/view.dbfetch.php');
