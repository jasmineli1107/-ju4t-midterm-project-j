<?php

if (isset($_POST['select-edit-series'])) {
    include('../db_connect.php');
    //echo json_encode($_POST, JSON_UNESCAPED_UNICODE);

    $unprepared_sql = "SELECT * FROM phone_series WHERE id=%s";
    $sql = sprintf($unprepared_sql, $_POST['select-edit-series']);

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}
