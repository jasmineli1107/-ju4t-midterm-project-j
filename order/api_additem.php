<?php
require __DIR__ . '/../db_connect.php';

$output = [
    'success' => false,
    'code' => '0',
    'error' => '參數不足',
];

if (
    !isset($_POST['model']) or !isset($_POST['shell']) or
    !isset($_POST['series']) or !isset($_POST['design']) or
    !isset($_POST['quantity']) or !isset($_POST['price']) or
    intval($_POST['quantity']) < 1
) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sqo = "INSERT INTO `order_temp`(`member_id`, `model_id`,`shell_id`,`series_id`,`design_id`, `per_price`,`quantity`) VALUES (1 , ?, ?, ? , ?, ?, ?)";
$stmt = $pdo->prepare($sqo);
$stmt->execute([
    $_POST['model'],
    $_POST['shell'],
    $_POST['series'],
    $_POST['design'],
    $_POST['price'],
    $_POST['quantity'],
]);
$output['rowCount'] = $stmt->rowCount();

if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
