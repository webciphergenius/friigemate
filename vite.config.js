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
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
    build: {
        manifest: true, // Ensure the manifest is generated
        outDir: "public/build", // Set the correct output directory
        rollupOptions: {
            output: {
                // Ensure public path matches Laravel expectations
            },
        },
    },
});
