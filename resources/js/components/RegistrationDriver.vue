<template>
    <div class="driver-registration-container">
        <div v-if="!registrationComplete">
            <h2 class="form-title">Driver Registration</h2>
            <form
                @submit.prevent="registerDriver"
                class="driver-registration-form"
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
                    <label for="vehicle_type" class="form-label"
                        >Vehicle Type</label
                    >
                    <input
                        type="text"
                        v-model="formData.vehicle_type"
                        id="vehicle_type"
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="vehicle_number" class="form-label"
                        >Vehicle Number</label
                    >
                    <input
                        type="text"
                        v-model="formData.vehicle_number"
                        id="vehicle_number"
                        class="form-input"
                    />
                </div>
                <div class="form-group">
                    <label for="load_capacity" class="form-label"
                        >Load Capacity</label
                    >
                    <input
                        type="text"
                        v-model="formData.load_capacity"
                        id="load_capacity"
                        class="form-input"
                    />
                </div>

                <!-- Aligned File Uploads in One Line -->
                <div class="form-group file-upload-row">
                    <div class="file-upload-item">
                        <label class="form-label file-upload-label"
                            >License</label
                        >
                        <div class="custom-file-upload">
                            <input
                                type="file"
                                @change="
                                    handleFileUpload($event, 'license_file')
                                "
                                id="license_file"
                                class="file-input"
                            />
                            <label for="license_file" class="file-label">
                                <span class="file-icon">&#128206;</span>
                                <span>
                                    {{
                                        formData.license_file
                                            ? formData.license_file.name
                                            : "Choose License File"
                                    }}
                                </span>
                            </label>
                            <span
                                v-if="formData.license_file"
                                class="file-selected"
                            >
                                Selected: {{ formData.license_file.name }}
                            </span>
                        </div>
                    </div>
                    <div class="file-upload-item">
                        <label class="form-label file-upload-label"
                            >Insurance</label
                        >
                        <div class="custom-file-upload">
                            <input
                                type="file"
                                @change="
                                    handleFileUpload($event, 'insurance_file')
                                "
                                id="insurance_file"
                                class="file-input"
                            />
                            <label for="insurance_file" class="file-label">
                                <span class="file-icon">&#128206;</span>
                                <span>
                                    {{
                                        formData.insurance_file
                                            ? formData.insurance_file.name
                                            : "Choose Insurance File"
                                    }}
                                </span>
                            </label>
                            <span
                                v-if="formData.insurance_file"
                                class="file-selected"
                            >
                                Selected: {{ formData.insurance_file.name }}
                            </span>
                        </div>
                    </div>
                    <div class="file-upload-item">
                        <label class="form-label file-upload-label"
                            >Registration</label
                        >
                        <div class="custom-file-upload">
                            <input
                                type="file"
                                @change="
                                    handleFileUpload(
                                        $event,
                                        'registration_file'
                                    )
                                "
                                id="registration_file"
                                class="file-input"
                            />
                            <label for="registration_file" class="file-label">
                                <span class="file-icon">&#128206;</span>
                                <span>
                                    {{
                                        formData.registration_file
                                            ? formData.registration_file.name
                                            : "Choose Registration File"
                                    }}
                                </span>
                            </label>
                            <span
                                v-if="formData.registration_file"
                                class="file-selected"
                            >
                                Selected: {{ formData.registration_file.name }}
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Aligned File Uploads -->
                <div class="form-group policyfield">
                    <input
                        type="checkbox"
                        v-model="formData.receive_offers"
                        id="receive_offers"
                        class="form-input"
                    /> <span> I would like to receive offers and news</span>
                </div>
                <div class="form-group policyfield">
                    <input
                        type="checkbox"
                        v-model="formData.privacy_policy"
                        id="privacy_policy"
                        class="form-input"
                    /> <span> I accept the <a href="https://friigemate.test/terms-of-service">Terms of Service</a> & <a href="https://friigemate.test/privacy-policy">Privacy Policy</a> <br>
                        By providing your phone number you agree to receive informational text messages from FreightMate. Consent is not a condition of purchase. Messages Frequency will vary. Msg & data rates may apply. Reply HELP for help or STOP to cancel.</span>
                </div>
                <button type="submit" class="form-button">Register</button>
            </form>
        </div>

        <div v-else>
            <h2 class="form-title">Verify Phone Number</h2>
            <p>
                An OTP has been sent to {{ formData.phone }}. Please enter it
                below.
            </p>
            <form @submit.prevent="verifyOtp" class="driver-registration-form">
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
                <button type="submit" class="form-button">Verify OTP</button>
            </form>
            <button @click="resendOtp" class="form-button resend-btn">
                Resend OTP
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            formData: {
                role: "driver",
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
                vehicle_type: "",
                vehicle_number: "",
                load_capacity: "",
                license_file: null,
                insurance_file: null,
                registration_file: null,
            },
            registrationComplete: false,
            otp: "",
        };
    },
    methods: {
        handleFileUpload(event, field) {
            this.formData[field] = event.target.files[0];
        },
        async registerDriver() {
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
.driver-registration-container {
    width: 80%;
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 2rem 2.5rem 2.5rem 2.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
}

.form-title {
    text-align: center;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #222;
}

.driver-registration-form {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}

.form-group {
    margin-bottom: 0.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.25rem;
    font-size: 0.98rem;
    font-weight: 500;
    color: #222;
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
    border-color: #007bff;
    outline: none;
    background: #fff;
}

.form-button {
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

.form-button:hover {
    background-color: #0056b3;
}

.resend-btn {
    background: #f1f1f1;
    color: #007bff;
    border: 1px solid #007bff;
    margin-top: 0.5rem;
    font-size: 0.95rem;
    font-weight: 500;
}

.resend-btn:hover {
    background: #e6e6e6;
    color: #0056b3;
}

/* Improved File Upload Styles */
.custom-file-upload {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    position: relative;
}

.file-input {
    display: none;
}

.file-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #f1f5fa;
    color: #007bff;
    border: 1.5px solid #007bff;
    border-radius: 4px;
    padding: 0.45rem 1rem;
    font-size: 0.98rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s, color 0.2s, border 0.2s;
}

.file-upload-row .file-label span {
    line-height: 1.2;
    font-size: 12px;
}

.file-label:hover {
    background: #e6f0ff;
    color: #0056b3;
    border-color: #0056b3;
}

.file-icon {
    font-size: 1.2rem;
    margin-right: 0.2rem;
}

.file-selected {
    color: #222;
    font-size: 0.93rem;
    margin-left: 0.5rem;
    font-style: italic;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
}

/* Align all file inputs in one line */
.file-upload-row {
    display: flex;
    flex-direction: row;
    gap: 1.5rem;
    justify-content: space-between;
    margin-bottom: 1.2rem;
}
.file-upload-item {
    flex: 1 1 0;
    min-width: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.file-upload-label {
    margin-bottom: 0.3rem;
    display: block;
    font-size: 0.98rem;
    font-weight: 500;
    color: #222;
}

.form-group.policyfield {
    flex-direction: row;
    text-align: left;
    color: #212121;
    gap: 10px;
    display: flex;
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

@media (max-width: 900px) {
    .driver-registration-container {
        width: 98vw;
        max-width: 98vw;
        padding: 1rem 0.3rem;
    }
    .file-label,
    .file-selected {
        font-size: 0.93rem;
        min-width: 120px;
        max-width: 120px;
    }
    .file-upload-row {
        flex-direction: column;
        gap: 0.7rem;
    }
    .file-upload-item {
        width: 100%;
    }
}
</style>
