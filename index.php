<?php
require('core/bootstrap.php');

use app\controllers\ChartController;

use app\models\Chart;
use app\core\database\DB;

$days = $_GET['days'] ?? 14;
//ChartController::showChartByDays('ecb_rate', 'Edhj fdffalk', 20);

ChartController::showTwoCharts($days);