<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo App</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

  <div id="app">
    <input v-model="newTask" @keyup.enter="addTask" placeholder="Aggiungi un nuovo task" />
    <ul>
      <li v-for="task in tasks" :key="task.id" :class="{ completed: task.completed }">
        <span @click="toggleTask(task)" :class="{ 'completed-text': task.completed }">{{ task.title }}</span>
        <button @click="deleteTask(task)">Elimina</button>
      </li>
    </ul>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/luxon@2.1.1/build/global/luxon.min.js"></script>
  <script src="./assets/js/app.js"></script>

</body>

</html>