<?php
require __DIR__ . '/../db_connect.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];


// $sql = "UPDATE `member_address` SET 
// `member_sid`=?,
// `counties_sid`=?,
// `district_sid`=?,
// `receive_location`=?,
// `receive_name`=?,
// `receive_phone`=?

// WHERE `sid`=?";

$unprepared_sql = "UPDATE `member_address` SET 
`member_sid`= %s,
`counties_sid`= %s,
`district_sid`=%s,
`receive_location`='%s',
`receive_name`='%s',
`receive_phone`='%s'

WHERE `sid`='%s'";


$sql = sprintf(
    $unprepared_sql,
    $_POST['member_sid'],
    $_POST['select-counties'],
    $_POST['select-districts'],
    $_POST['receive_location'],
    $_POST['receive_name'],
    $_POST['receive_phone'],
    $_POST['sid'],
);

$stmt = $pdo->prepare($sql);
$stmt->execute();

// $stmt = $pdo->prepare($sql);

// $stmt->execute([
//     $_POST['member_sid'],
//     $_POST['counties_sid'],
//     $_POST['district_sid'],
//     $_POST['receive_location'],
//     $_POST['receive_name'],
//     $_POST['receive_phone'],
//     $_POST['sid'],
// ]);

$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
}else{
    $output['error'] ='資料無更新';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
