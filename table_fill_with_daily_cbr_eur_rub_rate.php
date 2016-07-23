<?php
//Помещение в таблицу РУБ - ЕВРО по ЦБ РФ за текущий день
require 'db_pass.php';
$param_date = date_create('now');

$param_date = date_format($param_date, 'Y-m-d');

$ins_date = $param_date; //this is date to insert query

$param_date = $param_date . 'T00:01:00';

$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");
try {
      //cbr.ru
      
      $param["On_date"] = $param_date;
      
      $res = $client->GetCursOnDateXML($param);
      //$res->GetCursOnDateXMLResult->any;
$XML = simplexml_load_string($res->GetCursOnDateXMLResult->any);
//      var_dump($res);
} catch (SoapFault $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}

foreach ($XML->ValuteCursOnDate as $item){
	if ($item->VchCode == 'EUR'){
		$ins_rate = $item->Vcurs;
	}
	}

//блок работы с базой данных
$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "insert into eur_rub_cbr_rates values('" . $ins_date . "', ". $ins_rate . ")";
    //echo $sql;
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }