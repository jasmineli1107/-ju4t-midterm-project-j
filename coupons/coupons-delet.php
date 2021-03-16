<?php
include('../db_connect.php');

if (isset($_GET['sid'])) {

    $sid = intval($_GET['sid']);

    $pdo->query("DELETE FROM `awards` WHERE sid=$sid");
}

$backto = 'coupons.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $backto = $_SERVER['HTTP_REFERER'];
}

header('Location: ' . $backto);
