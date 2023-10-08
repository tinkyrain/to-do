const taskSection = document.getElementById('task-section');
const addBtn = document.getElementById('createTask');
const inputTask = document.getElementById('task-input');

//После загрузки страницы все задачи пользователя появятся на экране
document.addEventListener('DOMContentLoaded', () => {
    displayAllTasks();
});

//При клике на 'Add' произойдёт вызов функции создания
addBtn.onclick = function(e){

    //Отключение перезагрузки страницы
    e.preventDefault();

    //Если поле не пустое, то вызываем функцию создания и чистим поле
    //Иначе выводим сообщение о том, что поле пустое
    if(inputTask.value.trim() !== ''){
        createTask(e);
        inputTask.value = '';
    } else {
        alert('Заполните поле!');
    }
}    

//Функция создания сообщения
function createTask(){

    //Данные, которые будем отправлять в запросе
    const params = new FormData();
    params.set('task', inputTask.value);


    //Запрос на бэк
    fetch('../../backend/todo/create.php', {
        method: 'POST',
        body: params,
    }).then((response) => {
        return response.text();
    }).then((data) => {
        if(data == 1){
            //Обновляем список задач
            displayAllTasks();
        } else {
            //При неудаче выводим сообщение об ошибке
            alert('Ошибка создания задачи!');
        }
    });
}

//Функция отображения всех задач
function displayAllTasks(){
    //Запрос на бек
    fetch('../../backend/todo/displayAll.php', {
        method: 'POST',
        dataType: 'json',
    }).then((response) => {
        return response.json();
    }).then((data) => {
        //Чистим список задач
        taskSection.innerHTML = '';

        //Если задачи есть, то выводим их на экран
        //Если нет, то выводим информационное сообщение
        if(data.length > 0){
            for(let i=0;i<data.length;i++){
                taskSection.innerHTML += `
                    <div class="task-block" data-id="${data[i].id}" onclick='deleteTask(this)'>
                        <h3 class="text-task fw-light">${data[i].task}</h3>
                    </div>
                `;
            }
        } else {
            taskSection.innerHTML = `
                <h3 class="text-center text-muted mt-5">Создайте свою первую задачу!</h3>
            `
        }
    });
}

//Удаление задач
function deleteTask(obj){
    //Получение id задачи
    let id = obj.dataset.id;

    //Параметры, которые будем передавать в запросе
    const params = new FormData();
    params.set('Id', id);

    //Запрос на бек
    fetch('../../backend/todo/delete.php', {
        method: 'POST',
        body: params,
    }).then((response) => {
        return response.text();
    }).then((data) => {
        if(data == 1){
            //Показываем все задачи
            displayAllTasks();
        } else {
            //В случае неудачи выводим сообщение об ошибке
            alert(`Ошибка удаления задачи!`);
        }
    });
}
