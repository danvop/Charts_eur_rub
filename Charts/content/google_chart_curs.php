<?php

require '../db_pass.php';
$db_name = 'test';
//$weeks = 1;


$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

// $sql = "SELECT *  
//         FROM eur_rates 
//         WHERE date between '2015-06-17' and '2016-06-24'";

$sql = "SELECT 
        dates.date, eur_rates.rate AS ecb_rate, eur_rub_cbr_rates.rate AS cbr_rate
      FROM dates 
      LEFT JOIN  
        eur_rates on dates.date=eur_rates.date 
      LEFT JOIN  
        eur_rub_cbr_rates on dates.date=eur_rub_cbr_rates.date
      WHERE 
      dates.date between '2016-04-01' and '2016-07-01'";


$result = $conn->query($sql);



$json = array();
$json['cols'] = array(
        array('label' => 'date', 'type' => 'string'),
        array('label' => 'Европейский ЦБ', 'type' => 'number'),
        array('label' => 'ЦБ России', 'type' => 'number')
    );


while ($row = $result->fetch_assoc()) {
    $temp = [];
    $temp[] = array('v' => $row['date']);
    $temp[] = array('v' => $row['ecb_rate']);
    $temp[] = array('v' => $row['cbr_rate']);
    $rows[] = array('c' => $temp);
}


$json['rows'] = $rows;

//echo json_encode($json);

?>

<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable(<?=json_encode($json)?>);
      
      var formatter = new google.visualization.NumberFormat(
      {pattern: '###.####'});
        formatter.format(data, 1);
        formatter.format(data, 2);     
      
      var options = {
        chart: {
          title: 'Курсы евро от европейского и российского ЦБ',
          subtitle: 'в рублях за евро'
        },
        width: 900,
        height: 500,

        //selectionMode: 'multiple',
        tooltip: {},
    
        
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, options);
    }
  </script>
</head>
<body>
  <div id="line_top_x"></div>
</body>
</html>