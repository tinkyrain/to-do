const taskSection = document.getElementById('task-section');

$(document).ready(function(){
    //Display all tasks on the screen
    displayAllTasks();

    $('#createTask').click(function(){
        if($.trim($('#task-input').val) != ''){
            //Function for creating a task in the database
            createTask();
            //Clear field 
            $('#task-input').val('');
            return false;
        } else {
            alert('Enter input');
        }
    });
});

function createTask(){
    $.ajax({
        url: '../backend/create.php',
        type: "POST",
        dataType: "html",
        data: $('#createForm').serialize(),

        success: function(response){
            //Data display
            displayAllTasks();
        },

        error: function(response){
            alert('Error create');
        }
    });
}

//Description of the function for displaying all tasks from the database
function displayAllTasks(){
    $.ajax({
        url: "../backend/displayAll.php",
        type: "POST",
        dataType: 'json',

        success: function(response){
            //Clearing the section where the tasks will be
            $('.task-section').html(``);

            if(response.length > 0){
                //Display all tasks, if any
                for(let i=0;i<response.length;i++){
                    //Inserting HTML text into a section
                    taskSection.innerHTML += `
                        <div class="task-block" data-id="${response[i].id}" onclick='deleteTask(this)'>
                            <h3 class="text-task fw-light">${response[i].task}</h3>
                        </div>
                    `;
                }

            } else {
                //Display alternative text if there are no tasks
                $('.task-section').html(`
                    <h3 class="text-center text-muted mt-5">Enter your first task in the field!</h3>
                `);

            }
        },

        error: function(response){
            alert('Error update');
        }
    });
}

//Delete Tasks
function deleteTask(obj){
    //Getting the ID of the element (ID matches the database)
    let id = $(obj).data('id');

    $.ajax({
        url: '../backend/delete.php',
        type: 'POST',
        data: {Id: id},
        success: function(data){
            if(data == 1){
                //Updating the tasks list
                displayAllTasks();
            } else {
                alert(`Error delete`);
            }
        }
    });
}

