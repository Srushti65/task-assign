<template>
    <div>
      <form>
        <div>
          <label for="name">Name:</label>
          <input v-model="name" type="text" id="name" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input v-model="email" type="email" id="email" required />
        </div>
        <div>
          <button @click.prevent="submitForm">Submit</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
        email: ''
      }
    },
    methods: {
      submitForm() {
        console.log(`Name: ${this.name}`)
        console.log(`Email: ${this.email}`)
      }
    }
  }
  </script>
  