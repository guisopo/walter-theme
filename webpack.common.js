const path = require("path");

module.exports = {
  entry: {
    main: ["./js/src/app.js", "./css/src/main.scss"],
  },
  module: {
    rules: [
      {
        test: /\.(svg|png|jpg|gif)$/,
        use: {
          loader: "file-loader",
          options: {
            name: "[name].[hash].[ext]",
            outputPath: "images"
          }
        }
      }
    ]
  }
}