const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');
const { VueLoaderPlugin } = require('vue-loader');
require('dotenv').config()

module.exports = {
    entry: {
        app: './vue/main.js',
        game: './vue/main-game.js',
        category: './vue/main-category.js',
        'category-list': './vue/main-category-list.js',
        platform: './vue/main-platform.js',
        'platform-list': './vue/main-platform-list.js',
        account: './vue/main-account.js',
        login: './vue/main-login.js',
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
    plugins: [
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin({
            filename: 'vue-[name].css'
        }),
        new webpack.DefinePlugin({
            BASE_URL: JSON.stringify(process.env.BASE_URL)
        })
    ]
}