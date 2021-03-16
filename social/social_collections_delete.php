<?php
include('../db_connect.php');

if (isset($_GET['sid'])) {
    $sid = intval($_GET['sid']);
    $pdo->query("DELETE FROM `social` WHERE sid=$sid ");
}

// HTTP_REFERER獲取前一頁的url
$backTo = 'social.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $backTo = $_SERVER['HTTP_REFERER'];
}

header('Location: ' . $backTo);
