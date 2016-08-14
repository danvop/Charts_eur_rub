
<div class="canvas" id="canvas_div"><a href="http://www.chartjs.org/docs/#line-chart"> chart js line chart</a>

<?php
require '../db_pass.php';
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
    $labels[] = $row['date'];
   
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
    $rows_cnt++;
}
?>



<script src="js/Chart.js"></script>


<canvas id="myChart_1" width="600" height="400" ></canvas> 
<script>
//в labels пишем даты
//в dataset вставляем массивы курсов для дат
var data_test = {
    labels: <?=json_encode($labels)?>,
    datasets: [
        {
            label: "EUROPE CB EUR RUB rates",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(255,0,0,0.5)",
            borderColor: "rgba(255,0,0,0.5)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: <?=json_encode($ecb_rate)?>,
            spanGaps: false,
        },
        {
            label: "Russian CB EUR RUB rates",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: <?=json_encode($cbr_rate)?>,
            spanGaps: false,
        }

    ]
};
var options = {
        scales: {
            xAxes: [{
                display: true
            }]
        }
};

var ctx = document.getElementById("myChart_1");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: data_test,
    options: options
});
</script>

</div>






