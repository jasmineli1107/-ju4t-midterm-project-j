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
if (!isset($_POST['member'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
} elseif ($_POST['t_price'] == 0) {
    $output['error'] = "購物車無商品";
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
$list_sql = "INSERT INTO `order_list`(
    `member_id`, `price`, `address`, `taker`, `taker_mobile`, `created_at`, `updated_at`) VALUES (?,?,'地球','阿明','0912-345-678',now(),now())";

$list_stmt = $db->query($list_sql, $_POST['member'], $_POST['t_price']);
// $list_stmt = $pdo->prepare($list_sql);
// $list_stmt->execute([
//     $_POST['member'],
//     $_POST['t_price'],
// ]);
// $output['rowCount'] = $stmt->rowCount();
$output['rowCount'] = $list_stmt->affectedRows();
if ($list_stmt->affectedRows()) {
    $_POST['order_id'] = $db->lastInsertID();
    $output['success'] = true;
    unset($output['error']);
} else {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
// if ($list_stmt->rowCount()) {
//     $output['success'] = true;
//     unset($output['error']);
// } else {
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }



$detail_sql = "INSERT INTO `order_detail`(`order_id`, `model_id`, `shell_id`, `series_id`, `design_id`, `per_price`, `quantity`) VALUES (?,?,?,?,?,?,?)";
$detail_stmt = [];
for ($i = 1; $i <= intval($_POST['k']); $i++) {
    $detail_stmt = $db->query(
        $detail_sql,
        $_POST['order_id'],
        $_POST['model' . $i],
        $_POST['shell' . $i],
        $_POST['series' . $i],
        $_POST['design' . $i],
        $_POST['price' . $i],
        $_POST['quantity' . $i]
    );
}


$output['rowCount2'] = $detail_stmt->affectedRows();
if ($detail_stmt->affectedRows()) {
    $output['success2'] = true;
    unset($output['error']);
    $db->query("DELETE  FROM `order_temp` ");
} else {
    $output['error2'] = "二階段錯誤";
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
