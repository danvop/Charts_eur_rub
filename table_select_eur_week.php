<?php

require 'db_pass.php';
$db_name = 'test';
$weeks = 1;


$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

$sql = "SELECT 	dates.date, eur_rates.rate 
		FROM dates 
		LEFT JOIN eur_rates on dates.date=eur_rates.date 
		WHERE  dates.date between curdate() - interval $weeks week and curdate()";
$result = $conn->query($sql);



while($row = $result->fetch_assoc()){
	echo $row['date']."     ". $row['rate']. "</br>";
}



// print_r($result);
// var_dump($result);

print_r($row);
var_dump($result);
