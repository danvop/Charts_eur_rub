<?php 
use app\controllers\ChartController;
use app\core\database\DB;

ChartController::dailyRate();
$db = new DB;
?>

<div class="container">
  <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <button type="button" class="btn btn-info"><?=$db->getLastRate('ecb_rate')?></button>
              <button type="button" class="btn btn-danger"><?=$db->getLastRate('cbr_rate')?></button>
            <li class="nav-item">
              
            </li>
          </ul>
        </nav>
        <a href="/"><h3 class="text-muted">Курс ЕВРО</h3>
      </div> 
</div>
