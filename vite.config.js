import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        https: true, // Ensure HTTPS is enabled in dev
        hmr: {
            host: "https://friigemate-yp6ck.kinsta.app/", // Specify your production domain
        },
    },
});
