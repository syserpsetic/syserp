import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    build: {
        commonjsOptions: {
            include: ["tailwind.config.js", "node_modules/**"],
        },
    },
    optimizeDeps: {
        include: ["tailwind-config"],
    },
    plugins: [
        laravel({
            input: [
                // General
                "resources/css/app.css",
                //"resources/sass/app.scss",
                "resources/js/app.js",

                // Vendor
                "resources/js/vendor/accordion/index.js",
                "resources/js/vendor/alert/index.js",
                "resources/js/vendor/calendar/index.js",
                "resources/js/vendor/calendar/index.js",
                "resources/js/vendor/calendar/plugins/day-grid.js",
                "resources/js/vendor/calendar/plugins/interaction.js",
                "resources/js/vendor/calendar/plugins/list.js",
                "resources/js/vendor/calendar/plugins/time-grid.js",
                "resources/js/vendor/chartjs/index.js",
                "resources/js/vendor/ckeditor/balloon/index.js",
                "resources/js/vendor/ckeditor/balloon-block/index.js",
                "resources/js/vendor/ckeditor/classic/index.js",
                "resources/js/vendor/ckeditor/document/index.js",
                "resources/js/vendor/ckeditor/inline/index.js",
                "resources/js/vendor/dom/index.js",
                "resources/js/vendor/dropdown/index.js",
                "resources/js/vendor/dropzone/index.js",
                "resources/js/vendor/highlight/index.js",
                "resources/js/vendor/image-zoom/index.js",
                "resources/js/vendor/leaflet-map/index.js",
                "resources/js/vendor/litepicker/index.js",
                "resources/js/vendor/lucide/index.js",
                "resources/js/vendor/modal/index.js",
                "resources/js/vendor/pristine/index.js",
                "resources/js/vendor/simplebar/index.js",
                "resources/js/vendor/svg-loader/index.js",
                "resources/js/vendor/tab/index.js",
                "resources/js/vendor/tabulator/index.js",
                "resources/js/vendor/tailwind-merge/index.js",
                "resources/js/vendor/tiny-slider/index.js",
                "resources/js/vendor/tippy/index.js",
                "resources/js/vendor/toastify/index.js",
                "resources/js/vendor/tom-select/index.js",
                "resources/js/vendor/transition/index.js",
                "resources/js/vendor/xlsx/index.js",

                // Pages
                "resources/js/pages/chat/index.js",
                "resources/js/pages/login/index.js",
                "resources/js/pages/modal/index.js",
                "resources/js/pages/notification/index.js",
                "resources/js/pages/slideover/index.js",
                "resources/js/pages/tabulator/index.js",
                "resources/js/pages/validation/index.js",

                // Layouts
                "resources/js/layouts/side-menu/index.js",

                // Components
                "resources/js/components/calendar/index.js",
                "resources/js/components/calendar/draggable/index.js",
                "resources/js/components/balloon-block-editor/index.js",
                "resources/js/components/balloon-editor/index.js",
                "resources/js/components/classic-editor/index.js",
                "resources/js/components/dark-mode-switcher/index.js",
                "resources/js/components/document-editor/index.js",
                "resources/js/components/donut-chart/index.js",
                "resources/js/components/dropzone/index.js",
                "resources/js/components/highlight/index.js",
                "resources/js/components/horizontal-bar-chart/index.js",
                "resources/js/components/inline-editor/index.js",
                "resources/js/components/leaflet-map-loader/index.js",
                "resources/js/components/line-chart/index.js",
                "resources/js/components/litepicker/index.js",
                "resources/js/components/lucide/index.js",
                "resources/js/components/mobile-menu/index.js",
                "resources/js/components/pie-chart/index.js",
                "resources/js/components/preview-component/index.js",
                "resources/js/components/report-bar-chart/index.js",
                "resources/js/components/report-bar-chart-1/index.js",
                "resources/js/components/report-donut-chart/index.js",
                "resources/js/components/report-donut-chart-1/index.js",
                "resources/js/components/report-donut-chart-2/index.js",
                "resources/js/components/report-line-chart/index.js",
                "resources/js/components/report-pie-chart/index.js",
                "resources/js/components/simple-line-chart/index.js",
                "resources/js/components/simple-line-chart-1/index.js",
                "resources/js/components/simple-line-chart-2/index.js",
                "resources/js/components/simple-line-chart-3/index.js",
                "resources/js/components/simple-line-chart-4/index.js",
                "resources/js/components/source/index.js",
                "resources/js/components/stacked-bar-chart/index.js",
                "resources/js/components/stacked-bar-chart-1/index.js",
                "resources/js/components/tiny-slider/index.js",
                "resources/js/components/tippy/index.js",
                "resources/js/components/tippy-content/index.js",
                "resources/js/components/tom-select/index.js",
                "resources/js/components/top-bar/index.js",
                "resources/js/components/vertical-bar-chart/index.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "tailwind-config": path.resolve(__dirname, "./tailwind.config.js"),
            '$': 'jQuery'
        },
    },
    /*server: { 
        hmr: {
            host: 'zeta.unag.edu.hn' 
        }
    },*/
});
