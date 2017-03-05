<?php
//Наполнение таблицы курсом РУБ - ЕВРО за указанный период ["FromDate"] ["ToDate"]

require('core/bootstrap.php');

use app\core\database\DB;

$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");

// date format: 2014-03-05T05:20:00+00:00
$param["FromDate"] = date('c', strtotime("-3 year"));
$param["ToDate"] = date('c');
$param["ValutaCode"] = "R01239";

$res = $client->GetCursDynamicXML($param);

// die(var_dump($date));
// die(var_dump($res));

$list = array();

// создаю экземпляр SoapClient

try {
    $result = $res->GetCursDynamicXMLResult->any;
    $dom = new DOMDocument;
    $dom->loadXML($result);
    $root = $dom->documentElement;
     
    $items = $root->getElementsByTagName('ValuteCursDynamic');
    
    foreach ($items as $item) {
        $curs_date = $item->getElementsByTagName('CursDate')->item(0)->nodeValue;
        //convert date format from 2000-07-01T00:00:00+00:00 to 2000-07-01
        $curs_date = date_create($curs_date);
        $curs_date = date_format($curs_date, 'Y-m-d');
        
        $curs = $item->getElementsByTagName('Vcurs')->item(0)->nodeValue;
        // insert to DB
        $db = new DB;
        $db->insert('cbr_rate', [
        'date' => $curs_date,
        'rate' => $curs
         ]);
    }
} catch (Exception $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}
