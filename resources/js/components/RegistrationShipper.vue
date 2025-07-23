<template>
  <div>
    <div v-if="!registrationComplete">
      <h2>Shipper Registration</h2>
      <form @submit.prevent="registerShipper">
        <!-- Registration form fields remain the same -->
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" v-model="formData.first_name" id="first_name" required />
        </div>
        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" v-model="formData.last_name" id="last_name" required />
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" v-model="formData.phone" id="phone" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" v-model="formData.email" id="email" />
        </div>
        <div class="form-group">
          <label for="zipcode">Zipcode</label>
          <input type="text" v-model="formData.zipcode" id="zipcode" />
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" v-model="formData.country" id="country" />
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" v-model="formData.address" id="address" />
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" v-model="formData.username" id="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" v-model="formData.password" id="password" required />
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" v-model="formData.confirm_password" id="confirm_password" required />
        </div>
        <div class="form-group">
          <label for="company">Company</label>
          <input type="text" v-model="formData.company" id="company" />
        </div>
        <button type="submit">Register</button>
      </form>
    </div>

    <div v-else>
      <h2>Verify Phone Number</h2>
      <p>An OTP has been sent to {{ formData.phone }}. Please enter it below.</p>
      <form @submit.prevent="verifyOtp">
        <div class="form-group">
          <label for="otp">OTP</label>
          <input type="text" v-model="otp" id="otp" required />
        </div>
        <button type="submit">Verify OTP</button>
      </form>
      <button @click="resendOtp">Resend OTP</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      formData: {
        role: 'shipper',
        first_name: '',
        last_name: '',
        phone: '',
        email: '',
        zipcode: '',
        country: '',
        address: '',
        username: '',
        password: '',
        confirm_password: '',
        company: '',
      },
      registrationComplete: false,
      otp: '',
    };
  },
  methods: {
    async registerShipper() {
      if (this.formData.password !== this.formData.confirm_password) {
        alert("Passwords do not match!");
        return;
      }

      const data = new FormData();
      for (const key in this.formData) {
        data.append(key, this.formData[key]);
      }

      try {
        const response = await axios.post('http://localhost:3000/api/register', data, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        console.log(response.data);
        this.registrationComplete = true;
        alert('Registration successful! Please check your phone for an OTP.');
      } catch (error) {
        console.error(error);
        alert('Registration failed.');
      }
    },
    async verifyOtp() {
      try {
        const response = await axios.post('http://localhost:3000/api/verify-otp', {
          phone: this.formData.phone,
          otp: this.otp,
        });
        console.log(response.data);
        alert('OTP verification successful! You can now log in.');
        // Optionally, redirect to login page
        // window.location.href = '/login';
      } catch (error) {
        console.error(error);
        alert('OTP verification failed.');
      }
    },
    async resendOtp() {
      try {
        const response = await axios.post('http://localhost:3000/api/resend-otp', {
          phone: this.formData.phone,
        });
        console.log(response.data);
        alert('A new OTP has been sent to your phone.');
      } catch (error) {
        console.error(error);
        alert('Failed to resend OTP.');
      }
    },
  },
};
</script>

<style scoped>
.form-group {
  margin-bottom: 1rem;
}
label {
  display: block;
  margin-bottom: 0.5rem;
}
input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}
button {
  padding: 0.75rem 1.5rem;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 0.5rem;
}
</style>