<?php
require __DIR__ . '/../db_connect.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];

// echo $_POST['activated'];

$sql = "INSERT INTO `member_list`(
    `account`, 
    `password`, 
    `nickname`, 
    `birthday`, 
    `mobile`, 
    `activated`,
    `create_at`, 
    `update_at`) 
VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['account'],
    $_POST['password'],
    $_POST['nickname'],
    $_POST['birthday'],
    $_POST['mobile'],
    $_POST['activated'],

]);

$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
