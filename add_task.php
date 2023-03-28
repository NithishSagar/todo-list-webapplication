<?php
$servername = "127.0.0.1";
$dBUsername = "root";
$dBPassword = "";
$dbname = "todolist_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $task_name = $_POST["taskInput"];
   $sql = "INSERT INTO tasks (task_name) VALUES ('$task_name')";
   $result = $conn->query($sql);
}

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>