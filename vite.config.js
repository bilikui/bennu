import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/admin/main.scss',
                'resources/sass/admin/dashmix/themes/xeco.scss',
                'resources/sass/admin/dashmix/themes/xinspire.scss',
                'resources/sass/admin/dashmix/themes/xmodern.scss',
                'resources/sass/admin/dashmix/themes/xsmooth.scss',
                'resources/sass/admin/dashmix/themes/xwork.scss',
                'resources/sass/admin/dashmix/themes/xdream.scss',
                'resources/sass/admin/dashmix/themes/xpro.scss',
                'resources/sass/admin/dashmix/themes/xplay.scss',
                'resources/js/admin/dashmix/app.js',
                'resources/js/app.js',
                'resources/js/admin/pages/datatables.js',
                'resources/js/admin/pages/slick.js',
            ],
            refresh: true,
        }),
    ],
});
