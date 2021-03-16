<?php

$output = [
    'status' => 'failed',
    'error_msg' => '參數不足'
];

if (isset($_POST['series-id'])) {
    include('../db_connect.php');

    $unprepared_sql = "DELETE FROM phone_series WHERE id=%s";

    $sql = sprintf($unprepared_sql, $_POST['series-id']);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $output['sql'] = $sql;

    if ($stmt->rowCount()) {
        $output['status'] = 'success';
        $output['error_msg'] = '';
    } else {
        $output['error_msg'] = '有誤無法刪除';
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
