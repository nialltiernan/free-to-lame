const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');
const { VueLoaderPlugin } = require('vue-loader');
require('dotenv').config()

module.exports = {
    entry: {
        app: './vue/main.js',
    },
    mode: 'development',
    output: {
        path: path.resolve(__dirname, './public/dist'),
        filename: 'vue-[name].js',
        clean: true
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                    },
                    'css-loader'
                ]
            },
        ]
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        },
        extensions: ['.js']
    },
    plugins: [
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin({
            filename: 'vue-[name].css'
        }),
        new webpack.DefinePlugin({
            BASE_URL: JSON.stringify(process.env.BASE_URL),
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false
        })
    ]
}