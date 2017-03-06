<?php
require('core/bootstrap.php');

use app\controllers\ChartController;

use app\models\Chart;
use app\core\database\DB;

// ChartController::showChartByDays('ecb_rate', 'Курс EUR Европейский ЦБ', 20);
$db = new DB;
var_dump($db->fetchCustomLeft('dates', 'ecb_rate', 10));

//require ('views/view.index.php');
//require('views/view.dbfetch.php');
