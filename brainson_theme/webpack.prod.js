const path = require('path');
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');



const HtmlCriticalWebpackPlugin = require('html-critical-webpack-plugin');

module.exports = merge(common, {
    mode: 'production',

    optimization: {
        minimizer: [new TerserPlugin({}), new CssMinimizerPlugin()],
    },

    plugins: [
        // The generated CriticalCSS assumes the folder assets/dist to be available on the document root
        // This is inlined into the head via functions.php when the site is run in production mode

        // Create additional instances of `HtmlCriticalWebpackPlugin`
        // to extract different critical files from different sources.
        new HtmlCriticalWebpackPlugin({
            base: path.resolve(__dirname, 'assets'),

            // @todo use configuration file to set URL
            // Local files work, too:  'about.html',
            src: 'http://scaffold-theme.ldiomande.brai/',
            dest: 'dist/styles/critical.css',
            inline: false,
            minify: true,
            extract: false,
            width: 1440,
            height: 900,
            penthouse: {
                blockJSRequests: false,
            }
        }),

    ],
});
