<?php
/*    $client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");

try {
      //cbr.ru
      $param["On_date"] = "2015-03-23T12:10:00";
      $res = $client->GetCursOnDateXML($param);
      $res->GetCursOnDateXMLResult->vcode(840);
      var_dump($res);
      print_r($res);
} catch (SoapFault $e) {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
}*/


class CBRAgent
{
    protected $list = array();
 
    public function load()
    {
        $xml = new DOMDocument();
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d.m.Y');
 
        if ($xml -> load($url)) {
            $this->list = array();
 
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');
 
            foreach ($items as $item) {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $this->list[$code] = floatval(str_replace(',', '.', $curs));
            }
 
            return true;
        } else
        return false;
    }
 
    public function get($cur)
    {
        return isset($this->list[$cur]) ? $this->list[$cur] : 0;
    }
}

$cbr = new CBRAgent();
if ($cbr->load()){    
    $usd_curs = $cbr->get('USD');
}
echo $usd_curs;