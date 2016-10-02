<?php
Header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
    require 'php/lib.inc.php';
    require 'php/data.inc.php';
    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Line charts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- menu start-->
    <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Линейные графики</a>
        </div>
          <?php
            if (!drawMenu($chart_menu, "nav navbar-nav navbar-right")) {
                echo ERR_DRAW_ON_LEFT_MENU;
            }
          ?>
          <!-- script for highlite active menu -->
          <script>
            if(document.querySelector('a[href*="' + window.location.search + '"]').parentElement.setAttribute('class','active'));
          </script>
      </div>
    </nav>
    </div> 
    <!-- menu end -->
    
    <div class="container">
      <div class="row">
        <div class="col-md-12">  
          
            <?php
            if (isset($_GET['id'])) {
                $id = strtolower(cleanStr($_GET['id']));
                include 'content/'.$id.'.php';
            }
            ?>
          
        </div>  
      </div>
    <p>This is a paragraph.</p>

    


  </div>
  </body>
  </html>