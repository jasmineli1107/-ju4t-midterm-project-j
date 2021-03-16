<?php

$output = [
    'status' => 'failed',
    'error_msg' => '參數不足'
];

if (isset($_POST['series-cat']) and isset($_POST['series-chn-name']) and isset($_POST['series-en-name']) and isset($_POST['price'])) {
    include('../db_connect.php');

    $unprepared_sql = "INSERT INTO phone_series (is_classic, series_name_chn, series_name_eng, price)
    VALUES (%s, '%s', '%s', %s)";

    $sql = sprintf($unprepared_sql, $_POST['series-cat'], $_POST['series-chn-name'], $_POST['series-en-name'], $_POST['price']);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // $output['sql'] = $sql;

    if ($stmt->rowCount()) {
        $output['status'] = 'success';
        $output['error_msg'] = '';
    } else {
        $output['error_msg'] = '有誤無法新增';
    }

    // create series folder to store design images for that series
    //get directory one level up go, so in this case it would be the directory above the "products" folder
    $filepath = dirname(__DIR__);

    $foldername = str_replace(' ', '-', $_POST['series-en-name']);
    mkdir($filepath . "/imgs/products/series/$foldername");

}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
