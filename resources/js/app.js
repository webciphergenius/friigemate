import { createApp } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import PrivacyPolicy from './components/PrivacyPolicy.vue';
import HomePage from "./components/HomePage.vue";

const app = createApp({});

app.component('privacy-policy', PrivacyPolicy);
app.component('home-page', HomePage);

app.mount("#app");
