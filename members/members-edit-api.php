<?php
require __DIR__ . '/../db_connect.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];


$sql = "UPDATE `member_list` SET 
`account`=?,
`password`=?,
`nickname`=?,
`birthday`=?,
`mobile`=?,
`activated`=?,
`update_at`= NOW()  

WHERE `sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['account'],
    $_POST['password'],
    $_POST['nickname'],
    $_POST['birthday'],
    $_POST['mobile'],
    (int)$_POST['activated'],
    $_POST['sid'],

]);

$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
