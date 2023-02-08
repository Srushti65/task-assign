<template>
  <div class="container overflow-hidden" v-if="!loading">
    <h1>{{ task.title }}</h1>
    <div class="container outer">
      <h3>{{ task.description }}</h3>
      <div class="inner">
        <div class="date">
          <p>Creation Date : {{ task.created_at }}</p>
          <p>Due Date : {{ task.due_date }}</p>
        </div>
        <div class="names">
          <p>
            Created by :
            {{ task.owner_name }}
            <a href="">{{ task.owner.email }}</a>
          </p>
          <p>
            Assigned to : {{ task.assigned_to_name }}
            <a href="">{{ task.assigned_to.email }}</a>
          </p>
        </div>
      </div>
    </div>
    <div class="mt-4 buttons">
      <NuxtLink to="/" class="btn btn-primary"> Home page </NuxtLink>
      <button class="btn btn-primary" @click="updateTask(task.t_id)">
        <NuxtLink :to="`/update/${task.t_id}`" class="edit"> Edit </NuxtLink>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      task: {},
      users: {},
      loading: true,
    };
  },
  methods: {
    updateTask(id) {
      for (let i in this.$store.state.tasks) {
        if (i.t_id == id) {
          this.tasks = i;
        }
      }
    },
  },
  async fetch() {
    this.loading = true;
    await this.$store.dispatch("getSingleTask", this.$route.params.view);
    Object.assign(this.task, this.$store.state.task);
    this.loading = false;
    console.log(this.$store.state.task + " " + this.task);
  },
};
</script>

<style>
.container {
  margin-top: 50px;
}
.col {
  background-color: rgb(221, 221, 255);
  border: 1px solid rgb(167, 167, 254);
}
.outer {
  background-color: rgb(233 238 255);
  padding: 50px;
}
.inner {
  margin-top: 50px;
  display: flex;
  justify-content: space-between;
}
a {
  text-decoration: none;
  color: rgb(89, 116, 255);
}
.edit {
  color: white;
}
.buttons {
  margin: 10px;
}
</style>
