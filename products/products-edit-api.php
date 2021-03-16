<?php

$output = [
    'status' => 'failed',
    'error_msg' => '參數不足'
];

if (!isset($_POST['series_folder']) or !isset($_POST['select-edit-series']) or !isset($_POST['design-id']) or !isset($_POST['design-chn-name']) or !isset($_POST['old-design-en-name']) or !isset($_POST['design-en-name']) or !isset($_POST['status'])) {
    header('Location: ../products.php');
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


include('../db_connect.php');

$output['post_data'] = $_POST;

$unprepared_sql = "
UPDATE `phone_designs`
SET `series_id`=%s,
`design_name_chn`='%s',
`design_name_eng`='%s',
`stock_status`=%s,
`edit_date`=NOW()
WHERE id=%s
";

$sql = sprintf($unprepared_sql, $_POST['select-edit-series'], $_POST['design-chn-name'], $_POST['design-en-name'], $_POST['status'], $_POST['design-id']);

$stmt = $pdo->prepare($sql);
$stmt->execute();

// sql to get the new series info in case the design has changed series (so file has to move to a new folder)
$unprepared_series_sql = "SELECT * FROM phone_series WHERE id=%s";
$series_sql = sprintf($unprepared_series_sql, $_POST['select-edit-series']);
$series_stmt = $pdo->prepare($series_sql);
$series_stmt->execute();
$series_info = $series_stmt->fetch();

$new_series_folder = str_replace(' ', '-', $series_info['series_name_eng']);

//$output['sql'] = $sql;

if ($stmt->rowCount()) {
    $output['status'] = 'success';
    $output['error_msg'] = '';
} else {
    $output['error_msg'] = '有誤無法修改';
}


// if design eng name is changed, change design photo file name
if ($_POST['old-design-en-name'] != $_POST['design-en-name']) {
    $old_filename = str_replace(' ', '-', $_POST['old-design-en-name']) . '.png';
    $new_filename = str_replace(' ', '-', $_POST['design-en-name']) . '.png';
    $series_folder = $_POST['series_folder'];

    //dirname(__DIR__) is the directory one level up go, so in this case it would be the directory above the "products" folder
    $old_filepath = dirname(__DIR__) . "/imgs/products/series/{$series_folder}/{$old_filename}";
    $new_filepath = dirname(__DIR__) . "/imgs/products/series/{$new_series_folder}/{$new_filename}";

    //rename directory
    rename($old_filepath, $new_filepath);
} else {
    // if the series has changed (but the design eng name has not changed), then move the design photo file to the new series folder
    $old_series_folder = $_POST['series_folder'];
    $filename = str_replace(' ', '-', $_POST['old-design-en-name']) . '.png';

    $old_filepath = dirname(__DIR__) . "/imgs/products/series/{$old_series_folder}/{$filename}";
    $new_filepath = dirname(__DIR__) . "/imgs/products/series/{$new_series_folder}/{$filename}";

    //rename directory
    rename($old_filepath, $new_filepath);
}


// get uploaded file and move it to its own series folder
if (!empty($_FILES)) {
    $output['files'] = $_FILES;

    $filename = str_replace(' ', '-', $_POST['design-en-name']) . '.png';
    $output['filename'] = $filename;

    $series_folder = str_replace(' ', '-', $series_info['series_name_eng']);

    // get directory one level up go, so in this case it would be the directory above the "products" folder
    $filepath = dirname(__DIR__) . '/imgs/products/series/' . $series_folder;
    move_uploaded_file(
        $_FILES['photo']['tmp_name'],
        $filepath . '/' . $filename
    );
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
