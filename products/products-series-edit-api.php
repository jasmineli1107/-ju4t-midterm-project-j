<?php

$output = [
    'status' => 'failed',
    'error_msg' => '參數不足'
];

//echo json_encode($_POST, JSON_UNESCAPED_UNICODE);

if (isset($_POST['series-id']) and isset($_POST['is-classic']) and isset($_POST['series-chn-name']) and isset($_POST['old-series-en-name']) and isset($_POST['series-en-name']) and isset($_POST['price'])) {
    include('../db_connect.php');

    $unprepared_sql = "UPDATE `phone_series` 
    SET `is_classic`=%s,
    `series_name_chn`='%s',
    `series_name_eng`='%s',
    `price`=%s 
    WHERE `id`=%s";

    $sql = sprintf($unprepared_sql, $_POST['is-classic'], $_POST['series-chn-name'], $_POST['series-en-name'], $_POST['price'], $_POST['series-id']);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // $output['sql'] = $sql;
    $output['post_data'] = $_POST;

    if ($stmt->rowCount()) {
        $output['status'] = 'success';
        $output['error_msg'] = '';
    } else {
        $output['error_msg'] = '有誤無法編輯';
    }

    ///rename folder if series changes
    if ($_POST['old-series-en-name'] !=  $_POST['series-en-name']) {
        $old_foldername =  str_replace(' ', '-', $_POST['old-series-en-name']);
        $new_foldername = str_replace(' ', '-', $_POST['series-en-name']);

        //dirname(__DIR__) is the directory one level up go, so in this case it would be the directory above the "products" folder
        $old_filepath = dirname(__DIR__) . "/imgs/products/series/{$old_foldername}";
        $new_filepath = dirname(__DIR__) . "/imgs/products/series/{$new_foldername}";

        //rename directory
        rename($old_filepath, $new_filepath);
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
