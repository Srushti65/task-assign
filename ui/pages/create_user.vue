<template>
  <div>
    <h1 class="m-4">CREATE USER</h1>
    <div class="create-new">
      <!-- <input type="text" v-model="user.name" placeholder="Enter Your Name" /> -->

      <!-- <input type="text" v-model="user.email" placeholder="Enter your email" /> -->
      <div class="m-5">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Name</label>
          <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="Your Name"
            v-model="user.name"
          />
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label"
            >Email address</label
          >
          <input
            type="email"
            class="form-control"
            id="exampleFormControlInput2"
            placeholder="name@example.com"
            v-model="user.email"
          />
        </div>

        <button class="btn btn-dark" @click="createUser">Create User</button>
      </div>
    </div>
    <NuxtLink to="/" class="m-5 btn btn-primary"> Home page </NuxtLink>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
      },
    };
  },
  methods: {
    createUser() {
      if (this.user) {
        console.log(this.user);
        this.$store.dispatch("createUser", this.user);
      }
    },
  },
};
</script>
