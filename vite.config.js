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
    build: {
        manifest: true,
        rollupOptions: {
            output: {
                publicPath: "/build/", // Ensure this matches your hosting setup
            },
        },
    },
    server: {
        https: true, // Ensure HTTPS is enabled in dev
        hmr: {
            host: "friigemate-yp6ck.kinsta.app", // Use your domain
        },
    },
});
