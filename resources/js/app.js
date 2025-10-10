import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import HomePage from "./components/HomePage.vue";
import RegistrationForm from "./components/RegistrationForm.vue";
import RegistrationDriver from "./components/RegistrationDriver.vue";
import TermsOfService from './components/TermsOfService.vue';
import PrivacyPolicy from "./components/PrivacyPolicy.vue";
import BlogInner from "./components/BlogInner.vue";

const app = createApp({
    components: {
        HomePage,
        RegistrationForm,
        RegistrationDriver,
        TermsOfService,
        PrivacyPolicy,
        BlogInner,
    },
});

app.mount("#app");

