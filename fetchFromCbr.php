<?php
//Наполнение таблицы курсом РУБ - ЕВРО за указанный период ["FromDate"] ["ToDate"]

require('core/bootstrap.php');

use app\core\database\DB;

$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");

// date format: 2014-03-05T05:20:00+00:00
//$param["FromDate"] = date('c', strtotime("-3 year"));
//$param["FromDate"] = date('Y-m-d', strtotime("-20 days"));
$param["FromDate"] = date('2017-02-01');
$param["ToDate"] = date('2017-03-10');
$param["ValutaCode"] = "R01239";
// $date = new DateTime('Y-m-d');
//die(var_dump($param["ToDate"]));
$res = $client->GetCursDynamicXML($param);



// die(var_dump($res));

$list = array();

// создаю экземпляр SoapClient

try {
    $result = $res->GetCursDynamicXMLResult->any;
    $dom = new DOMDocument;
    $dom->loadXML($result);
    $root = $dom->documentElement;
    


    $items = $root->getElementsByTagName('ValuteCursDynamic');
    //temp time for compare
    
    foreach ($items as $item) {
        $curs_date = $item->getElementsByTagName('CursDate')->item(0)->nodeValue;
        var_dump($curs_date);
        //convert date format from 2000-07-01T00:00:00+00:00 to 2000-07-01
        $curs_date = date('Y-m-d', strtotime($curs_date));
        var_dump($curs_date);
        die();
        //if $tmp_date not set
        $tmp_date = $tmp_date ?? $curs_date;
        
        $curs = $item->getElementsByTagName('Vcurs')->item(0)->nodeValue;
        
        // echo $curs_date . ' ' . $tmp_date;
        // die();

        while ($curs_date != $tmp_date) {
            echo "{$tmp_date} {$curs}</br>";
            $tmp_date = date('Y-m-d',strtotime("$tmp_date + 1 day"));
        }

        echo $curs_date . ' ' . $curs . '</br>';
        // insert to DB
        // $db = new DB;
        // $db->insert('cbr_rate', [
        // 'date' => $curs_date,
        // 'rate' => $curs
        //  ]);
        ;
        //$tmp_date = date('Y-m-d',strtotime("$curs_date + 1 day"));
    }
} catch (Exception $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}
