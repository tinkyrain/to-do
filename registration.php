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
    <title>Регистрация</title>
</head>
<body>
<main>
    <form class="form" method="post" action="backend/auth/registration.php">
        <h2 class="form__header-text"> Регистрация </h2>
        <div class="sectionInput">
            <label for="regLogin">Логин</label>
            <input name="login" type='text' class="form__input" placeholder="Логин" id="regLogin" required>
        </div>

        <div class="sectionInput">
            <label for="regPassword">Пароль</label>
            <input name="password" type='password' class="form__input" placeholder="Пароль" id="regPassword" required>
        </div>

        <div class="sectionInput">
            <label for="regRepeatPassword">Повторите пароль</label>
            <input name='regRepeatPassword' type='password' class="form__input" placeholder="Повторите пароль"
                   id="regRepeatPassword" required>
        </div>

        <div class="sectionInput">
            <input type="submit" class="formButton" value="Создать аккаунт">
        </div>

        <?php flash() ?>

        <div class="sectionInput">
            <a class="registrationLink" href="index.php">
                У меня есть аккаунт
            </a>
        </div>
    </form>
</main>
</body>
</html>