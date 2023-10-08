<?php
session_start();

//Если пользователь не авторизировался, то перебрасываем его на страницу со входом
if(!isset($_SESSION['user_id'])){
    header('Location: ../../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="../style/todo.css">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>TO-DO LIST</title>
</head>
<body>
    <main>
        <form class="input-task" method="post" id="createForm" name="createForm" action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control border-primary" id='task-input' placeholder="Введите задачу" name="task">
                <button class="btn btn-primary" type="submit" id="createTask" onclick='add()'>+</button>
            </div>
        </form>

        <section class="col text-center mt-5">
            <form method="post" action='../../backend/auth/out.php'>
                <button class="btn btn-danger text-center" type="submit">Выйти из аккаунта</button>
            </form>
        </section>

        <h1 class="text-center mt-5">Задачи</h1>
        
        <section class="task-section" id="task-section"></section>
    </main>

    <!--JS-->
    <script src="../js/main.js"></script>
</body>
</html>