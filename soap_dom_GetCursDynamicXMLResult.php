<?php
//dyn_val_curs.php
//

//curs_soap.php
// Завожу пустой массив для дальнейшего хранения списка 
$list = array();

// создаю экземпляр SoapClient
$client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");

try {
      //cbr.ru
      //
      $param["FromDate"] = "2016-02-23T12:10:00";
      $param["ToDate"] = "2016-06-10T12:10:00";
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
            }
   //print_r($list);


//      var_dump($res);
} catch (SoapFault $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}

 list_to_table($list); //вывожу на экран


function list_to_table($list){
    echo "<table>";
      echo "<tr>";
        // echo "<th>Name</th>";
        // echo "<th>Curs</th>";
      echo "</tr>";
      foreach($list as $key => $item){
        echo "<tr>";
        echo "<td>$key</td>";
        echo "<td>$item</td>";
        echo "</tr>";
      }
    echo "</table>";
}

//Структура запроса и ответа по данному файлу
//
/*<s:element name="GetCursDynamicXML">
<s:complexType>
<s:sequence>
<s:element minOccurs="1" maxOccurs="1" name="FromDate" type="s:dateTime"/>
<s:element minOccurs="1" maxOccurs="1" name="ToDate" type="s:dateTime"/>
<s:element minOccurs="0" maxOccurs="1" name="ValutaCode" type="s:string"/>
</s:sequence>
</s:complexType>
</s:element>*/

/*<s:element name="GetCursDynamicXMLResponse">
<s:complexType>
<s:sequence>
<s:element minOccurs="0" maxOccurs="1" name="GetCursDynamicXMLResult">
<s:complexType mixed="true">
<s:sequence>
<s:any/>
</s:sequence>
</s:complexType>
</s:element>
</s:sequence>
</s:complexType>
</s:element>*/