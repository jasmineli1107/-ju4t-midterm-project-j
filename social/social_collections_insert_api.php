<?php
include('../db_connect.php');

$upload_folder = dirname(__DIR__) . "/imgs/social/uploads";

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];

if (!isset($_POST['name']) or !isset($_POST['public_date'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$ext_map = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

// 有沒有上傳圖
if (!empty($_FILES) and !empty($_FILES['collections']['type']) and $ext_map[$_FILES['collections']['type']]) {
    // 檔案類別上傳成功
    // $output['file'] = $_FILES;

    $filename = uniqid() . $ext_map[$_FILES['collections']['type']];
    // 檔案原始名稱上傳成功
    // $output['filename'] = $filename;
    if (move_uploaded_file($_FILES['collections']['tmp_name'], $upload_folder . '/' . $filename)) {
        // $fields[] = "`collections`= '$filename' ";
    }
};

// 非數字的部分'%s'要包單引號
$unprepare_sql = "INSERT INTO `social` (
    `img`, `name`, `public_date`, `created_at`
    )values(
        '%s','%s','%s',NOW())";
$sql = sprintf($unprepare_sql, $filename, $_POST['name'], $_POST['public_date']);

// INSERT INTO另外一個寫法
// $sql = "INSERT INTO `social`(
//     `img`, `name`, `public_date`, `created_at`
//     ) VALUES (
//         ?, ?, ?, NOW()
//     )";

// 當使用$statement->prepared()時，會先創造一個prepared的聲明(prepared statement)，並且說明哪些是placeholder，會在之後的地方才放入。
// 執行$statement->execute()時，再把屬於該placeholder的值放入，並且加以執行。
$stmt = $pdo->prepare($sql);
$stmt->execute();

// 當INSERT INTO換另外一種寫法時抓資料的用法
// $stmt = $pdo->prepare($sql);
// $stmt->execute([
//     $filename,
//     $_POST['name'],
//     $_POST['public_date'],
// ]);


// 用rowCount() 來得知是否UPDATE與INSERT成功.
$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    unset($output['error']);
    $output['success'] = true;
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
