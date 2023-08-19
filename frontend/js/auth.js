const loginForm = document.getElementById('loginForm');
const regForm = document.getElementById('regForm');

const regLink = document.getElementById('regLink');
const loginLink = document.getElementById('loginLink');

const loginBtn = document.getElementById('loginBtn');
const regBtn = document.getElementById('regBtn');

//Функция для проверки полей на заполненность
function checkFields() {
    let check = true;

    for (let i = 0; i < arguments.length; i++) {
        if (arguments[i].value.trim() === '') {
            arguments[i].style.borderColor = 'red';
            check = false;
        }
    }

    return check;
}

function login(e) {
    //Отключение обновления страницы
    e.preventDefault();

    //Получение данных из формы входа
    const login = document.getElementById('login'),
        password = document.getElementById('password');

    //Вызываем функци проверки полей на пустоту
    if (!checkFields(login, password)) return false;

    //Объект для запроса
    const params = new FormData();

    //Заполняем объект значениями
    params.set('login', login.value);
    params.set('password', password.value);

    //Запрос на сервер для входа
    fetch('backend/auth/login.php', {
        method: 'POST',
        body: params,
    }).then((response) => {
        return response.text();
    }).then((data) => {
        if(data === 'User not exist' || data === 'Incorrect password'){
            login.style.borderColor = 'red';
            password.style.borderColor = 'red';

            alert('Неверный логин или пароль!');
        }

        if(data === 'Succses'){
            //Редиректим на страницу
            window.location.href = 'frontend/pages/todo.php';
        }
    })
}

function registration(e) {
    //Отключение обновления странички
    e.preventDefault();

    //Получение данных из полей
    const login = document.getElementById('regLogin'),
        password = document.getElementById('regPassword'),
        repeatPassword = document.getElementById('regRepeatPassword');

    //Проверка полей на заполненность
    if (!checkFields(login, password, repeatPassword)) return false;

    //при регистрации поля "Пароль" и "Подтвердите пароль" являются одинаковыми
    if(password.value !== repeatPassword.value) {
        password.style.borderColor = 'red';
        repeatPassword.style.borderColor = 'red';

        return false;
    }

    //Объект для запроса
    const params = new FormData();

    //Заполняем объект значениями
    params.set('login', login.value);
    params.set('password', password.value);

    //Запрос на сервер для входа
    fetch('backend/auth/registration.php', {
        method: 'POST',
        body: params,
    }).then((response) => {
        return response.text();
    }).then((data) => {
        if(data === 'Login busy'){
            alert('Данный логин уже занят!');
            return;
        }
        
        if(data === 'Succses'){
            //Чистим поля
            login.value = '';
            password.value = '';
            repeatPassword.value = '';

            //Меняем форму с регистрации на вход
            loginForm.style.display = 'block';
            regForm.style.display = 'none';
        }
    })
}

//Навешиваем на кнопки функции
loginBtn.onclick = login;
regBtn.onclick = registration;

//Смена формы входа на форму регистрации
regLink.onclick = function () {
    loginForm.style.display = 'none';
    regForm.style.display = 'block';
}

//Смена формы решистрации на форму входа
loginLink.onclick = function () {
    loginForm.style.display = 'block';
    regForm.style.display = 'none';
}