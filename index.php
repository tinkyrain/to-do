<?php 
    session_start();

    //Если пользователь уже входил в систему, то редиректим его на страницу с ту-ду
    if(isset($_SESSION['user_id'])){
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
    <form class="form" id="loginForm">
        <h2 class="form__header-text">Войти в аккаунт</h2>
        <div class="sectionInput">
            <label>Логин</label>
            <input type='text' class="form__input" id="login" placeholder="Логин">
        </div>

        <div class="sectionInput">
            <label>Пароль</label>
            <input type='password' class="form__input" id="password" placeholder="Пароль" autocomplete="on">
        </div>

        <div class="sectionInput">
            <input type='submit' class="formButton" value="Войти" id="loginBtn" onclick='login()'>
        </div>

        <div class="sectionInput">
            <a class="registrationLink" id="regLink" onclick="changeRegistration()">
                У вас нет аккаунта?
            </a>
        </div>
    </form>

    <form class="form" id="regForm">
        <h2 class="form__header-text"> Регистрация </h2>
        <div class="sectionInput">
            <label>Логин</label>
            <input type='text' class="form__input" id="regLogin" placeholder="Логин">
        </div>

        <div class="sectionInput">
            <label>Пароль</label>
            <input type='password' class="form__input" id="regPassword" placeholder="Пароль">
        </div>

        <div class="sectionInput">
            <label>Повторите пароль</label>
            <input type='password' class="form__input" id="regRepeatPassword" placeholder="Повторите пароль">
        </div>

        <div class="sectionInput">
            <input type="submit" class="formButton" value="Создать аккаунт" onclick="registration()" id="regBtn">
        </div>

        <div class="sectionInput">
            <a class="registrationLink" id="loginLink" onclick="changeLogin()">
                У меня есть аккаунт
            </a>
        </div>
    </form>
</main>

<script src="frontend/js/auth.js"></script>
</body>
</html>