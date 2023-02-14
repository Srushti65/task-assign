import axios from "@nuxtjs/axios";
export const state = () => ({
  task: {},
  tasks: [],
  users: [],
});

export const actions = {
  async showTask({ commit }) {
    // this.$axios.get(`http://127.0.0.1:8000/api/tasks`).then((response) => {
    //   state.tasks = response.data;
    // });
    let tasks = await fetch(`http://127.0.0.1:8000/api/viewTask`, {});

    let res = await tasks.json();
    commit("SHOW_TASK", res);

    // state.tasks = fetch(`http://127.0.0.1:8000/api/tasks`).then((res) => {
    //   res.json();
    // });
  },

  addTask({ commit }, content) {
    this.$axios
      .post(`http://127.0.0.1:8000/api/add/task`, { data: content })
      .then((res) => {
        // this.tasks.unshift(res.data);
        // console.log(res);
        commit("SHOW_TASK_LIVE", res);
        // alert("submitted");
      })
      .catch((error) => {
        console.log(error);
        // alert(error);
      });
  },
  createUser({ commit }, data) {
    this.$axios
      .post(`http://127.0.0.1:8000/api/submit-form`, { data: data })
      .then((res) => {
        alert("User Created Successfully");
        console.log(data);
      })
      .catch((error) => console.log(error));
  },
  async getUser({ commit }) {
    let users = await fetch(`http://127.0.0.1:8000/api/viewUser`, {});

    let res = await users.json();
    commit("GET_USERS", res);
  },
  async getSingleTask({ commit, dispatch }, id) {
    let task = await this.$axios.get(
      `http://127.0.0.1:8000/api/viewTask/${id}`
    );
    // console.log(task.data);
    // let res = await task;
    // console.log("from store : " + res);
    commit("GET_SINGLE_TASK", task.data);
    await dispatch("getUser");
  },
  deleteTask({ commit }, id) {
    this.$axios
      .delete(`http://127.0.0.1:8000/api/delete/Task/${id}`)
      .then((res) => {
        // this.tasks.unshift(res.data);
        // console.log(res);
        alert("deleted");
        return true;
      })
      .catch((error) => {
        console.log(error);
        // alert(error);
        return false;
      });
    commit("REMOVE_TASK", id);
  },

  updateTask({ commit }, editedContent) {
    console.log(editedContent);
    this.$axios
      .put(`http://127.0.0.1:8000/api/updateTask/${editedContent.t_id}`, {
        data: editedContent,
      })
      .then((res) => {
        // this.tasks.unshift(res.data);
        console.log(res);
        // alert("submitted");
      })
      .catch((error) => {
        console.log(error);
        // alert(error);
      });
  },
};

export const mutations = {
  SHOW_TASK(state, content) {
    state.tasks = content.reverse();
  },
  GET_USERS(state, content) {
    state.users = content;
  },
  SHOW_TASK_LIVE(state, content) {
    state.tasks.unshift(content.data);
  },
  GET_SINGLE_TASK(state, content) {
    state.task = content;
  },

  REMOVE_TASK(state, content) {
    state.tasks = state.tasks.filter((obj) => obj.t_id !== content);
  },
  // ADD_TASK(state, content) {
  //   state.tasks = [content, ...state.tasks];
  //   // alert("In Add Task");
  //   // this.$axios
  //   //   .post(`http://127.0.0.1:8000/api/tasks`, { content: content })
  //   //   .then((res) => {
  //   //     // this.tasks.unshift(res.data);
  //   //     alert("submitted");
  //   //   })
  //   //   .catch((error) => {
  //   //     console.log(error);
  //   //     alert(error);
  //   //   });
  // },

  // REMOVE_TASK(state, task) {
  //     state.tasks.splice(state.tasks.indexOf(task), 1);
  // },
  // TOGGLE_TASK(state, task) {
  // 	task.done = !task.done;
  // }
};
