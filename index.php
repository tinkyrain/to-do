<?php
session_start();

include 'backend/auth/flash.php';

//Если пользователь уже входил в систему, то редиректим его на страницу с ту-ду
if (isset($_SESSION['user_id'])) {
    header('Location: frontend/pages/todo.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="frontend/style/auth.css">
    <title>Авторизация</title>
</head>
<body>
<main>
    <form class="form" method="post" action="backend/auth/login.php">
        <h2 class="form__header-text">Войти в аккаунт</h2>
        <div class="sectionInput">
            <label for="login">Логин</label>
            <input name='login' type='text' class="form__input" id="login" placeholder="Логин" required>
        </div>

        <div class="sectionInput">
            <label for="password">Пароль</label>
            <input name="password" type='password' class="form__input" id="password" placeholder="Пароль"
                   autocomplete="on" required>
        </div>

        <div class="sectionInput">
            <input type='submit' class="formButton" value="Войти" id="loginBtn">
        </div>

        <?php flash() ?>

        <div class="sectionInput">
            <a class="registrationLink" href="registration.php">
                У вас нет аккаунта?
            </a>
        </div>
    </form>
</main>
</body>
</html>