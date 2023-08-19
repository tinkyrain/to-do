<?php
    require '../connectDB.php';

    if(isset($_POST['Id'])){

        $id = $_POST['Id'];
        $sql = "DELETE from tasks WHERE id= :id";

        $params = ['id' => $id];
        $stmt = $pdo->prepare($sql);
        $stmt -> execute($params);

        echo 1;
    } else {
        echo 0;
    }
?>