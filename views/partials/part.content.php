<body>

  <canvas id="graph"></canvas>
 
<?php
use app\models\Chart;

$ch = new Chart;
$ch->label = 'My Third dataset';
// $ch->data = [40, 36, 20, 17, 5, 18, 65];
//echo json_encode($ch->data);
// $nwCh = new Chart;
// $nwCh->label = 'My Fourth dataset';
// $nwCh->data = [30, 46, 50, 17, 50, 28, 15];

//$labels = ["January", "February", "March", "April", "May", "June", "July"];

// echo json_encode($arrCh);
// echo json_encode($labels);
?>

<script>
var data = {
    labels: [],
    datasets: []
    // datasets: [
    //     {
    //         label: "My First dataset",
    //         data: [65, 59, 80, 81, 56, 55, 40]
    //     },
    //     {
    //         label: "My Second dataset",
    //         data: [60, 54, 87, 87, 51, 59, 45]
    //     }
    // ]
};
<?php foreach ($datasets as $dataset) : ?>
data.labels = (<?=json_encode($labels)?>);
data.datasets.push(<?=json_encode($dataset)?>);
<?php endforeach ?>
  
var myBarChart = new Chart(document.getElementById("graph"), {
    type: 'line',
    data: data
});



  </script>

  </body>