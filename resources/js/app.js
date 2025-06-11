import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import HomePage from "./components/HomePage.vue";

import RegistrationForm from "./components/RegistrationForm.vue";

const app = createApp({
    components: {
        HomePage,
        RegistrationForm,
    },
});

app.mount("#app");
