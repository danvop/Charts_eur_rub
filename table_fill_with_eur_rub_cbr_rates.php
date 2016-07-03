<?php
require 'db_pass.php';
$db_name = 'test';


$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// $sql = "insert into eur_rates values(curdate() + interval 2 day, 74.2222)";


$list = array();

// создаю экземпляр SoapClient
$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");

try {
      //cbr.ru
      //
      $param["FromDate"] = "2005-02-23T12:10:00";
      $param["ToDate"] = "2016-07-02T12:10:00";
      $param["ValutaCode"] = "R01235";

      $res = $client->GetCursDynamicXML($param);
      //$res->GetCursDynamicXMLResponse;
      
      
// var_dump($res->GetCursDynamicXMLResult);
    $result = $res->GetCursDynamicXMLResult->any;
    $dom = new DOMDocument;
    $dom->loadXML($result);
    $root = $dom->documentElement;
     //$root = $result->documentElement;
    // $items = $root()
    $items = $root->getElementsByTagName('ValuteCursDynamic');
    
    foreach ($items as $item) {
        $curs_date = $item->getElementsByTagName('CursDate')->item(0)->nodeValue;
        
        //convert date format from 2000-07-01T00:00:00+00:00 to 2000-07-01
        $curs_date = date_create($curs_date);
        $curs_date = date_format($curs_date, 'Y-m-d');
        
        $curs = $item->getElementsByTagName('Vcurs')->item(0)->nodeValue;
        $list[$curs_date] = floatval(str_replace(',', '.', $curs));

        $sql = "insert into eur_rub_cbr_rates values('" . $curs_date . "', ". $list[$curs_date] . ")";
        //echo $sql;
        if ($conn->query($sql) === true) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
   //print_r($list);


//      var_dump($res);
} catch (SoapFault $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}



$conn->close();
