const mix = require("laravel-mix");

require("laravel-mix-blade-reload");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js("resources/midone/js/midone.js", "public/js")
    .sass("resources/midone/sass/app.scss", "public/css")
    .options({
        postCss: [
            require("postcss-import"),
            require("tailwindcss"),
            require("autoprefixer"),
        ],
    })
    .browserSync("pasker.test")
    .bladeReload();
