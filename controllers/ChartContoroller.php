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

    public static function showChartByDays($table, $label, $days)
    {
        $Chart = new Chart;
        $Chart->label = $label;
        
        $db = new DB;
        
        $rates = $db->fetchCustom($table, $days);
        foreach ($rates as $rec) {
            $labels[] = $rec['date'];
            $dataset[] = $rec['rate'];
        }
        
        $Chart->data = $dataset;
        $datasets[] = $Chart;
        return require('views/view.index.php');
    }
    public static function showTwoCharts()
    {
        $db = new DB;
        $ecbChart = new Chart;
        $cbrChart = new Chart;
        $ecbChart->label = 'Курс EUR Евро ЦБ';
        $cbrChart->label = 'Курс EUR ЦБ РФ';
    }
    
// select d.date, e.rate, c.rate
// from dates d
// LEFT OUTER JOIN ecb_rate e on d.date = e.date
// LEFT OUTER JOIN cbr_rate c on d.date = c.date
// where d.date between '2017-02-20' and '2017-03-06';
}
