<script setup>
import { ref, reactive } from 'vue'

// Tab switching
const activeTab = ref('shipper')

// Form states
const shipperForm = reactive({
  firstname: '',
  lastname: '',
  company: '',
  phone: '',
  email: '',
  zipcode: '',
  address: '',
  username: '',
  password: '',
  confirmpassword: '',
})
const driverForm = reactive({
  firstname: '',
  lastname: '',
  phone: '',
  email: '',
  vehicletype: '',
  vehiclenumber: '',
  loadcapacity: '',
  zipcode: '',
  username: '',
  password: '',
  confirmpassword: '',
  license: null,
  insurance: null,
  registration: null,
})

// OTPs
const shipperOtp = ref(Array(6).fill(''))
const driverOtp = ref(Array(6).fill(''))

// Submission status
const shipperSubmitted = ref(false)
const driverSubmitted = ref(false)

// OTP input handlers
function handleOtpInput(index, event, formType) {
  const value = event.target.value.replace(/\D/g, '') // Allow only digits
  if (value) {
    if (formType === 'shipper') shipperOtp.value[index] = value
    else driverOtp.value[index] = value

    // Move to next input
    const nextInput = event.target.nextElementSibling
    if (nextInput) nextInput.focus()
  }
}

function handleOtpBackspace(index, event, formType) {
  if (!event.target.value && event.key === 'Backspace') {
    const prevInput = event.target.previousElementSibling
    if (prevInput) prevInput.focus()
  }
}

// File upload
function handleFileUpload(event, type) {
  const file = event.target.files[0]
  if (type && file) {
    driverForm[type] = file
  }
}

// Form submit handler
function handleSubmit(formType) {
  if (formType === 'shipper') {
    console.log('Shipper Form Data:', { ...shipperForm, otp: shipperOtp.value.join('') })
    shipperSubmitted.value = true
  } else {
    console.log('Driver Form Data:', { ...driverForm, otp: driverOtp.value.join('') })
    driverSubmitted.value = true
  }

  setTimeout(() => {
    shipperSubmitted.value = false
    driverSubmitted.value = false
  }, 4000)
}
</script>