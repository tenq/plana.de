const path = require('path');
const devMode = process.env.NODE_ENV !== 'production';
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');


module.exports = {
    entry: './assets/src/index.js',
    output: {
        filename: 'scripts/bundle.js',
        // Important make the outputPath config in file-loaders work as expected:
        publicPath: '/wp-content/themes/brainson_theme/assets/dist/',
        path: path.resolve(__dirname, 'assets/dist'),
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: 'styles/bundle.css',
        }),

        new SVGSpritemapPlugin('./assets/src/svg/**/*.svg', {
            output: {
                filename: 'svg/sprite.svg',
                svgo: true,
            },
            sprite: {
                prefix: 'icon-',
                generate: {
                    title: false,
                },
            },
        }),
    ],

    module: {
        rules: [
            {
                test: /\.(pcss|css)$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        // options: {
                        //     hmr: process.env.NODE_ENV === 'development',
                        // },
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            url: true,
                        },
                    },
                    'postcss-loader',
                ]
            },
            {
                test: /\.(png|svg|jpg|gif|ico)$/,
                loader: 'file-loader',
                options: {
                    name: '[folder]/[name].[ext]',
                    outputPath: 'images',
                },
            },
            {
                test: /\.(woff|woff2|ttf)$/,
                loader: 'file-loader',
                options: {
                    name: '[name].[ext]',
                    outputPath: 'fonts'
                },
            },
        ],
    },
};
