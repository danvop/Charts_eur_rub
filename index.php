<?php
require('core/bootstrap.php');

use app\controllers\ChartController;

use app\models\Chart;


ChartController::showEurWeek();


//require ('views/view.index.php');
require ('views/view.dbfetch.php');
