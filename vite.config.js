import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from 'vite-plugin-static-copy';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/scss/pages/platforms.scss',
        'resources/scss/pages/platform.scss',
        'resources/scss/layouts/layout.scss',
        'resources/scss/pages/home.scss',
        'resources/scss/pages/articles.scss',
        'resources/scss/pages/product.scss',
        'resources/scss/pages/complete-info.scss',
        'resources/scss/pages/search.scss',
        'resources/scss/pages/profile.scss',
        'resources/js/app.js',
        'resources/js/pages/home.js',
      ],

      refresh: true,
    }),
    viteStaticCopy({
      targets: [
        {
          src: 'resources/statics/libs/swiper/swiper.min.css',
          dest: 'libs/css',
        },
        {
          src: 'resources/statics/libs/datePicker/jalalidatepicker.min.css',
          dest: 'libs/css',
        },

        {
          src: 'resources/statics/libs/swiper/swiper.min.js',
          dest: 'libs/js',
        },
        {
          src: 'resources/statics/libs/datePicker/jalalidatepicker.min.js',
          dest: 'libs/js',
        },
        {
          src: 'resources/statics/fonts',
          dest: '.',
        },
      ],
    }),
  ],
  build: {
    outDir: 'public/assets',
    minify: false,
    sourcemap: false,
    rollupOptions: {
      output: {
        entryFileNames: 'js/[name].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name?.endsWith('.css')) {
            return 'css/[name].css';
          } else if (assetInfo.name?.endsWith('.woff2') || assetInfo.name?.endsWith('.woff')) {
            return 'fonts/[name].[ext]';
          }
          return '[name].[ext]'; // برای فایل‌های کپی‌شده مثل png و pdf
        },
      },
    },
  },
});
