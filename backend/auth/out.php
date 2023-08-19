<?php
//Инициализируем сессию
session_start();

//Чистим глобальный массив
$_SESSION = [];

//Удаляем файлы куки
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

//Уничтожаем сессию
session_destroy();
