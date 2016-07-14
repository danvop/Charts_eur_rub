<?php
//Наполнение таблицы данными курса РУБ - ЕВРО с 2005-01-01 по текущий момент
//
require 'db_pass.php';

$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// $sql = "insert into eur_rates values(curdate() + interval 2 day, 74.2222)";


$XML=simplexml_load_file("http://www.ecb.europa.eu/stats/exchange/eurofxref/html/rub.xml");
 


foreach ($XML->DataSet->Series->Obs as $rate) {
    $sql = "update into eur_rates values('" . $rate["TIME_PERIOD"] . "', ". $rate["OBS_VALUE"] . ")";
    //echo $sql;
    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //echo $rate["TIME_PERIOD"].' '.'1&euro;='.' '.$rate["OBS_VALUE"].'<br/>';
}

$conn->close();
