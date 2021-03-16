<?php
// require __DIR__ . '/db_connect.php';
include('../db_connect.php');
$pagename = 'coupons-awards-detail';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;



$perpage = 5;
$t_sql = "SELECT COUNT(1) FROM awards_detail";
$totalrows = $pdo->query($t_sql)->fetch()['COUNT(1)']; //資料的總比數
$totalpages = ceil($totalrows / $perpage);
// 測試
// echo $totalrows;
// exit;
if ($page < 1) $page = 1;
if ($page > $totalpages) $page = $totalpages;


$p_sql = sprintf("SELECT * FROM awards_detail ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perpage, $perpage);

$stmt = $pdo->query($p_sql);

$rows = $stmt->fetchAll();


$output = [
    'page' => $page,
    'perpage' => $perpage,
    'totalrows' => $totalrows,
    '$totalpages' => $totalpages,
    'rows' => $rows,
];
echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
