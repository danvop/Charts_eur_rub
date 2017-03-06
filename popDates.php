<?php
// populate dates table by dates

require('core/bootstrap.php');

use app\core\database\DB;

$db = new DB;
$startdate=strtotime("2014-01-01");
$enddate=strtotime("2022-01-01");

while ($startdate < $enddate) {
  
  $startdate = strtotime("+1 day", $startdate);
  //insert to DB
        $db->insert('dates', [
        'date' => date("Y-m-d", $startdate)
         ]);
}