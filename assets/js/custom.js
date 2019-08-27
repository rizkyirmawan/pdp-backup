// Live Clock
function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("time").innerText = time;
    document.getElementById("time").textContent = time;
    
    setTimeout(showTime, 1000);
    
  }

    showTime();

//Selection
let btAddTask   = document.querySelectorAll('#btAddTask');
let hrTaskList  = document.querySelectorAll('#hrTaskList');
let txtTaskList = document.querySelectorAll('#task');
let btClose     = document.querySelectorAll('#close');
let btCancel    = document.querySelectorAll('#cancel');
let taskForm    = document.querySelectorAll('.task-form');
let btSubmit    = document.getElementsByClassName('submitButton');
let sbTask      = document.getElementById('sbTask');
let undoneTasks = document.getElementsByClassName('undoneTasks');

for (let i = 0; i < btSubmit.length; i++) {
    btSubmit[i].setAttribute('disabled', '');
}

for (let i = 0; i < btAddTask.length; i++) {
    //Remove Invalid Class
    txtTaskList[i].addEventListener('keyup', function(){
        txtTaskList[i].classList.remove('is-invalid');
    });

    //Add Task
    btAddTask[i].addEventListener('click', function(){
        if(txtTaskList[i].value == '') {
            txtTaskList[i].classList.add('is-invalid');
        } else {
            let newTask = document.createElement('input');
            newTask.setAttribute('type', 'text');
            newTask.setAttribute('name', 'task[]');
            newTask.setAttribute('id', 'newTask');
            newTask.setAttribute('value', txtTaskList[i].value);
            newTask.setAttribute('readonly', 'readonly');
            newTask.classList.add('form-control');
            newTask.classList.add('mb-3');

            hrTaskList[i].after(newTask);
            txtTaskList[i].value = '';
            txtTaskList[i].focus();
            btSubmit[i].removeAttribute('disabled');
        }
    });

    //Remove Tasks
    var removeTasks = function(){
        for(let i = 0; i < btClose.length; i++) {
            btSubmit[i].setAttribute('disabled', '');
            while(taskForm[i].lastElementChild.getAttribute('id') == 'newTask') {
                taskForm[i].removeChild(taskForm[i].lastElementChild);
            }
        }
    }

    for (let i = 0; i < btClose.length; i++) {
        btClose[i].onclick  = removeTasks;
        btCancel[i].onclick = removeTasks;
    }
}

//Start Date < End Date
let startDate = document.getElementsByClassName('start');
let endDate = document.getElementsByClassName('end');

for (let i = 0; i < startDate.length; i++) {
    startDate[i].addEventListener('change', function(e) {
        endDate[i].setAttribute('min', startDate[i].value);
    });
}

//Disable Submit Task Button
document.addEventListener('DOMContentLoaded', function(){
	sbTask.setAttribute('disabled', '');
	for (let i = 0; i < undoneTasks.length; i++) {
		undoneTasks[i].addEventListener('change', function(){
			if(undoneTasks[i].checked === true){
				sbTask.removeAttribute('disabled');
			} else if($('[name="id_task[]"]:checked').length == 0) {
				sbTask.setAttribute('disabled', '');
			} 
		});
	}
});