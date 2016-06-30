<?php

$table = [
['test1', 2],
['test2', 1],
['test3', 3],
];

$json = array();
$json['cols'] = array(
        array('label' => 'Topping', 'type' => 'string'),
        array('label' => 'Slices', 'type' => 'number')
    );

$rows = array();

$temp = array();
$temp[]=array('v' => 'test1');
$temp[]=array('v' => 3);

$rows[0] = array ('c' => $temp);


$temp = array();
$temp[]=array('v' => 'test2');
$temp[]=array('v' => 2);

$rows[1] = array ('c' => $temp);

$json['rows'] = $rows;

$string = file_get_contents("sampleData.json");

echo json_encode($json);
