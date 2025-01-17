import "./bootstrap";
import { createApp } from "vue";

const app = createApp({});

// Example: Add a Vue component
import ExampleComponent from "./components/ExampleComponent.vue";
app.component("example-component", ExampleComponent);

app.mount("#app");
