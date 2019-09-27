const common = require("./webpack.common");

const merge = require("webpack-merge");
const path = require("path");

const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");

module.exports = merge(common, {
  mode: "production",
  output: {
    filename: "[name].bundle.js",
    path: path.resolve(__dirname, "build"),
  },
  optimization: {
    minimizer: [
      new OptimizeCssAssetsPlugin(),
      new TerserPlugin()
    ]
  },
  module: {
    rules: [
      {
        test:/\.scss$/,
        use: [ MiniCssExtractPlugin.loader, "css-loader", "sass-loader"  ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({ filename: "./css/build/main.min.css" }),
  ]
});