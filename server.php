<?php
header('Content-Type: application/json');

function readTasks()
{
  $data = file_get_contents('tasks.json');
  return json_decode($data, true);
}

function writeTasks($tasks)
{
  $data = json_encode($tasks, JSON_PRETTY_PRINT);
  file_put_contents('tasks.json', $data);
}

if (!file_exists('tasks.json')) {
  writeTasks([]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $tasks = readTasks();
  $newTask = ['id' => uniqid(), 'title' => $data['title']];
  $tasks[] = $newTask;
  writeTasks($tasks);
  echo json_encode($newTask);
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $data = json_decode(file_get_contents('php://input'), true);
  $taskId = $_GET['id'];
  $tasks = readTasks();

  foreach ($tasks as &$task) {
    if ($task['id'] === $taskId) {
      $task['completed'] = isset($data['completed']) ? filter_var($data['completed'], FILTER_VALIDATE_BOOLEAN) : $task['completed'];
      break;
    }
  }

  writeTasks($tasks);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $tasks = readTasks();
  echo json_encode($tasks);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $taskId = $_GET['id'];
  $tasks = readTasks();
  $tasks = array_filter($tasks, function ($task) use ($taskId) {
    return $task['id'] !== $taskId;
  });
  writeTasks($tasks);
}
