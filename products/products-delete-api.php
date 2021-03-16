<?php

$output = [
    'status' => 'failed',
    'error_msg' => '參數不足'
];

if (!isset($_POST['design-id'])) {
    echo $output;
    exit;
}

include('../db_connect.php');

// look up selected phone series (this is because we need the series folder name to delete the image from)
$unprepared_lookup_sql = "SELECT * FROM phone_series WHERE id=%s";
$lookup_sql = sprintf($unprepared_lookup_sql, $_POST['select-edit-series']);
$lookup_stmt = $pdo->prepare($lookup_sql);
$lookup_stmt->execute();
$series_data = $lookup_stmt->fetch();

// look up selected phone design (this is because we need the design name to delete the image in case the user modifies it before sending a delete request)
$unprepared_lookup_sql2 = "SELECT design_name_eng FROM phone_designs WHERE id=%s";
$lookup_sql2 = sprintf($unprepared_lookup_sql2, $_POST['design-id']);
$lookup_stmt2 = $pdo->prepare($lookup_sql2);
$lookup_stmt2->execute();
$series_data2 = $lookup_stmt2->fetch();

//sql execution for delete
$unprepared_sql = "DELETE FROM phone_designs WHERE id=%s";
$sql = sprintf($unprepared_sql, $_POST['design-id']);
$stmt = $pdo->prepare($sql);
$stmt->execute();


if ($stmt->rowCount()) {
    $output['status'] = 'success';
    $output['error_msg'] = '';
} else {
    $output['error_msg'] = '有誤無法刪除';
}


// but this is unlikely to happen because usually someone will not modify and then delete data on the same page
$series_folder = str_replace(' ', '-', $series_data['series_name_eng']);;
$filename = str_replace(' ', '-', $series_data2['design_name_eng'] . '.png');

// get directory one level up go, so in this case it would be the director above the "products" folder
$filepath = dirname(__DIR__) . "/imgs/products/series/{$series_folder}/{$filename}";

//delete design photo file from its series folder
unlink($filepath);


echo json_encode($output, JSON_UNESCAPED_UNICODE);
