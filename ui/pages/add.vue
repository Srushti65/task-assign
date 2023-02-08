<template>
  <div>
    <h1 class="m-4">ADD</h1>
    <div class="create-new m-5">
      <div class="row justify-content-start">
        <div class="mb-4 col-3">
          <label for="exampleFormControlInput1" class="form-label"
            >Title of the task</label
          >
          <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            v-model="content.title"
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
            v-model="content.description"
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
            v-model="content.owner"
          >
            <option selected>Select the owner</option>
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
            v-model="content.assigned_to"
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
              v-model="content.created_at"
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
              v-model="content.due_date"
            />
          </div>
        </div>
      </div>
      <!-- @keypress.enter="addTask" -->

      <button class="btn btn-dark col-2 p-2 mt-5" @click="addTask">Add</button>
    </div>
    <NuxtLink to="/" class="m-5 btn btn-primary"> Home page </NuxtLink>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      content: {
        title: "",
        description: "",
        owner: "",
        assigned_to: "",
        created_at: "",
        due_date: "",
      },
    };
  },
  methods: {
    addTask() {
      if (this.content) {
        this.$store.dispatch("addTask", this.content);
      }
      // this.content.title = "";
      // this.content.description = "";
      // this.content.created_by = "";
      // this.content.assigned_to = "";
      // this.content.started_at = "";
      // this.content.due_date = "";
    },
    ...mapActions([
      "getUser", //also supports payload `this.nameOfAction(amount)`
    ]),
  },
  async fetch() {
    // this.tasks = await fetch(`http://127.0.0.1:8000/api/tasks`, {}).then(
    //   (res) => res.json()
    // );
    this.getUser();
  },
};
</script>

<style></style>
