const mix = require("laravel-mix");

mix.postCss("resources/css/main.css", "public/css", [
    require("tailwindcss")
]).version();

mix.js("resources/js/message.js", "public/js/message.js").version();
