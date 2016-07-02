<?php

$get = 'get_get';

if (isset($_GET['get'])) {
        $get = strtolower(trim(strip_tags($_GET['get'])));
}


$table = array(
    'test' => 2,
    'test1' => 5,
    'Тест' => 2,
    'test3' => 1,
    'test5' => 3,
    );


$json = array();
$json['cols'] = array(
        array('label' => 'Topping', 'type' => 'string'),
        array('label' => 'Slices', 'type' => 'number'),

    );


foreach ($table as $key => $item) {
        $temp = [];
        $temp[] = array('v' => $key);
        $temp[] = array('v' => $item);
        $rows[] = array('c' => $temp);
}

/*$rows = array();

$temp = array();
$temp[]=array('v' => $get); //тестирую передачу другого параметра
$temp[]=array('v' => 3);
$rows[0] = array ('c' => $temp);


$temp = array();
$temp[]=array('v' => 'test2');
$temp[]=array('v' => 2);
$rows[1] = array ('c' => $temp);

$temp = array();
$temp[]=array('v' => 'test3');
$temp[]=array('v' => 2);

$rows[2] = array ('c' => $temp);*/


$json['rows'] = $rows;




//$string = file_get_contents("sampleData.json");
echo json_encode($json);
