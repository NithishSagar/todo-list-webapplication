function addTask() {
    var taskInput = document.getElementById("taskInput");
    var taskList = document.getElementById("taskList");

    // Create a new list item with the task text
    var task = document.createElement("li");
    task.innerText = taskInput.value;

    // Send task data to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_task.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send("task=" + encodeURIComponent(taskInput.value));

    // Add the new list item to the task list
    taskList.appendChild(task);

    // Clear the input field
    taskInput.value = "";
}
