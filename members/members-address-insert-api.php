<?php
require __DIR__ . '/../db_connect.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];


$sql = "INSERT INTO `member_address`(
    `member_sid`, 
    `counties_sid`, 
    `district_sid`, 
    `receive_location`, 
    `receive_name`, 
    `receive_phone`) 
VALUES (?, ?, ?, ?, ?, ?)";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['member_sid'],
    $_POST['select-counties'],
    $_POST['select-districts'],
    $_POST['receive_location'],
    $_POST['receive_name'],
    $_POST['receive_phone'],

]);

$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
