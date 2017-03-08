
<p>Разница курса Евро по данным Европейского ЦБ и Центробанка РФ</p>
<!-- Contextual button for informational alert messages -->
<a href="/?days=14"><button type="button" class="btn btn-info">2 недели</button></a>
<a href="/?days=30"><button type="button" class="btn btn-info">1 месяц</button></a>
<a href="/?days=90"><button type="button" class="btn btn-info">3 месяца</button></a>
<a href="/?days=365"><button type="button" class="btn btn-info">Год</button></a>
<p></p>
<canvas id="graph" height="200"></canvas>
 
<?php

?>

<script>
var data = {
    labels: [],
    datasets: []
};
<?php foreach ($datasets as $dataset) : ?>
data.labels = (<?=json_encode($labels)?>);
data.datasets.push(<?=json_encode($dataset)?>);
<?php endforeach ?>
  
var myChart = new Chart(document.getElementById("graph"), {
    type: 'line',
    data: data
});

</script>
