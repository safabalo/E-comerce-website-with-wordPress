const path         = require('path');
const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
    devtool: 'eval-source-map',
    mode: isProduction ? 'production' : 'development',
    target: 'web',
    entry: {
        'gateway-settings': path.resolve('./resources/js/gateway-settings.js'),
        'pay-upon-invoice': path.resolve('./resources/js/pay-upon-invoice.js'),
        'oxxo': path.resolve('./resources/js/oxxo.js'),
    },
    output: {
        path: path.resolve(__dirname, 'assets/'),
        filename: 'js/[name].js',
    },
    module: {
        rules: [{
            test: /\.js?$/,
            exclude: /node_modules/,
            loader: 'babel-loader',
        }]
    }
};
