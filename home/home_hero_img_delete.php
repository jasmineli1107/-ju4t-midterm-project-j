<?php
include('../db_connect.php') ;

if( isset($_GET['sid'])){
   $sid = intval($_GET['sid']);
   $pdo->query("DELETE FROM `home_hero_img` WHERE sid=$sid ");
}

$backTo = 'home_hero_img_edit.php';
if(isset($_SERVER['HTTP_REFERER'])){
    $backTo = $_SERVER['HTTP_REFERER'];
}

header('Location: '. $backTo);