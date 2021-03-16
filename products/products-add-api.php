<?php

$output = [
    'status' => 'failed',
    'error_msg' => '參數不足'
];


if (isset($_POST['select-edit-series']) and isset($_POST['design-chn-name']) and isset($_POST['design-en-name']) and isset($_POST['status'])) {
    include('../db_connect.php');

    $output['post_data'] = $_POST;

    $unprepared_sql = "INSERT INTO phone_designs (series_id, design_name_chn, design_name_eng, stock_status)
    VALUES (%s, '%s', '%s', %s)";

    $sql = sprintf($unprepared_sql, $_POST['select-edit-series'], $_POST['design-chn-name'], $_POST['design-en-name'], $_POST['status']);
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // $output['sql'] = $sql;

    if ($stmt->rowCount()) {
        $output['status'] = 'success';
        $output['error_msg'] = '';
    } else {
        $output['error_msg'] = '有誤無法新增';
    }

    // look up selected phone series (this is because we need the series folder name to place the images in)
    $unprepared_lookup_sql = "SELECT * FROM phone_series WHERE id=%s";
    $lookup_sql = sprintf($unprepared_lookup_sql, $_POST['select-edit-series']);
    $lookup_stmt = $pdo->prepare($lookup_sql);
    $lookup_stmt->execute();
    $series_data = $lookup_stmt->fetch();
}

// get uploaded file and move it to its own series folder
if (!empty($_FILES)) {
    $output['files'] = $_FILES;

    $filename = str_replace(' ', '-', $_POST['design-en-name']) . '.png';
    $output['filename'] = $filename;

    $series_folder = str_replace(' ', '-', $series_data['series_name_eng']);

    // get directory one level up go, so in this case it would be the director above the "products" folder
    $filepath = dirname(__DIR__) . '/imgs/products/series/' . $series_folder;
    move_uploaded_file(
        $_FILES['photo']['tmp_name'],
        $filepath . '/' . $filename
    );
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
