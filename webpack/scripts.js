const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');

module.exports = ({ environment }) => {
    const resolve = {
        extensions: ['.js', '.ts', '.tsx'],

        modules: [`${__dirname}/../resources/js`, 'node_modules'],
    };

    const module = {
        rules: [
            {
                test: /\.(js|tsx?)$/,
                use: 'babel-loader',
                exclude: /node_modules/,
            },
        ],
    };

    const plugins = [];

    if (environment.watching) {
        plugins.push(new ForkTsCheckerWebpackPlugin());
    }

    return { resolve, module, plugins };
};
