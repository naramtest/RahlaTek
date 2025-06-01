import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/admin.css",
                "resources/js/app.js",
                "resources/js/admin/admin.js",
                "resources/css/filament/admin/theme.css",
                "resources/css/filament/dashboard/theme.css",
            ],
            refresh: true,
        }),
    ],
});
