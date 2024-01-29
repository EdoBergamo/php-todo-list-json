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
      const response = await axios.post('server.php', { title: this.newTask });
      this.tasks.push(response.data); // Aggiungi il nuovo task alla lista
      this.newTask = ''; // Pulisci l'input
    },
    async fetchTasks() {
      const response = await axios.get('server.php');
      this.tasks = response.data;
    },
  },
  mounted() {
    this.fetchTasks();
  },
}).mount('#app');
