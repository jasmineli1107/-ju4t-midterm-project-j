<?php
include('../db_connect.php');

//dirname(__DIR__) is the directory one level up go, so in this case it would be the directory above the "products" folder
$upload_folder = dirname(__DIR__) . "/imgs/social/uploads";

$output = [
    'success' => false,
    'code' => 0,
    'error' => '新增失敗',
    'post' => $_POST,
];

if (!isset($_POST['sid'])) {
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
    //$output['file'] = $_FILES;

    $filename = uniqid() . $ext_map[$_FILES['collections']['type']];
    // 檔案原始名稱上傳成功
    // $output['filename'] = $filename;
    if (move_uploaded_file($_FILES['collections']['tmp_name'], $upload_folder . '/' . $filename)) {
        // $fields[] = "`collections`= '$filename' ";
    }
    //json_encode($fields)
    $sql = sprintf("UPDATE `social` SET `img`= \"%s\" WHERE `sid`= {$_POST['sid']}", $filename);
} else {
    $sql = "UPDATE `social` SET `img`= {$_POST['img']} WHERE `sid`= {$_POST['sid']}";
};





// 抓出上面問號的部分prepare(),execute()
$stmt = $pdo->prepare($sql);
$stmt->execute([]);

// rowCount() 來得知是否UPDATE與INSERT成功.
$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
