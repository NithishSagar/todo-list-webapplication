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
   <div class="card">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         <input type="text" name="taskInput" id="taskInput" placeholder="Enter task">
         <button type="submit">Add</button> 
         <select name="category" id="category">
            <option value="all">All</option>
            <option value="uncompleted">Uncompleted</option>
            <option value="completed">Completed</option>
         </select>
      </form>
   </div>
   <ul id="taskList">
      <?php
      if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["task_name"] . "</li>";
         }
      } else {
         echo "<li>No tasks found.</li>";
      }
      ?>
   </ul>
   <script src="script.js"></script>
</body>
</html>

