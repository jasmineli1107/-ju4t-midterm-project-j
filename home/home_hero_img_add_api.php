<?php
// require __DIR__ . '/is_admin.php';
include('../db_connect.php');

$upload_folder = dirname(__DIR__). '/imgs/home/hero_img_uploads';

$output = [];

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];

// if (!isset($_POST['picture']) or !isset($_POST['description']) or !isset($_POST['view'])) {
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
//上列寫法導致upload無法接收檔案
if (!isset($_POST['sid'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$ext_map = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

// https://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid

// //UUID -> Universally Unique IDentifier（通用唯一識別碼）
// function gen_uuid() {
//     return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
//         // 32 bits for "time_low"
//         mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

//         // 16 bits for "time_mid"
//         mt_rand( 0, 0xffff ),

//         // 16 bits for "time_hi_and_version",
//         // four most significant bits holds version number 4
//         mt_rand( 0, 0x0fff ) | 0x4000,

//         // 16 bits, 8 bits for "clk_seq_hi_res",
//         // 8 bits for "clk_seq_low",
//         // two most significant bits holds zero and one for variant DCE1.1
//         mt_rand( 0, 0x3fff ) | 0x8000,

//         // 48 bits for "node"
//         mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
//     );
// }

//

//files專用用法

if (!empty($_FILES) and !empty($_FILES['file_field']['type']) and $ext_map[$_FILES['file_field']['type']]) {
    $output['file'] = $_FILES;

    $filename = uniqid() . $ext_map[$_FILES['file_field']['type']];
    $output['filename'] = $filename;
    if (move_uploaded_file($_FILES['file_field']['tmp_name'], $upload_folder . '/' . $filename)) {
        $fields[] = "`file_field`= '$filename' ";
    }
}

//UPDATE`MY SQL設的資料庫名稱`，
// $sql = sprintf("UPDATE `social` SET `img`= \"%s\" WHERE `sid`= {$_POST['sid']}", $filename);
//資料傳不回sql
$sql = "INSERT INTO `home_hero_img`(
    `picture`, `description`, `view`, `created_at`
    ) VALUES (
        ?, ?, ?, NOW()
    )";

// $output['sql'] = $sql;


//必須要存在，如果上面有問號execute就要補起來
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $filename,
    $_POST['description'],
    $_POST['view'],
]);

//rowCount()來得知是否update與insert成功
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    unset($output['error']);
}

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);