<!DOCTYPE html>
<html>
<head>
   <title>Todo webapplication</title>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" type="text/css" href="style.css" /> 
</head>
<body style="background-color:#c28d30">
   <h1>Todo List</h1>
   
   <ul id="taskList">
   <?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "todolist";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Add new task
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $task_name = $_POST["taskInput"];
  $sql = "INSERT INTO tasks (task_name) VALUES ('$task_name')";
  $result = $conn->query($sql);
}

// Update completed status of tasks
if (isset($_POST["completed"])) {
  foreach ($_POST["completed"] as $task_id => $value) {
    $sql = "UPDATE tasks SET completed = 1 WHERE id = $task_id";
    $conn->query($sql);
  }
}

// Delete tasks
if (isset($_POST["delete"])) {
  foreach ($_POST["delete"] as $task_id => $value) {
    $sql = "DELETE FROM tasks WHERE id = $task_id";
    $conn->query($sql);
  }
}

// Get tasks based on category
$category = isset($_POST["category"]) ? $_POST["category"] : "all";
switch ($category) {
  case "uncompleted":
    $sql = "SELECT * FROM tasks WHERE completed = 0";
    break;
  case "completed":
    $sql = "SELECT * FROM tasks WHERE completed = 1";
    break;
  default:
    $sql = "SELECT * FROM tasks";
}
$result = $conn->query($sql);

echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
echo "<input type='text' name='taskInput' id='taskInput' placeholder='Enter task'>";
echo "<button type='submit'>Add</button>";
echo "<select name='category' id='category'>";
echo "<option value='all'" . ($category == "all" ? " selected" : "") . ">All</option>";
echo "<option value='uncompleted'" . ($category == "uncompleted" ? " selected" : "") . ">Uncompleted</option>";
echo "<option value='completed'" . ($category == "completed" ? " selected" : "") . ">Completed</option>";
echo "</select>";
echo "<ul id='taskList'>";

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $checked = $row["completed"] ? "checked" : "";
    echo "<li><input type='checkbox' name='completed[" . $row["id"] . "]' " . $checked . "> " . $row["task_name"] . " <button type='submit' name='delete[" . $row["id"] . "]'>Delete</button></li>";
  }
} else {
  echo "<li>No tasks found.</li>";
}

echo "</ul>";
echo "</form>";

$conn->close();
?>

</ul>

   <script src="script.js"></script>
</body>
</html>

