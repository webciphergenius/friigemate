import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import RegistrationForm from "./components/RegistrationForm.vue";
import RegistrationDriver from "./components/RegistrationDriver.vue";
import PrivacyPolicy from "./components/PrivacyPolicy.vue";
import HomePage from "./components/HomePage.vue";

const app = createApp({
    components: {
        HomePage,
        RegistrationForm,
        RegistrationDriver,
        PrivacyPolicy,
    },
});

app.mount("#app");
