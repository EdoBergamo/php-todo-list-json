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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $tasks = readTasks();
  echo json_encode($tasks);
}
