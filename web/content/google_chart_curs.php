<?php

require '../db_pass.php';
//$db_name = 'test';
$weeks = 7;


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
      dates.date between curdate() - interval $weeks week and curdate()";

$result = $conn->query($sql);



$json = array();
$json['cols'] = array(
        array('label' => 'date', 'type' => 'string'),
        array('label' => 'Европейский ЦБ', 'type' => 'number'),
        array('label' => 'ЦБ России', 'type' => 'number')
    );


$rows_cnt = 0;
while ($row = $result->fetch_assoc()) {
    $temp = [];
    $temp[0] = array('v' => $row['date']);
        
    if ($row['ecb_rate'] == null and $rows_cnt!=0){
        $temp_row = $rows[$rows_cnt-1]['c'][1]['v'];
        $row['ecb_rate'] = $temp_row;
    }
    $temp[1] = array('v' => $row['ecb_rate']);
    
    if ($row['cbr_rate'] == null and $rows_cnt!=0){
        $temp_row = $rows[$rows_cnt-1]['c'][2]['v'];
        $row['cbr_rate'] = $temp_row;
    }
    $temp[2] = array('v' => $row['cbr_rate']);
    $rows[$rows_cnt++] = array('c' => $temp);
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