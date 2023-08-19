<?php
    require '../connectDB.php';

    session_start();

    if(isset($_POST['task'])){
        $task = $_POST['task'];

        $sql = 'INSERT INTO `tasks` (`user_id`,`task`) VALUES (:user_id, :task)';
        $params = [
            'user_id' => $_SESSION['user_id'],
            'task' => $task,
        ];

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        echo 1;
    } else {
        echo 0;
    }
?>