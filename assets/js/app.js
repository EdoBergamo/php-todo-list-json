const { createApp } = Vue;

createApp({
  data() {
    return {
      newTask: '',
      tasks: [],
    };
  },
  methods: {
    async addTask() {
      const response = await axios.post('api/v1/server.php', { title: this.newTask });
      this.tasks.push(response.data); // Aggiungi il nuovo task alla lista
      this.newTask = ''; // Pulisci l'input
    },
    async fetchTasks() {
      const response = await axios.get('api/v1/server.php');
      this.tasks = response.data;
    },
    async toggleTask(task) {
      task.completed = !task.completed;
      await axios.put(`api/v1/server.php?id=${task.id}`, { completed: task.completed });
    },
    async deleteTask(task) {
      await axios.delete(`api/v1/server.php?id=${task.id}`);
      this.tasks = this.tasks.filter(t => t.id !== task.id);
    }
  },
  mounted() {
    this.fetchTasks();
  },
}).mount('#app');
