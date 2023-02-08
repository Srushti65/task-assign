<template>
  <div>
    <h1 class="m-4">MAIN PAGE</h1>
    <!-- <p><NuxtLink to="/view" class="m-3 btn btn-primary">VIEW</NuxtLink></p>

    <p><NuxtLink to="/add" class="m-3 btn btn-primary"> ADD </NuxtLink></p> -->

    <p>
      <NuxtLink to="/create_user" class="m-3 btn btn-primary">
        CREATE USER
      </NuxtLink>
    </p>
    <div class="add">
      <h2>ADD</h2>
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
              v-model="content.owner_id"
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

        <button class="btn btn-dark col-2 p-2 mt-5" @click="addTask">
          Add
        </button>
      </div>
    </div>

    <div class="tasks">
      <h2 m-5>Tasks List</h2>
      <table class="table table-hover">
        <tr>
          <td>Title</td>
          <!-- <td>Description</td> -->
          <td>Created By</td>
          <td>Assigned To</td>
          <!-- <td>Started At</td> -->
          <td>Due Date</td>
          <td>Update/Delete</td>
        </tr>
        <tr v-for="(task, i) in $store.state.tasks" :key="i">
          <td>
            <NuxtLink :to="`/view/${task.t_id}`">{{ task.title }}</NuxtLink>
          </td>
          <!-- <td>{{ task.description }}</td> -->
          <td>{{ task.owner_name }}</td>
          <td>{{ task.assigned_to_name }}</td>
          <!-- <td>{{ task.created_at }}</td> -->
          <td>{{ task.due_date }}</td>
          <td>
            <button class="btn-no-design" @click="updateTask(task.t_id)">
              <NuxtLink :to="`/update/${task.t_id}`">
                <img src="/images/edit.svg" alt="" />
              </NuxtLink>
            </button>
            <!-- <div
              class="modal fade"
              id="exampleModal"
              tabindex="-1"
              role="dialog"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Modal title
                    </h5>
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">...</div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-dismiss="modal"
                    >
                      Close
                    </button>
                    <button type="button" class="btn btn-primary">
                      Save changes
                    </button>
                  </div>
                </div>
              </div>
            </div> -->
            <button class="btn-no-design" @click="deleteTask(task.t_id)">
              <img src="/images/delete.svg" alt="" />
            </button>
          </td>
        </tr>
      </table>

      <!-- {{ $store.state.tasks }} -->
      <!-- <div v-for="(task, i) in $store.state.tasks" :key="i">
        <div v-for="(task, i) in this.tasks" :key="i">
        {{ task }}
        <task :task="task" />
      </div> -->
      <!-- <task v-for="(task, i) in $store.state.tasks" :key="i" :task="task" /> -->
    </div>
  </div>
</template>

<script>
import task from "../components/task.vue";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      tasks: [],
      content: {
        title: "",
        description: "",
        owner_name: "",
        assigned_to_name: "",
        created_at: "",
        due_date: "",
      },
      flag: false,
    };
  },
  components: { task },
  methods: {
    ...mapActions([
      "showTask",
      "getUser", //also supports payload `this.nameOfAction(amount)`
    ]),
    addTask() {
      if (this.content) {
        this.$store.dispatch("addTask", this.content);
      }
    },
    async deleteTask(id) {
      let res = await this.$store.dispatch("deleteTask", id);
      console.log(res);
    },
    updateTask(id) {
      for (let i in this.$store.state.tasks) {
        if (i.t_id == id) {
          this.tasks = i;
        }
      }
    },
  },
  async fetch() {
    this.showTask();
    this.getUser();
  },
};
</script>

<style>
.add {
  background-color: rgb(216, 219, 255);
  padding: 70px;
  margin: 20px 0px;
}
.tasks {
  padding: 70px;
  margin: 20px 0px;
}

.tasks h2 {
  margin-bottom: 30px;
}
.tasks h2 table {
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
.btn-no-design {
  border: 0;
  background-color: transparent;
}
</style>
