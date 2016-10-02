<?php
define('ERR_DRAW_ON_BOTTOM_MENU', 'sorry....menu doesn\'t work');
/* Menu ***/
/*
href format
index.php?[page without '.php']
all pages contains in "content" folder

 */
$chart_menu = array(
	
    array('link' => 'google chart', 'href' => 'index.php?id=google_chart_curs'),
    array('link' => 'chartjs', 'href' => 'index.php?id=chartjs_line'),
    array('link' => 'd3 multi line', 'href' => 'index.php?id=d3_multi_line'),
    //array('link' => 'highcharts', 'href' => 'index.php?id=highcharts_stock'),
    array('link' => 'Как это работает?', 'href' => 'index.php?id=how_it_works')
    );
/*menu*/
