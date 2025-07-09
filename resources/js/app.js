import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import PrivacyPolicy from './components/privacyPolicy.vue'
import HomePage from "./components/HomePage.vue";

const app = createApp({
    components: {
        HomePage,
        PrivacyPolicy
    },
});

app.mount("#app");
