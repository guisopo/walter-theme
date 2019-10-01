const common = require("./webpack.common");
const webpack = require('webpack');
const merge = require("webpack-merge");
const path = require("path");

const configureDevServer = () => {
	return {
		contentBase: path.join(__dirname, 'dist'),
		host: 'localhost',
		hot: true,
		inline: true,
		overlay: true,
		port: 8080,
	};
};

module.exports = merge(common, {
  devServer: configureDevServer(),
  devtool: 'source-map',
  mode: "development",
  module: {
    rules: [{
			test: /\.s[c|a]ss$/,
			use: [ 'style-loader', 'css-loader', 'sass-loader' ],
		}, {
			test: /\.(svg|png|jpe?g)$/,
			use: {
				loader: 'file-loader',
				options: {
					name: '[name].[ext]',
					outputPath: path.join(__dirname, '/images'),
					publicPath: 'http://localhost:8080/',
				},
			},
		}]
  },
  output: {
		filename: 'site.js',
		path: path.join(__dirname, '/dist'),
		publicPath: 'http://localhost:8080/',
	},
  plugins: [ new webpack.HotModuleReplacementPlugin() ],
});