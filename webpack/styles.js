const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = ({ environment }) => {
    const resolve = {
        extensions: ['.css'],
    };

    const postCssPlugins = [
        require('postcss-easy-import'),
        require('tailwindcss')(),
        ...(environment.production
            ? [
                  require('postcss-preset-env')(),
                  require('cssnano')(),
                  require('@fullhuman/postcss-purgecss')({
                      content: [
                          './resources/js/**/*.ts',
                          './resources/js/**/*.tsx',
                          './resources/views/**/*.blade.php',
                      ],
                      defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || [],
                  }),
              ]
            : []),
    ];

    const module = {
        rules: [
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: 'css-loader', options: { url: false } },
                    {
                        loader: 'postcss-loader',
                        options: {
                            plugins: postCssPlugins,
                        },
                    },
                ],
            },
        ],
    };

    const plugins = [
        new MiniCssExtractPlugin({
            filename: '[name].css',
        }),
    ];

    return { resolve, module, plugins };
};
