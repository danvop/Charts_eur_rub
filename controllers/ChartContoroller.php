<?php
namespace app\controllers;

use app\models\Chart;
use app\core\database\DB;

class ChartController
{
    public static function showTest()
    {
        return require('views/view.index.php');
    }
    public static function showEurWeek()
    {
        $ecbChart = new Chart;
        $ecbChart->label = 'Курс Евро ECB';
        
        $db = new DB;
        
        $rates = $db->fetchCustomEcb('ecb_rate', 7);
        foreach ($rates as $rec) {
            $labels[] = $rec['date'];
            $dataset[] = $rec['rate'];
        }
        
        $ecbChart->data = $dataset;
        $datasets[] = $ecbChart;
        return require('views/view.index.php');
    }
}
