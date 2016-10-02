<?php
/*functions library*/
function cleanStr($data)
{
    return trim(strip_tags($data));
}

function drawMenu($menu, $menuClass)
{
    if (!is_array($menu))
        return false;
    //$style = '';
    // if (!$vertical) {
    //     $style = " style='display:inline;margin-right:15px'";
    // }
    /*<ul class="topnav">*/
    echo "<ul class='{$menuClass}'>";
    foreach ($menu as $item) {
        echo "<li>";
        echo "<a href='{$item['href']}'>{$item['link']}</a>";
        echo "</li>";
    }
    echo "</ul>";
    return true;
}
