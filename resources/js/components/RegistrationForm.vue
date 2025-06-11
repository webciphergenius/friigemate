<template>
  <div class="mainRegister p-5 text-center text-white">
    <h2 class="text-2xl font-bold text-center mb-4">Registration Form</h2>

    <form @submit.prevent="handleSubmit" class="registerFormMain">
      <div class="mb-4">
        <input
          v-model="form.name"
          type="text"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          placeholder="Enter Your Name"
          required
        />
      </div>

      <div class="mb-4">
        <input
          v-model="form.email"
          type="email"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          placeholder="Enter Your Email"
          required
        />
      </div>

      <div class="mb-4">
        <input
          v-model="form.password"
          type="password"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          placeholder="Enter Your Password"
          required
        />
      </div>

      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
      >
        Register
      </button>
    </form>

    <div v-if="submitted" class="text-green-500 font-medium text-center mt-4">
      Registration Successful!
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'

const form = reactive({
  name: '',
  email: '',
  password: ''
})

const submitted = ref(false)

function handleSubmit() {
  console.log('Form Data:', form)
  submitted.value = true
}
</script>

<style scoped>
body {
  background-color: #f3f4f6;
}
</style>