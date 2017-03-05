<?php
use app\core\database\DB;
$db = new DB;
// $db->insert('rub_rate', [
//     'date' => date("Y-m-d"),
//     'ecb' => 70
//     ]);
$db->fetchAll('rub_rate');