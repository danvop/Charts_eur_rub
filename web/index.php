<?php
Header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
    require 'php/lib.inc.php';
    require 'php/data.inc.php';
    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<?php
        
?>
<h1>Линейные графики</h1>

<div>
    <?php
    if (!drawMenu($chart_menu, "topnav")) {
        echo ERR_DRAW_ON_LEFT_MENU;
    }
    ?>
</div>
<div class="container">

  
    <?php
    if (isset($_GET['id'])) {
        $id = strtolower(cleanStr($_GET['id']));
        include 'content/'.$id.'.php';
    }
    ?>
  
  

<p>This is a paragraph.</p>

</div>



</body>
</html>