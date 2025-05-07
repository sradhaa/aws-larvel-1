const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.m?js$/,
                    exclude: /(node_modules\/(?!alpinejs))/,
                    use: {
                        loader: "babel-loader",
                        options: {
                            presets: ["@babel/preset-env"],
                            plugins: [
                                "@babel/plugin-proposal-optional-chaining",
                            ],
                        },
                    },
                },
            ],
        },
    })
    .version();
