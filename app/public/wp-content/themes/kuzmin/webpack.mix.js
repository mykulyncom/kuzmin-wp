const mix = require( 'laravel-mix' );
const fs = require( 'fs-extra' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const webpack = require('webpack');
const sassGlobImporter = require('node-sass-glob-importer');

const source = './source';
const build = './assets';

fs.removeSync( build );

const plugins = () => [
  new CopyWebpackPlugin( {
      patterns: [
          {
              from: `${ source }/fonts/**/*.woff2`,
              to: `${ build }/fonts/[name].woff2`,
              noErrorOnMissing: true,
          }
      ],
  } ),
    new webpack.ProvidePlugin({
        '$': 'jquery',
        'jQuery': 'jquery',
        'window.jQuery': 'jquery',
    }),
];

mix.webpackConfig( {
    plugins: plugins(),
} );

mix.autoload({
    jquery: ['$', 'window.jQuery'],
});

mix
    // Styles
    .sass(
        `${source}/styles/main.scss`,
        `${build}/styles/main.min.css`,
        {
            sassOptions: {
                importer: sassGlobImporter(),
            }
        }
    )
    .sass(
        `${source}/styles/editor.scss`,
        `${build}/styles/editor.min.css`,
        {
            sassOptions: {
                importer: sassGlobImporter(),
            }
        }
    )
    .sass(
        `${source}/styles/admin.scss`,
        `${build}/styles/admin.min.css`
    )
    .sourceMaps(false, 'inline-cheap-module-source-map')
    // Scripts
    .js(
        `${source}/scripts/main.js`,
        `${build}/scripts/bundle.js`
    )
    .js(
        `${source}/scripts/editor.js`,
        `${build}/scripts/editor-bundle.js`
    )
    // Options
    .options( {
        processCssUrls: false,
        postCss: [
            require( 'autoprefixer' )( {
                cascade: false,
            } ),
            require( 'postcss-sort-media-queries' ),
        ],
    } );

mix.browserSync({
    proxy: 'http://kuzmin.local',
    open: false,
    notify: false,
    files: [
        './**/**/*.scss',
        './source/scripts/**/*.js',
        './**/*.php'
    ]
})

mix.disableNotifications();
