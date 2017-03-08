<?php
//Наполнение таблицы курсом РУБ - ЕВРО за указанный период ["FromDate"] ["ToDate"]

require('core/bootstrap.php');

use app\core\database\DB;

$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");

$param["FromDate"] = date('2014-01-01');
$param["ToDate"] = date('Y-m-d'); //current date
$param["ValutaCode"] = "R01239";

$res = $client->GetCursDynamicXML($param);

$list = array();

try {
    $result = $res->GetCursDynamicXMLResult->any;
    $dom = new DOMDocument;
    $dom->loadXML($result);
    $root = $dom->documentElement;

    $items = $root->getElementsByTagName('ValuteCursDynamic');

    foreach ($items as $item) {
        $curs_date = $item->getElementsByTagName('CursDate')->item(0)->nodeValue;
        
        //convert date format from 2000-07-01T00:00:00+00:00 to 2000-07-01
        $curs_date = date('Y-m-d', strtotime($curs_date));
        
        //temp time for compare dates
        //if $tmp_date not set
        $tmp_date = $tmp_date ?? $curs_date;
        
        $curs = $item->getElementsByTagName('Vcurs')->item(0)->nodeValue;

        // initiate DB
        $db = new DB;
        //if rate on date is null
        while ($curs_date != $tmp_date) {
            //echo "{$tmp_date} {$curs}</br>";
            $db->insert('cbr_rate', [
            'date' => $tmp_date,
            'rate' => $curs
            ]);

            $tmp_date = date('Y-m-d', strtotime("$tmp_date + 1 day"));
        }
          
        $db->insert('cbr_rate', [
        'date' => $curs_date,
        'rate' => $curs
         ]);
        $tmp_date = date('Y-m-d', strtotime("$curs_date + 1 day"));
    }
} catch (Exception $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}
