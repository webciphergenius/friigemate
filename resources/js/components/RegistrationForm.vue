<template>
  <div class="mainRegister p-5 text-white">
    <h2 class="text-2xl font-bold text-center mb-5">Registration Form</h2>

    <form @submit.prevent="handleSubmit" class="registerFormMain mx-auto">
      <div class="mb-4 double-field">
        <div class="item-field">
          <label>First Name</label>
          <input
            v-model="form.firstname"
            type="text"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            required
          />
        </div>
        <div class="item-field">
          <label>Last Name</label>
          <input
            v-model="form.lastname"
            type="text"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            required
          />
        </div>
      </div>

      <div class="mb-4">
        <label>Company</label>
        <input
          v-model="form.company"
          type="text"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
      </div>

      <div class="mb-4">
        <label>Phone</label>
        <input
          v-model="form.phone"
          type="tel"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
      </div>

      <div class="mb-4">
        <label>Email</label>
        <input
          v-model="form.email"
          type="email"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
      </div>

      <div class="mb-4">
        <label>Zip Code</label>
        <input
          v-model="form.zipcode"
          type="number"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
      </div>

      <div class="mb-4">
        <label>Address</label>
        <textarea
          v-model="form.address"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        ></textarea>
      </div>

      <div class="mb-4">
        <label>User Name</label>
        <input
          v-model="form.username"
          type="text"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
      </div>

      <div class="mb-4">
        <label>Password</label>
        <input
          v-model="form.password"
          type="password"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
      </div>

      <div class="mb-4">
        <label>Confirm Password</label>
        <input
          v-model="form.confirmpassword"
          type="password"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
      </div>

      <div class="mb-4">
        <label>SMS OTP <br /><small>(6 digit code sent to phone number)</small></label>
        <div class="flex justify-center space-x-2 mt-2">
          <input
            v-for="(digit, index) in otp"
            :key="index"
            v-model="otp[index]"
            maxlength="1"
            @input="handleInput(index, $event)"
            @keydown.backspace="handleBackspace(index, $event)"
            class="w-12 h-12 text-center text-xl border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="text"
          />
        </div>
      </div>

      <div class="submitBtn">
        <button
          type="submit"
          class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
        >
          Register
        </button>
      </div>
    </form>

    <div v-if="submitted" class="text-green-500 font-medium text-center mt-4">
      Registration Successful!
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'

const form = reactive({
  firstname: '',
  lastname: '',
  company: '',
  phone: '',
  email: '',
  zipcode: '',
  address: '',
  username: '',
  password: '',
  confirmpassword: ''
})

const otpLength = 6
const otp = ref(Array(otpLength).fill(''))

const submitted = ref(false)

function handleInput(index, event) {
  const input = event.target
  if (input.value.length > 1) {
    otp.value[index] = input.value.slice(-1) // Keep only the last character if pasted
  }

  if (input.value && input.nextElementSibling) {
    input.nextElementSibling.focus()
  }
}

function handleBackspace(index, event) {
  if (!otp.value[index] && event.target.previousElementSibling) {
    event.target.previousElementSibling.focus()
  }
}

function handleSubmit() {
  console.log('Form Data:', form)
  console.log('OTP Entered:', otp.value.join(''))

  // You can add password and OTP validation here if needed

  submitted.value = true
}
</script>