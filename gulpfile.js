/** IMPORTAÇÃO DOS ARQUIVOS DAS LIBS INSTALADAS NO PROJETO */
const gulp = require('gulp');
const elixir = require('laravel-elixir');
const webpack = require('webpack');
const WebpackDevServer = require('webpack-dev-server');
const webpackConfig = require('./webpack.config');
const webpackDevConfig = require('./webpack.dev.config');
const mergeWebpack = require('webpack-merge');
const env = require('gulp-env');
const stringifyObject = require('stringify-object');
const file  = require('gulp-file');
const HOST = "0.0.0.0";

// require('laravel-elixir-vue');
// require('laravel-elixir-webpack-official');

// Elixir.webpack.config.module.loaders = [];

// Passando as configurações feitas no webpack configs js
// Elixir.webpack.mergeConfig(webpackConfig);
// Elixir.webpack.mergeConfig(webpackDevConfig);

/** PARA RODAR A TAREFA BASTA ENTRAR COM COMANDO  $ gulp spa-config NO TERMINAL DE COMANDOS */
gulp.task('spa-config',() => {
    env({
        file: '.env',
        type: 'ini'
    });
    
    let spaConfig =  require('./spa.config');
    
    let string = stringifyObject(spaConfig);
    
    // Retorna o arquivo com o conteúdo
    return file('config.js',`module.exports = ${string};`, {src: true})
        .pipe(gulp.dest('./resources/assets/spa/js'));
});


/** PARA RODAR A TAREFA BASTA ENTRAR COM O COMANDO $ gulp webpack-dev-server NO TERMINAL DE COMANDOS */
gulp.task('webpack-dev-server', () => {
    let config = mergeWebpack(webpackConfig, webpackDevConfig);
    let inlineHot = [
        'webpack/hot/dev-server',
        `webpack-dev-server/client?http://${HOST}:8080`,
    ];

    config.entry.admin = [config.entry.admin].concat(inlineHot);
    config.entry.spa = [config.entry.spa].concat(inlineHot);

    new WebpackDevServer(webpack(config), {
        hot: true,
        proxy: {
            '*': `http://${HOST}:8000`
        },
        watchOptions:{
            poll:true,
            aggregateTimeout:300
        },
        publicPath: config.output.publicPath,
        noInfo: true,
        stats:{
            colors: true
        }
    }).listen(8080, HOST, function () {
        console.log("Building project...");
    })
});

/** REALIZA O MIX DOS ARQUIVOS CSS DA APLICAÇÃO */
elixir((mix) => {
    mix.sass('./resources/assets/admin/sass/admin.scss')
        .sass('./resources/assets/spa/sass/spa.scss')
        .copy('./node_modules/materialize-css/fonts/roboto','./public/fonts/roboto')

    gulp.start('spa-config','webpack-dev-server');

    mix.browserSync({
        host: HOST,
        proxy: `http://${HOST}:8080`    // php artisan serve --host=0.0.0.0
                                        // rodar nessa porta para funcionar com o autoreload
    })
});
