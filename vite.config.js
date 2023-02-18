import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import ViteRestart from 'vite-plugin-restart';

export default defineConfig({
    plugins: [
        laravel(['resources/sass/main.scss', 'resources/js/app.js']),
        vue({
            runtimeCompiler: true,
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        })
        // ViteRestart({
        //     restart: ['/resources/js/components/client-form/sections/*.vue']
        // })
    ],
    resolve: {
        alias: {
            '@sass': '/resources/sass',
            '@images': '/resources/images',
            '~bootstrap': '/node_modules/bootstrap'
        }
    }
});
