<?php
// require __DIR__ . '/db_connect.php';
include('../db_connect.php');

$output = [

    'success' => false,
    'code' => 0,
    'error' => '參數不足'

];
if (!isset($_POST['prize'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO:檢查欄位格式
$sql = "INSERT INTO `awards`(`prize`) VALUES (?)";


$stmt = $pdo->prepare($sql); //作防範機制 單引號的跳脫字源避免被改寫語法

$stmt->execute([
    $_POST['prize'],

]);

$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
}

echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
