<template>
  <div class="add" v-if="!loading">
    <h2>UPDATE</h2>
    <!-- <button @click="show">{{ this.$route.params.update }}</button> -->
    <div class="add">
      <div class="create-new">
        <div class="row justify-content-start">
          <div class="mb-4 col-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Title of the task</label
            >
            <input
              type="text"
              class="form-control"
              id="exampleFormControlInput1"
              v-model="task.title"
              :placeholder="task.title"
            />
          </div>

          <div class="mb-4 col-9">
            <label for="exampleFormControlInput1" class="form-label"
              >Description of the task</label
            >
            <input
              type="text"
              class="form-control"
              id="exampleFormControlInput1"
              v-model="task.description"
              :placeholder="task.description"
            />
          </div>
        </div>

        <!-- <input type="text" v-model="content.owner" placeholder="who is created" /> -->
        <div class="row justify-content-start">
          <div class="mb-4 col-3">
            <label for="owner" class="form-label">Select the owner</label>
            <select
              class="form-select"
              aria-label="Default select example"
              id="owner"
              name="owner"
              v-model="task.owner_id"
            >
              <option
                v-for="(user, i) in $store.state.users"
                :key="i"
                :value="user.u_id"
              >
                {{ user.name }}
              </option>
            </select>
          </div>

          <div class="mb-4 col-3">
            <label for="assigned_to" class="form-label">Assigned to?</label>
            <select
              class="form-select"
              aria-label="Default select example"
              id="assigned_to"
              name="assigned_to"
              v-model="task.assigned_to_id"
            >
              <option selected>Assigned to?</option>
              <option
                v-for="(user, i) in $store.state.users"
                :key="i"
                :value="user.u_id"
              >
                {{ user.name }}
              </option>
            </select>
          </div>

          <div class="mb-4 col-3">
            <label for="date" class="form-label">Starting Date</label>
            <div class="input-group date" id="datepicker">
              <input
                type="date"
                class="form-control"
                id="date"
                v-model="task.created_at"
                :placeholder="task.created_at"
              />
            </div>
          </div>

          <div class="mb-4 col-3">
            <label for="date" class="form-label">Due Date</label>
            <div class="input-group date" id="datepicker">
              <input
                type="date"
                class="form-control"
                id="date"
                v-model="task.due_date"
                :placeholder="task.due_date"
              />
            </div>
          </div>
        </div>
        <!-- @keypress.enter="addTask" -->

        <button class="btn btn-dark col-2 p-2 mt-5" @click="updateTask">
          Update
        </button>
      </div>
    </div>
    <NuxtLink to="/" class="m-5 btn btn-primary"> Home page </NuxtLink>
  </div>
</template>

<script>
export default {
  data() {
    return {
      task: {},
      loading: true,
    };
  },
  methods: {
    updateTask() {
      let editedContent = this.task;
      if (this.task) {
        this.$store.dispatch("updateTask", editedContent);
      }
      this.$router.push("/");
    },
  },

  async fetch() {
    this.loading = true;
    await this.$store.dispatch("getSingleTask", this.$route.params.update);
    Object.assign(this.task, this.$store.state.task);
    this.loading = false;
    // console.log(this.$store.state.task + " " + this.task);
  },
  //   async fetch() {
  //     let updateTask = this.$store.state.task.find(
  //       (obj) => obj.t_id == this.$route.params.update
  //     );
  //     console.log(updateTask);
  //     Object.assign(this.task, updateTask);
  //     // this.task = ;
  //     console.log(this.task);
  //   },
};
</script>

<style></style>
