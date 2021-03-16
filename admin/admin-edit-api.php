<?php
require __DIR__ . '/../db_connect.php';

$upload_folder = dirname(__DIR__ ). '/imgs/members';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
    'post' => $_POST,
];

$ext_map = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

$fields = [];

$fields[] = "`nickname`=" . $pdo->quote($_POST['nickname']);

if (!empty($_POST['new_password'])) {
    $fields[] = sprintf("`password`=%s", $pdo->quote($_POST['new_password']));
}

if (!empty($_FILES) and !empty($_FILES['avatar']['type']) and $ext_map[$_FILES['avatar']['type']]) {
    $output['file'] = $_FILES;

    $filename = uniqid() . $ext_map[$_FILES['avatar']['type']];
    $output['filename'] = $filename;
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_folder . '/' . $filename)) {
        $fields[] = "`avatar`= '$filename' ";
    }
}
$sql = sprintf("UPDATE `admins` SET %s WHERE sid=? AND password=? ", implode(',', $fields));

$output['sql'] = $sql;

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_SESSION['admin']['sid'],
    $_POST['password'],
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    $_SESSION['admin'] = $pdo->query("SELECT * FROM admins WHERE sid=" . intval($_SESSION['admin']['sid']))
        ->fetch();
}else{
    $output['error'] ='資料無更新/密碼錯誤';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
exit;