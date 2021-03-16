<?php

if (isset($_POST['select-series'])) {
    include('../db_connect.php');
    //echo json_encode($_POST, JSON_UNESCAPED_UNICODE);

    $unprepared_sql = "SELECT phone_designs.*,`phone_series`.id series_id,`phone_series`.price FROM phone_designs join phone_series on phone_series.id = phone_designs.series_id  WHERE series_id = %s";
    $sql = sprintf($unprepared_sql, $_POST['select-series']);

    $numsql = "SELECT count(1) num FROM phone_designs join phone_series on phone_series.id = phone_designs.series_id  WHERE series_id = %s";
    $sqlnum = sprintf($numsql, $_POST['select-series']);


    $stmt = $pdo->query($sql);
    $row = $stmt->fetchAll();

    $num = $pdo->query($sqlnum)->fetch();
    $row['num'] = $num;

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}
