<?php
$url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d.m.Y');
$dom = new DOMDocument;
$dom->load($url);
// var_dump($dom);
$list = array();
$root = $dom->documentElement;
$items = $root->getElementsByTagName('Valute');
// var_dump($items);
foreach ($items as $item) {
                $code = $item->getElementsByTagName('Name')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $list[$code] = floatval(str_replace(',', '.', $curs));
            }
// print_r($list);
//Вывод
// print_list($list);
list_to_table($list);

function list_to_table($list){
    echo "<table>";
      echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Curs</th>";
      echo "</tr>";
      foreach($list as $key => $item){
        echo "<tr>";
        echo "<td>$key</td>";
        echo "<td>$item</td>";
        echo "</tr>";
            }

      
    echo "</table>";
}

function print_list($list){
    foreach($list as $key => $item){
        echo $key;
        echo " ";
        echo $item;
        echo "<br>";
    }

}


// <table>
//   <tr>
//     <th>Month</th>
//     <th>Savings</th>
//   </tr>
//   <tr>
//     <td>January</td>
//     <td>$100</td>
//   </tr>
// </table>




/*$nodes = array();
    foreach($node_list as $node) {
      $nodes[] = $node;
    }*/
// print_r($root);
// 
/*
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
echo $usd_curs;*/