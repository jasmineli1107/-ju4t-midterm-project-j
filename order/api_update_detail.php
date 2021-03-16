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

if (!isset($_POST['sid']) or !isset($_POST['id'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sqo = "UPDATE `order_detail` SET 
`model_id`=?,
`shell_id`=?,
`series_id`=?,
`design_id`=? ,
`per_price`=? ,
`quantity` = ? 
WHERE
`sid`=?";
$stmt = $db->query($sqo, $_POST['select-model'], $_POST['select-shell'], $_POST['select-series'], $_POST['select-design'], $_POST['price'], $_POST['quantity'], $_POST['sid']);

$output['rowCount'] = $stmt->affectedRows();

if ($stmt->affectedRows()) {
    $output['success'] = true;
    unset($output['error']);
} else {
    $output['error'] = '資料沒有修改';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$getlistsql = sprintf("SELECT per_price,quantity from  `order_detail` where order_id = %s", $_POST['id']);
$stmt_price = $db->query($getlistsql);
$row = $stmt_price->fetchAll();
$t_price = 0;
foreach ($row as $r) {
    $t_price += $r['per_price'] * $r['quantity'];
}
$updatelistsql = sprintf("UPDATE `order_list` set `price`=%s where sid = %s", $t_price, $_POST['id']);
$stmt_setprice = $db->query($updatelistsql);


if ($stmt_setprice->affectedRows()) {
    $output['success'] = true;
    unset($output['error']);
} else {
    $output['success'] = false;
    $output['error'] = '總價格沒有修改';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}





echo json_encode($output, JSON_UNESCAPED_UNICODE);
