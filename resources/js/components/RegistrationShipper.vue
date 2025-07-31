<template>
    <div class="shipper-registration-container" style="width: 80%">
        <div v-if="!registrationComplete">
            <h2 class="form-title">Shipper Registration</h2>
            <form
                @submit.prevent="registerShipper"
                class="shipper-registration-form"
            >
                <div class="form-group">
                    <label for="first_name" class="form-label"
                        >First Name</label
                    >
                    <input
                        type="text"
                        v-model="formData.first_name"
                        id="first_name"
                        required
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input
                        type="text"
                        v-model="formData.last_name"
                        id="last_name"
                        required
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input
                        type="text"
                        v-model="formData.phone"
                        id="phone"
                        required
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        v-model="formData.email"
                        id="email"
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="zipcode" class="form-label">Zipcode</label>
                    <input
                        type="text"
                        v-model="formData.zipcode"
                        id="zipcode"
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="country" class="form-label">Country</label>
                    <input
                        type="text"
                        v-model="formData.country"
                        id="country"
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <input
                        type="text"
                        v-model="formData.address"
                        id="address"
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        v-model="formData.username"
                        id="username"
                        required
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        v-model="formData.password"
                        id="password"
                        required
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label"
                        >Confirm Password</label
                    >
                    <input
                        type="password"
                        v-model="formData.confirm_password"
                        id="confirm_password"
                        required
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="company" class="form-label">Company</label>
                    <input
                        type="text"
                        v-model="formData.company"
                        id="company"
                        class="form-input"
                    />
                </div>
                <div class="form-group policyfield">
                    <input
                        type="checkbox"
                        v-model="formData.privacy_policy"
                        id="privacy_policy"
                        class="form-input"
                    /> <span>I agree to receive marketing messaging from Twilio at the phone number provided above. I understand I will receive 2 messages a month, data rates may apply, reply STOP to opt out</span>
                </div>
                <span class="center-policy"><a href="https://friigemate.test/privacy-policy">Privacy Policy</a> | <a href="https://friigemate.test/terms-of-service">Terms of Service</a></span>
                <button type="submit" class="submit-btn">Register</button>
            </form>
        </div>

        <div v-else>
            <h2 class="form-title">Verify Phone Number</h2>
            <p>
                An OTP has been sent to {{ formData.phone }}. Please enter it
                below.
            </p>
            <form @submit.prevent="verifyOtp" class="otp-form">
                <div class="form-group">
                    <label for="otp" class="form-label">OTP</label>
                    <input
                        type="text"
                        v-model="otp"
                        id="otp"
                        required
                        class="form-input"
                    />
                </div>
                <button type="submit" class="submit-btn">Verify OTP</button>
            </form>
            <button @click="resendOtp" class="resend-btn">Resend OTP</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            formData: {
                role: "shipper",
                first_name: "",
                last_name: "",
                phone: "",
                email: "",
                zipcode: "",
                country: "",
                address: "",
                username: "",
                password: "",
                confirm_password: "",
                company: "",
            },
            registrationComplete: false,
            otp: "",
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
                const response = await axios.post(
                    "https://backend-92zcp.kinsta.app/api/register",
                    data,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                console.log(response.data);
                this.registrationComplete = true;
                alert(
                    "Registration successful! Please check your phone for an OTP."
                );
            } catch (error) {
                console.error(error);
                alert("Registration failed.");
            }
        },
        async verifyOtp() {
            try {
                const response = await axios.post(
                    "https://backend-92zcp.kinsta.app/api/verify-otp",
                    {
                        phone: this.formData.phone,
                        otp: this.otp,
                    }
                );
                console.log(response.data);
                alert("OTP verification successful! You can now log in.");
                // Optionally, redirect to login page
                // window.location.href = '/login';
            } catch (error) {
                console.error(error);
                alert("OTP verification failed.");
            }
        },
        async resendOtp() {
            try {
                const response = await axios.post(
                    "https://backend-92zcp.kinsta.app/api/resend-otp",
                    {
                        phone: this.formData.phone,
                    }
                );
                console.log(response.data);
                alert("A new OTP has been sent to your phone.");
            } catch (error) {
                console.error(error);
                alert("Failed to resend OTP.");
            }
        },
    },
};
</script>

<style scoped>
.shipper-registration-container {
    width: 80% !important;
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    padding: 2rem 2.5rem 2.5rem 2.5rem;
}

.form-title {
    text-align: center;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #222;
}

.shipper-registration-form,
.otp-form {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 0.5rem;
    align-items: center;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.4rem;
    color: #333;
    align-self: flex-start;
}

.form-input {
    padding: 0.6rem 0.9rem;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 1rem;
    background: #f8fafc;
    transition: border 0.2s;
    width: 100%;
    min-width: 200px;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0 auto;
    display: block;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    background: #fff;
}

.submit-btn {
    padding: 0.8rem 0;
    background-color: #0951a4;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    margin-top: 0.7rem;
    transition: background 0.2s;
    width: 80%;
    min-width: 200px;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    display: block;
}

.submit-btn:hover {
    background-color: #0056b3;
}

.resend-btn {
    margin-top: 1rem;
    background: none;
    color: #007bff;
    border: none;
    font-size: 1rem;
    cursor: pointer;
    text-decoration: underline;
    padding: 0;
    width: 80%;
    min-width: 200px;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    display: block;
}

.resend-btn:hover {
    color: #0056b3;
}

.form-group.policyfield {
    flex-direction: row;
    text-align: left;
    color: #212121;
    gap: 10px;
    align-items: flex-start;
}

.form-group.policyfield input {
    width: 20px;
    max-width: 20px;
    min-width: 20px;
    margin: 5px 0 0 0;
}

.form-group.policyfield a {
    color: #0851a4 !important;
}

@media (max-width: 600px) {
    .shipper-registration-container {
        width: 100% !important;
        padding: 1rem 0.5rem 1.5rem 0.5rem;
    }
    .form-input,
    .submit-btn,
    .resend-btn {
        width: 100%;
        min-width: 0;
    }
}
</style>
