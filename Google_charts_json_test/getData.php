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

$json = new stdClass;
$json->cols = [];
$json->cols[0] = new stdClass;
$json->cols[0]->id = '';
$json->cols[0]->label = 'Topping';
$json->cols[0]->pattern = '';
$json->cols[0]->type = 'string';

$json->cols[1] = {
	$id = '';
	$label = 'Slices';
	$pattern = '';
	$type = 'number';
};



var_dump($json);



$string = file_get_contents("sampleData.json");

$dec = json_decode($string);
$str = json_encode($dec);

//echo $str;
//print_r($dec);
echo "</br>";
var_dump($dec->rows[0]);

//print_r($dec);






// Instead you can query your database and parse into JSON etc etc

