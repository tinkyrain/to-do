<?php
include_once(__DIR__ . '/../connectDB.php');

session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {
    //Делаем запрос в БД
    $stmt = $pdo->prepare("select * from `users` where `username` = :login");
    $stmt->execute([
        'login' => $_POST['login'],
    ]);

    //Если ползователей с таким логином не найдено,
    //То убиваем процесс и отправляем на фронт, что нет пользователей
    if (!$stmt->rowCount()) {
        echo 'User not exist';
        die;
    }

    //Если пользователь есть, то получаем данные
    $user = $stmt -> fetch(PDO::FETCH_ASSOC);

    //Проверяем пароль
    if(password_verify($_POST['password'], $user['password'])){
        if(password_needs_rehash($user['password'], PASSWORD_DEFAULT)){
            $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE `users` SET `password` = :password WHERE `username` = :login');
            $stmt->execute([
                'login' => $_POST['login'],
                'password' => $newHash,
            ]);
        }

        $_SESSION['user_id'] = $user['id'];

        echo 'Succses';
    } else {
        echo 'Incorrect password';
    }
}