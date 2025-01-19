import { createApp } from "vue";
import HomePage from "./components/HomePage.vue";

const app = createApp({
    components: {
        HomePage,
    },
});

app.mount("#app");
