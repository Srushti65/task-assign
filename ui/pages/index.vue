
<template>
   <form @submit.prevent="submitForm">
      <input v-model="formData.name" type="text" placeholder="Name">
      <input v-model="formData.email" type="email" placeholder="Email">
      <button type="submit" @click="submitForm">Submit</button>
   </form>
</template>

<script>
import axios from 'axios'

export default {
   data () {
      return {
         formData: {
            name: '',
            email: ''
         }
      }
   },
   methods: {
      async submitForm () {
         try {
            const response = await axios.post('http://localhost:8000/api/submit-form', this.formData)
            console.log(response.data.message)
         } catch (error) {
            console.error(error)
         }
      }
   }
}
</script>
