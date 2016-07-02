<?php

require '../db_pass.php';
$db_name = 'test';
//$weeks = 1;


$conn = mysqli_connect($servername, $db_root, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

$sql = "SELECT *  
        FROM eur_rates 
        WHERE date between '2015-06-17' and '2016-06-24'";
$result = $conn->query($sql);



$json = array();
$json['cols'] = array(
        array('label' => 'date', 'type' => 'string'),
        array('label' => 'EUR RUB ECB', 'type' => 'number')
        // array('label' => 'EUR CBR', 'type' => 'number')
    );


while ($row = $result->fetch_assoc()) {
    $temp = [];
    $temp[] = array('v' => $row['date']);
    $temp[] = array('v' => $row['rate']);
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
      
      var options = {
        chart: {
          title: 'Box Office Earnings in First Two Weeks of Opening',
          subtitle: 'in millions of dollars (USD)'
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