<?php
// require __DIR__ . '/db_connect.php';
include('../db_connect.php');

$output = [

    'success' => false,
    'code' => 0,
    'error' => '參數不足'

];
// or !isset($_POST['member_sid']) or !isset($_POST['prize_sid'])
if (!isset($_POST['sid'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
} //允許進入修改狀態的條件

// TODO:檢查欄位格式
$sql = "UPDATE `awards_detail` SET 
`prize_sid`=?,
`deadline`=?,
`used`=? 
WHERE `sid`=?";

$stmt = $pdo->prepare($sql); //作防範機制 單引號的跳脫字源避免被改寫語法

$stmt->execute([
    $_POST['prize_sid'],
    $_POST['deadline'],
    $_POST['used'],
    $_POST['sid'],
]);

$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
} else {
    $output['error'] = '資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
