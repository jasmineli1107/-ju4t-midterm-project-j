<?php
include __DIR__ . "/db.php";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'ju4t_midterm';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);


$output = [
    'success' => false,
    'code' => '0',
    'error' => '參數不足',
];

if (!isset($_POST['sid']) or !isset($_POST['member']) or !isset($_POST['created_at'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sqo = "UPDATE `order_list` SET 
`taker`=?,
`taker_mobile`=?,
`address`=?,
`status`=? 
WHERE
`sid`=?";
$stmt = $db->query($sqo, $_POST['taker'], $_POST['taker_mobile'], $_POST['address'], $_POST['select-status'], $_POST['sid']);

$output['rowCount'] = $stmt->affectedRows();

if ($stmt->affectedRows()) {
    $output['success'] = true;
    unset($output['error']);
    $db->query("UPDATE `order_list` SET `updated_at` = NOW() WHERE `sid`=?", $_POST['sid']);
} else {
    $output['error'] = '資料沒有修改';
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
