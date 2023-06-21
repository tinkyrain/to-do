<?php
    require 'connectDB.php';

    if(isset($_POST['task'])){
        $task = $_POST['task'];

        $sql = 'INSERT INTO tasks(task) VALUES (:task)';
        $params = ['task' => $task];

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        echo 1;
    } else {
        echo 0;
    }
?>