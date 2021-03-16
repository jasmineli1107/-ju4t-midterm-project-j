<?php

if (isset($_POST['select-counties'])) {
    include('../db_connect.php');
    //echo json_encode($_POST, JSON_UNESCAPED_UNICODE);

    $unprepared_sql = "SELECT * FROM member_districts 
    WHERE counties_sid = %s";
    $sql = sprintf($unprepared_sql, $_POST['select-counties']);

    $numsql = "SELECT count(1) num FROM member_counties join member_districts on member_counties.sid = member_districts.counties_sid  
    WHERE counties_sid = %s";
    $sqlnum = sprintf($numsql, $_POST['select-counties']);


    $stmt = $pdo->query($sql);
    $row = $stmt->fetchAll();

    $num = $pdo->query($sqlnum)->fetch();
    $row['num'] = $num;

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}
