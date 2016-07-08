<?php

 //This is aPHP(5)script example on how eurofxref-daily.xml can be parsed
  //Read eurofxref-daily.xml file in memory
  //For the next command you will need the config 
  //option allow_url_fopen=On (default)
  $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
  //the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
            
  foreach($XML->Cube->Cube->Cube as $rate){
    //Output the value of 1EUR for a currency code
    echo '1&euro;='.$rate["rate"].' '.$rate["currency"].'<br/>';
    //--------------------------------------------------
    //Here you can add your code for inserting
    //$rate["rate"] and $rate["currency"] into your database
    //--------------------------------------------------
  }