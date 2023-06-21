<?php 
    require 'connectDB.php';

    $tasks_list = [];

    $result = $pdo -> query('SELECT * FROM tasks');

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $tasks_list[] = $row;
    }

    echo json_encode($tasks_list);
?>