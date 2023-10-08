<?php
global $pdo;
include_once(__DIR__ . '/../connectDB.php');
include_once(__DIR__ . '/flash.php');

if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['regRepeatPassword'])) {

    //Проверяем совпадают ли пароли, которые ввёл пользователь
    if ($_POST['regRepeatPassword'] != $_POST['password']) {
        flash('Пароли не совпадают!');
        header('Location: ../../registration.php');
        die;
    }

    //Запрос в БД
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :login");
    $stmt->execute(['login' => $_POST['login']]);

    //Если пользователь с таким логином уже есть,
    //То убиваем процесс и отправляем инфу
    if ($stmt->rowCount() > 0) {
        flash('Логин занят!');
        header('Location: ../../registration.php');
        die;
    }

    //Если пользователя нет, то создаем аккаунт
    $stmt = $pdo->prepare("INSERT INTO `users` (`username`, `password`) VALUES (:login, :password)");
    $stmt->execute([
        'login' => $_POST['login'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ]);

    header('Location: ../../index.php');
    die;
}