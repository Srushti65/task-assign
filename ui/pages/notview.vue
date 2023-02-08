<template>
  <div>
    <h1>VIEW</h1>
    <div class="tasks">
      <table>
        <tr>
          <td>Title</td>
          <td>Description</td>
          <td>Created By</td>
          <td>Assigned To</td>
          <td>Started At</td>
          <td>Due Date</td>
        </tr>
      </table>
      <!-- {{ $store.state.tasks }} -->
      <div v-for="(task, i) in $store.state.tasks" :key="i">
        <!-- <div v-for="(task, i) in this.tasks" :key="i"> -->
        <!-- {{ task }} -->
        <task :task="task" />
      </div>
      <!-- <task v-for="(task, i) in $store.state.tasks" :key="i" :task="task" /> -->
    </div>
    <NuxtLink to="/"> Home page </NuxtLink>
  </div>
</template>

<script>
import task from "../components/task.vue";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      tasks: [],
    };
  },
  components: { task },
  methods: {
    ...mapActions([
      "showTask", //also supports payload `this.nameOfAction(amount)`
    ]),
  },
  async fetch() {
    // this.tasks = await fetch(`http://127.0.0.1:8000/api/tasks`, {}).then(
    //   (res) => res.json()
    // );
    this.showTask();
  },
  // this.$store.dispatch("SHOW_TASK");
};
</script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td,
th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
