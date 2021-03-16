<?php
// require __DIR__ . '/db_connect.php';
include('../db_connect.php');
$prize = rand(1, 3);
$today = date('Y/m/d H:i:s');
$time_limit = date('Y/m/d H:i:s', strtotime("+10 day"));
$use = 0;


$output = [

    'success' => false,
    'code' => 0,
    'error' => '參數不足'

];
if (!isset($_POST['member_sid'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO:檢查欄位格式
$sql = "INSERT INTO `awards_detail`(
`member_sid`, `prize_sid`,
`created_at`, `deadline`, `used`) VALUES (
    ?,?,NOW(),?,?
)";

$stmt = $pdo->prepare($sql); //作防範機制 單引號的跳脫字源避免被改寫語法

$stmt->execute([
    $_POST['member_sid'],
    $prize,
    $time_limit,
    $use,
]);
$lastID = sprintf("SELECT * FROM `awards_detail` WHERE member_sid = %s ORDER BY `awards_detail`.`created_at` DESC", $_POST['member_sid']);
$row = $pdo->query($lastID)->fetch();


$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    $output['test'] = $row;
    unset($output['error']);
}



echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
