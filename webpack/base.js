const CleanPlugin = require('clean-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const WebpackNotifier = require('webpack-notifier');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');

module.exports = ({ environment }) => {
    const output = {
        path: `${__dirname}/../public`,
        publicPath: environment.hot ? 'http://localhost:9001/' : environment.assetUrl,
        filename: '[name].js',
        chunkFilename: 'js/[name].js',
    };

    const plugins = [
        new ManifestPlugin({
            fileName: 'mix-manifest.json',
            basePath: '/',
            writeToFileEmit: true,
        }),

        new CleanPlugin({
            cleanOnceBeforeBuildPatterns: [`${__dirname}/../public/js/*`, `${__dirname}/../public/css/*`],
        }),

        new WebpackNotifier({
            alwaysNotify: true,
            excludeWarnings: true,
        }),
    ];

    if (environment.analyze) {
        plugins.push(new BundleAnalyzerPlugin());
    }

    const stats = environment.production ? 'normal' : 'errors-only';

    const performance = {
        hints: false,
    };

    const devServer = {
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Headers': '*',
        },
        contentBase: `${__dirname}/..`,
        historyApiFallback: true,
        port: 9001,
        disableHostCheck: true,
        noInfo: true,
        compress: true,
        quiet: true,
    };

    return { output, plugins, stats, performance, devServer };
};
