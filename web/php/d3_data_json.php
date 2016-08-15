<?php
require '../../db_pass.php';
//$db_name = 'test';
$weeks = 3;
$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT 
        dates.date, eur_rub_ecb_rates.rate AS ecb_rate, eur_rub_cbr_rates.rate AS cbr_rate
      FROM dates 
      LEFT JOIN  
        eur_rub_ecb_rates on dates.date=eur_rub_ecb_rates.date 
      LEFT JOIN  
        eur_rub_cbr_rates on dates.date=eur_rub_cbr_rates.date
      WHERE 
      dates.date between curdate() - interval $weeks week and curdate()
      ORDER BY dates.date";
$result = $conn->query($sql);

$rows_cnt = 0;
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    //print_r(json_encode($data));
}

echo json_encode($data);
