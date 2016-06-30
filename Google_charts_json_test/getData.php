<?php

// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.


//рабочий образец данных для наполения строк

/*[
  ['Mushrooms', 3],
  ['Onions', 1],
  ['Olives', 1],
  ['Zucchini', 1],
  ['Pepperoni', 2]
]
*/

// $json = new stdClass;
// $json->cols = [];
// $json->cols[0] = new stdClass;
// $json->cols[0]->id = '';
// $json->cols[0]->label = 'Topping';
// $json->cols[0]->pattern = '';
// $json->cols[0]->type = 'string';

// $json->cols[1] = new stdClass;
// $json->cols[1]->id = '';
// $json->cols[1]->label = 'Slices';
// $json->cols[1]->pattern = '';
// $json->cols[1]->type = 'number';
// 
// 
// $table=array();
// $table['cols']=array(
//         array('label'=> 'User ID', type=>'string'),
//         array('label'=>'Group Name', type=>'string'),
//         array('label'=>'Requested Nodes', type=>'number'),
//         array('label'=>'Actual PE', type=>'number')
// );



$json = array();
$json['cols'] = array(
        array('label' => 'Topping', type => 'string'),
        array('label' => 'Slices', type => 'number')
    );


$temp = array();
$temp[]=array('v' => 'test1');
$temp[]=array('v' => 3);

$json->rows[0] = array ('c' => $temp);


$temp = array();
$temp[]=array('v' => 'test2');
$temp[]=array('v' => 2);

$json->rows[1] = array ('c' => $temp);

// $json->rows[0]->c[0] = new stdClass;
// $json->rows[0]->c[0]->v = 'Mushrooms';
// $json->rows[0]->c[0]->f = null;
// $json->rows[0]->c[1] = new stdClass;
// $json->rows[0]->c[1]->v = 3;
// $json->rows[0]->c[1]->f = null;

//попробовать сделать массив объектов
//$obj3 = (object)[]; // Cast empty array to object


// $json->rows[1]->c[] = [] ;
// $json->rows[1]->c[0] = 'Onions';
// $json->rows[1]->c[1] = 1;


// $json->rows[1] = new stdClass;
// $json->rows[1]->v = 'Mushrooms';
// $json->rows[1]->f = null;

//var_dump($json->rows[0]);
//var_dump($json->rows[1]);
//var_dump($json->rows[2]);

$string = file_get_contents("sampleData.json");

// $dec = json_decode($string);
// $str = json_encode($dec);


//echo $string;

echo json_encode($json);


// //print_r($dec);
// echo "</br>";


//var_dump($dec->rows[0]);
//var_dump($dec->rows[1]);
//var_dump($dec);
//print_r($dec);






// Instead you can query your database and parse into JSON etc etc
