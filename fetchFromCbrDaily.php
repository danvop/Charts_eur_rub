<?php
date_default_timezone_set('Europe/Moscow');

require('models/Chart.php');
require('controllers/ChartContoroller.php');
require('core/database/DB.php');

use app\core\database\DB;

$param_date = date('Y-m-d');

$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");
try {
 
    $param["On_date"] = $param_date;

    $res = $client->GetCursOnDateXML($param);

    $XML = simplexml_load_string($res->GetCursOnDateXMLResult->any);

} catch (SoapFault $e) {
    echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}

$db = new DB;
foreach ($XML->ValuteCursOnDate as $item){
    if ($item->VchCode == 'EUR'){
        // echo "{$param_date} {$item->Vcurs}</br>";
        $db->insert('cbr_rate', [
        'date' => $param_date,
        'rate' => $item->Vcurs
         ]);
    }
}
