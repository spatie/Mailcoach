const merge = require('webpack-merge');

const environment = {
    hot: process.argv.includes('--hot'),
    production: process.argv.includes('production'),
    watching: process.argv.includes('--watch') || process.argv.includes('--hot'),
    analyze: process.argv.includes('--analyze'),
    assetUrl: process.env.ASSET_URL ? `${process.env.ASSET_URL}/` : '/',
};

const entry = {
    'js/app': './resources/js/app.tsx',
    'css/app': './resources/css/app.css',
};

if (environment.analyze) {
    delete entry['css/app'];
}

module.exports = merge([
    require('./webpack/base')({ environment }),
    require('./webpack/scripts')({ environment }),
    require('./webpack/styles')({ environment }),
    { entry },
]);
