const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');
const { VueLoaderPlugin } = require('vue-loader');
require('dotenv').config()

module.exports = {
    entry: './vue/main.js',
    mode: 'development',
    output: {
        path: path.resolve(__dirname, './public/dist'),
        filename: 'vue.js'
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
            filename: 'vue.css'
        }),
        new webpack.DefinePlugin({
            BASE_URL: JSON.stringify(process.env.BASE_URL)
        })
    ]
}