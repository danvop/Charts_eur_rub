<?php
//curs_soap.php

$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");

try {
      //cbr.ru
      
      $param["On_date"] = "2015-03-23T12:10:00";
      
      $res = $client->GetCursOnDateXML($param);
      //$res->GetCursOnDateXMLResult->any;
var_dump($res->GetCursOnDateXMLResult->any);
//      var_dump($res);
} catch (SoapFault $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}