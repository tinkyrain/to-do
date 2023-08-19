<?php
include_once(__DIR__ . '/../connectDB.php');

if(isset($_POST['login']) && isset($_POST['password'])){
    //Запрос в БД
    $stmt = $pdo -> prepare("SELECT * FROM `users` WHERE `username` = :login");
    $stmt -> execute(['login' => $_POST['login']]);

    //Если пользователь с таким логином уже есть,
    //То убиваем процесс и отправляем инфу на фронт
    if($stmt->rowCount() > 0){
        echo 'Login busy';
        die;
    }

    //Если пользователя нет, то создаем аккаунт
    $stmt = $pdo -> prepare("INSERT INTO `users` (`username`, `password`) VALUES (:login, :password)");
    $stmt -> execute([
        'login' => $_POST['login'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ]);

    echo 'Succses';
}