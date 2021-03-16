<?php
// require __DIR__ . '/is_admin.php';
include('../db_connect.php');

$upload_folder = dirname(__DIR__) . '/imgs/home/hero_img_uploads';

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
// $_FILES["file"]["name"]：上傳檔案的原始名稱。
// $_FILES["file"]["type"]：上傳的檔案類型。
// $_FILES["file"]["size"]：上傳的檔案原始大小。
// $_FILES["file"]["tmp_name"]：上傳檔案後的暫存資料夾位置。
// $_FILES["file"]["error"]：如果檔案上傳有錯誤，可以顯示錯誤代碼。

//
if (!empty($_FILES) and !empty($_FILES['file_field']['type']) and $ext_map[$_FILES['file_field']['type']]) {
    $output['file'] = $_FILES;

    $filename = uniqid() . $ext_map[$_FILES['file_field']['type']];
    $output['filename'] = $filename;
    if (move_uploaded_file($_FILES['file_field']['tmp_name'], $upload_folder . '/' . $filename)) {
        $fields[] = "`file_field`= '$filename' ";
    }

    $unprepared_sql = "UPDATE `home_hero_img` SET 
    `picture`= '%s',
    `description`= '%s',
    `view`=%s,
    `created_at`=NOW()
    WHERE `sid`=%s";

    //把洞填入要的，要用哪個定義，再來就是依序要填的東西
    $sql = sprintf($unprepared_sql, $filename, $_POST['description'], $_POST['view'], $_POST['sid']);

} else {
    $noimageunprepared_sql = "UPDATE `home_hero_img` SET 
    `description`= '%s',
    `view`=%s,
    `created_at`=NOW()
    WHERE `sid`=%s";

    //把洞填入要的，要用哪個定義，再來就是依序要填的東西
    $sql = sprintf($noimageunprepared_sql, $_POST['description'], $_POST['view'], $_POST['sid']);
}



//UPDATE`MY SQL設的資料庫名稱`，
// $sql = sprintf("UPDATE `social` SET `img`= \"%s\" WHERE `sid`= {$_POST['sid']}", $filename);

//資料傳回sql
//先定義挖洞(%S)的參數，不是數字的值要加單引號
// $unprepared_sql = "UPDATE `home_hero_img` SET 
// `picture`= '%s',
// `description`= '%s',
// `view`=%s,
// `created_at`=NOW()
// WHERE `sid`=%s";

// //把洞填入要的，要用哪個定義，再來就是依序要填的東西
// $sql = sprintf($unprepared_sql, $filename, $_POST['description'], $_POST['view'], $_POST['sid']);

//必須要存在，跳脫執行防止入侵
$stmt = $pdo->prepare($sql);
$stmt->execute();

//rowCount()來得知是否update與insert成功
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    unset($output['error']);
}

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
