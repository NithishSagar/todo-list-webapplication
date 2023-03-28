CREATE TABLE tasks (
  task_id INT(11) AUTO_INCREMENT PRIMARY KEY,
  task_name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO tasks (task_name) VALUES ('Task name goes here');
SELECT * FROM tasks;
