const HardSourceWebpackPlugin = require('hard-source-webpack-plugin');

module.exports = {
  mode: 'development',
  devtool: 'source-map',
  entry: './src/js/index.js',
  output: {
    filename: 'script.js'
  },
  watchOptions: {
    ignored: /node_modules/
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              [
                '@babel/preset-env',
                {
                  useBuiltIns: 'usage',
                  corejs: 3,
                  debug: true
                }
              ]
            ]
          }
        }
      }
    ]
  },
  plugins: [
    new HardSourceWebpackPlugin()
  ]
};