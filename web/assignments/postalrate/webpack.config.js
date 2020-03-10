const path = require('path');

module.exports = {
  entry: './src/app.jsx',
  output: {
    path: path.resolve(__dirname, 'public/scripts'),
    filename: 'bundle.js',
  },
  devtool: '#sourcemap',
  module: {
    rules: [{test: /\.jsx$/, exclude: /(node_modules)/, use: 'babel-loader'}],
  },
};
