<?php 
    require '../connectDB.php';

    session_start();

    $tasks_list = [];

    $result = $pdo -> query("SELECT * FROM `tasks` WHERE `user_id` = {$_SESSION['user_id']}");

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $tasks_list[] = $row;
    }

    echo json_encode($tasks_list);
?>