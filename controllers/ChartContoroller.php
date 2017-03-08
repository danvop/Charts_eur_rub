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

    /*
     * [showChartByDays description]
     * @param  [string] $table []
     * @param  [string] $label [description]
     * @param  [int] $days  [days before]
     */
    public static function showChartByDays($table, $label, $days)
    {
        $Chart = new Chart;
        $Chart->label = $label;
        
        $db = new DB;
        
        //$rates = $db->fetchCustom($table, $days);
        $rates = $db->fetchCustomLeft($table, $days);
        foreach ($rates as $rec) {
            $labels[] = $rec['date'];
            $dataset[] = $rec['rate'];
        }
        
        $Chart->data = $dataset;
        $datasets[] = $Chart;
        return require('views/view.index.php');
    }
    public static function showTwoCharts($days)
    {
        $db = new DB;
        $ecbChart = new Chart;
        $cbrChart = new Chart;
        $ecbChart->label = 'Курс EUR Евро ЦБ';
        $cbrChart->label = 'Курс EUR ЦБ РФ';
        $labels = array_column($db->fetchCustom('ecb_rate', $days), 'date');

        $ecbChart->data = array_column($db->fetchCustom('ecb_rate', $days), 'rate');
        $ecbChart->borderColor = "rgba(75,192,192,1)";

        $cbrChart->data = array_column($db->fetchCustom('cbr_rate', $days), 'rate');
        $cbrChart->borderColor = "rgba(255,0,0,0.5)";

        // var_dump($ecbChart->data);
        

        $datasets[] = $ecbChart;
        $datasets[] = $cbrChart;
        return require('views/view.index.php');
    }
    
// select d.date, e.rate, c.rate
// from dates d
// LEFT OUTER JOIN ecb_rate e on d.date = e.date
// LEFT OUTER JOIN cbr_rate c on d.date = c.date
// where d.date between '2017-02-20' and '2017-03-06';
}
