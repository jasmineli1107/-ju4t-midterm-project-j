<?php
require __DIR__ . '/../db_connect.php';

if (isset($_GET['sid'])) {
    $sid = intval($_GET['sid']);
    $pdo->query("DELETE FROM `order_temp` WHERE sid= $sid ");
}

$backTo = 'order_temp.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $backTo = $_SERVER['HTTP_REFERER'];
}
// $_SERVER['HTTP_REFERER'] => 當前頁面的前一頁面的地址

header('Location: ' . $backTo);
