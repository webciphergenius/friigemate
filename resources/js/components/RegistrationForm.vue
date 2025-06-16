<template>
  <div class="mainRegister p-5 text-white">
    <div class="panelLogo"><img src="../../images/logo.png" alt="brand-logo"></div>
    <div class="tab-buttons flex justify-center mb-5 space-x-4">
      <button
        :class="{'bg-blue-500 text-white': activeTab === 'shipper', 'bg-gray-300 text-black': activeTab !== 'shipper'}"
        class="px-4 py-2 rounded"
        @click="activeTab = 'shipper'"
      >
        Shipper
      </button>
      <button
        :class="{'bg-blue-500 text-white': activeTab === 'driver', 'bg-gray-300 text-black': activeTab !== 'driver'}"
        class="px-4 py-2 rounded"
        @click="activeTab = 'driver'"
      >
        Driver
      </button>
    </div>

    <!-- Shipper Form -->
    <div v-if="activeTab === 'shipper'" class="mainTabContent">
      <h2 class="text-2xl font-bold text-center mb-5">Signup as Shipper</h2>
      <form @submit.prevent="handleSubmit('shipper')" class="registerFormMain mx-auto">
        <div class="mb-4 double-field">
          <div class="item-field">
            <label>First Name</label>
            <input v-model="shipperForm.firstname" type="text" class="input-style" required />
          </div>
          <div class="item-field">
            <label>Last Name</label>
            <input v-model="shipperForm.lastname" type="text" class="input-style" required />
          </div>
        </div>

        <div class="mb-4">
          <label>Company</label>
          <input v-model="shipperForm.company" type="text" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Phone</label>
          <input v-model="shipperForm.phone" type="tel" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>SMS OTP <br /><small>(6 digit code sent to phone number)</small></label>
          <div class="flex justify-center space-x-2 mt-2 otp-field-block">
            <input
              v-for="(digit, index) in shipperOtp"
              :key="index"
              v-model="shipperOtp[index]"
              maxlength="1"
              @input="handleOtpInput(index, $event, 'shipper')"
              @keydown.backspace="handleOtpBackspace(index, $event, 'shipper')"
              class="w-12 h-12 text-center text-xl border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              type="text"
            />
          </div>
        </div>

        <div class="mb-4">
          <label>Email</label>
          <input v-model="shipperForm.email" type="email" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Zip Code</label>
          <input v-model="shipperForm.zipcode" type="number" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Address</label>
          <textarea v-model="shipperForm.address" class="input-style" required></textarea>
        </div>

        <div class="mb-4">
          <label>User Name</label>
          <input v-model="shipperForm.username" type="text" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Password</label>
          <input v-model="shipperForm.password" type="password" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Confirm Password</label>
          <input v-model="shipperForm.confirmpassword" type="password" class="input-style" required />
        </div>

        <div class="submitBtn">
          <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Register</button>
        </div>
      </form>

      <div v-if="shipperSubmitted" class="text-green-500 font-medium text-center mt-4">Registration Successful!</div>
    </div>

    <!-- Driver Form -->
    <div v-if="activeTab === 'driver'" class="mainTabContent">
      <h2 class="text-2xl font-bold text-center mb-5">Signup as Driver</h2>
      <form @submit.prevent="handleSubmit('driver')" class="registerFormMain registrationDriverForm mx-auto">
        <div class="mb-4 double-field">
          <div class="item-field">
            <label>First Name</label>
            <input v-model="driverForm.firstname" type="text" class="input-style" required />
          </div>
          <div class="item-field">
            <label>Last Name</label>
            <input v-model="driverForm.lastname" type="text" class="input-style" required />
          </div>
        </div>

        <div class="mb-4">
          <label>Phone</label>
          <input v-model="driverForm.phone" type="tel" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>SMS OTP <br /><small>(6 digit code sent to phone number)</small></label>
          <div class="flex justify-center space-x-2 mt-2 otp-field-block">
            <input
              v-for="(digit, index) in driverOtp"
              :key="index"
              v-model="driverOtp[index]"
              maxlength="1"
              @input="handleOtpInput(index, $event, 'driver')"
              @keydown.backspace="handleOtpBackspace(index, $event, 'driver')"
              class="w-12 h-12 text-center text-xl border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              type="text"
            />
          </div>
        </div>

        <div class="mb-4">
          <label>Email</label>
          <input v-model="driverForm.email" type="email" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Vehicle Type</label>
          <input v-model="driverForm.vehicletype" type="text" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Vehicle Number</label>
          <input v-model="driverForm.vehiclenumber" type="number" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Load Capacity</label>
          <input v-model="driverForm.loadcapacity" type="text" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Zip Code</label>
          <input v-model="driverForm.zipcode" type="number" class="input-style" required />
        </div>

        <div class="mb-4 uploadFiles">
          <label>Please Verify Your ID</label>
          <div class="fieldUpload">
            <label class="block mb-2 font-medium">License Verification</label>
            <input type="file" @change="handleFileUpload($event, 'license')" />
            <p v-if="driverForm.license" class="text-green-600 mt-1">File: {{ driverForm.license.name }}</p>
          </div>

          <div class="fieldUpload">
            <label class="block mb-2 font-medium">Insurance Verification</label>
            <input type="file" @change="handleFileUpload($event, 'insurance')" />
            <p v-if="driverForm.insurance" class="text-green-600 mt-1">File: {{ driverForm.insurance.name }}</p>
          </div>

          <div class="fieldUpload">
            <label class="block mb-2 font-medium">Registration Verification</label>
            <input type="file" @change="handleFileUpload($event, 'registration')" />
            <p v-if="driverForm.registration" class="text-green-600 mt-1">File: {{ driverForm.registration.name }}</p>
          </div>
        </div>

        <div class="mb-4">
          <label>User Name</label>
          <input v-model="driverForm.username" type="text" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Password</label>
          <input v-model="driverForm.password" type="password" class="input-style" required />
        </div>

        <div class="mb-4">
          <label>Confirm Password</label>
          <input v-model="driverForm.confirmpassword" type="password" class="input-style" required />
        </div>

        <div class="submitBtn">
          <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Register</button>
        </div>
      </form>

      <div v-if="driverSubmitted" class="text-green-500 font-medium text-center mt-4">Registration Successful!</div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'

