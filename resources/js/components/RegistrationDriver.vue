<template>
    <div class="mainRegister p-5 text-white">
        <h2 class="text-2xl font-bold text-center mb-5">
            Registering as Driver
        </h2>

        <form
            @submit.prevent="handleSubmit"
            class="registerFormMain registrationDriverForm mx-auto"
        >
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
                <label>Phone</label>
                <input
                    v-model="form.phone"
                    type="tel"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                />
            </div>

            <div class="mb-4">
                <label
                    >SMS OTP <br /><small
                        >(6 digit code sent to phone number)</small
                    ></label
                >
                <div class="flex justify-center space-x-2 mt-2 otp-field-block">
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
                <label>Vehicle Type</label>
                <input
                    v-model="form.vehicletype"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                />
            </div>

            <div class="mb-4">
                <label>Vehicle Number</label>
                <input
                    v-model="form.vehiclenumber"
                    type="number"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                />
            </div>

            <div class="mb-4">
                <label>Load Capacity</label>
                <input
                    v-model="form.loadcapacity"
                    type="text"
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

            <div class="mb-4 uploadFiles">
                <label>Please Verify Your ID</label>
                <!-- License Verification -->
                <div class="fieldUpload">
                    <label class="block mb-2 font-medium"
                        >License Verification</label
                    >
                    <input
                        type="file"
                        @change="handleFileUpload($event, 'license')"
                    />
                    <p v-if="form.license" class="text-green-600 mt-1">
                        File: {{ form.license.name }}
                    </p>
                </div>

                <!-- Insurance Verification -->
                <div class="fieldUpload">
                    <label class="block mb-2 font-medium"
                        >Insurance Verification</label
                    >
                    <input
                        type="file"
                        @change="handleFileUpload($event, 'insurance')"
                    />
                    <p v-if="form.insurance" class="text-green-600 mt-1">
                        File: {{ form.insurance.name }}
                    </p>
                </div>

                <!-- Registration Verification -->
                <div class="fieldUpload">
                    <label class="block mb-2 font-medium"
                        >Registration Verification</label
                    >
                    <input
                        type="file"
                        @change="handleFileUpload($event, 'registration')"
                    />
                    <p v-if="form.registration" class="text-green-600 mt-1">
                        File: {{ form.registration.name }}
                    </p>
                </div>
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

            <div class="submitBtn">
                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
                >
                    Register
                </button>
            </div>
            <div class="text-center alternativeForm">
                <a href="registration">Registering as Shipper</a>
            </div>
        </form>

        <div
            v-if="submitted"
            class="text-green-500 font-medium text-center mt-4"
        >
            Registration Successful!
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from "vue";

const form = reactive({
    firstname: "",
    lastname: "",
    company: "",
    phone: "",
    email: "",
    vehicletype: "",
    vehiclenumber: "",
    loadcapacity: "",
    zipcode: "",
    license: "",
    insurance: "",
    registration: "",
    username: "",
    password: "",
    confirmpassword: "",
});

function handleSubmit() {
    console.log("Form Data:", form);
}
</script>
