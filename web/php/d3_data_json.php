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

// while ($row = $result->fetch_assoc()) {
//     $data[] = $row;
//     //print_r(json_encode($data));
    
// }

$rows_cnt = 0;
$data = [];
while ($row = $result->fetch_assoc()) {
    $dates[] = $row['date'];
   
    if ($row['ecb_rate'] == null and $rows_cnt!=0) {
        $ecb_rate[] = $ecb_rate[$rows_cnt - 1];
    } else {
        $ecb_rate[] = $row['ecb_rate'];
    }

    if ($row['cbr_rate'] == null and $rows_cnt!=0) {
        $cbr_rate[] = $cbr_rate[$rows_cnt - 1];
    } else {
        $cbr_rate[] = $row['cbr_rate'];
    }
    
    $data[] = array(
        'date' => $dates[$rows_cnt],
        'ecb_rate' => $ecb_rate[$rows_cnt],
        'cbr_rate' => $cbr_rate[$rows_cnt]
        );

    $rows_cnt++;
}

echo json_encode($data);
