const path = require('path');

module.exports = {
    name: 'js',
    entry: {
        app: './resource/assets/js/app.js',
        validation: './resource/assets/js/validation.js'
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'public/js')
    },
};
