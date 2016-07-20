<?php
//Помещение в таблицу РУБ - ЕВРО по ЕСВ за текущий день
require 'db_pass.php';

$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
//This is aPHP(5)script example on how eurofxref-daily.xml can be parsed
//Read eurofxref-daily.xml file in memory
//For the next command you will need the config 
//option allow_url_fopen=On (default)
$XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET

$ins_date = $XML->Cube->Cube["time"];


foreach ($XML->Cube->Cube->Cube as $rate) {

    if ($rate["currency"] == "RUB")
    $ins_rate = $rate["rate"];
}

//echo $ins_rate.' '.$ins_date;

$sql = "insert into eur_ecb_rates values('" . $ins_date . "', ". $ins_rate . ")";
    //echo $sql;
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
