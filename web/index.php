<?php
Header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
    require 'php/lib.inc.php';
    require 'php/data.inc.php';
    
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/styles.css">
</head>
<title>HTML Tutorial</title>
<!-- Пренести стили в одтельный файл -->
<style type="text/css">

</style>
<!--  -->
<body>
<?php
        
?>
<h1>Разные графики для курсов</h1>
<!-- <div>
    
    <ul class="topnav">
      <li><a href="#home">Home</a></li>
      <li><a href="#news">News</a></li>
      <li><a href="#contact">Contact</a></li>
      <li><a href="#about">About</a></li>
      <li class="icon">
        <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
    </li>
    </ul>
</div> -->
<!-- one more menu -->
<div>
    <?php
    if (!drawMenu($chart_menu, "topnav")) {
        echo ERR_DRAW_ON_LEFT_MENU;
    }
    ?>
</div>
<div id="content">
    <?php
    if (isset($_GET['id'])) {
        $id = strtolower(cleanStr($_GET['id']));
        include 'content/'.$id.'.php';
    }
    ?>
            
        </div>

<p>This is a paragraph.</p>

</body>
</html>