const activeTab = ref('shipper')

// Shipper Form Data
const shipperForm = reactive({
  firstname: '', lastname: '', company: '', phone: '', email: '', zipcode: '', address: '',
  username: '', password: '', confirmpassword: ''
})
const shipperOtp = ref(Array(6).fill(''))
const shipperSubmitted = ref(false)

// Driver Form Data
const driverForm = reactive({
  firstname: '', lastname: '', phone: '', email: '', vehicletype: '', vehiclenumber: '',
  loadcapacity: '', zipcode: '', license: '', insurance: '', registration: '', username: '',
  password: '', confirmpassword: ''
})
const driverOtp = ref(Array(6).fill(''))
const driverSubmitted = ref(false)

function handleOtpInput(index, event, type) {
  const otpArray = type === 'shipper' ? shipperOtp.value : driverOtp.value
  if (event.target.value.length > 1) {
    otpArray[index] = event.target.value.slice(-1)
  }
  if (event.target.value && event.target.nextElementSibling) {
    event.target.nextElementSibling.focus()
  }
}

function handleOtpBackspace(index, event, type) {
  const otpArray = type === 'shipper' ? shipperOtp.value : driverOtp.value
  if (!otpArray[index] && event.target.previousElementSibling) {
    event.target.previousElementSibling.focus()
  }
}

function handleFileUpload(event, fileType) {
  driverForm[fileType] = event.target.files[0]
}

function handleSubmit(type) {
  if (type === 'shipper') {
    console.log('Shipper Form Data:', shipperForm)
    console.log('OTP Entered:', shipperOtp.value.join(''))
    shipperSubmitted.value = true
  } else {
    console.log('Driver Form Data:', driverForm)
    console.log('OTP Entered:', driverOtp.value.join(''))
    driverSubmitted.value = true
  }
}
</script>

<style scoped>
.input-style {
  @apply mt-1 block w-full border-gray-300 rounded-md shadow-sm;
}
</style>
