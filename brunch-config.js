module.exports = {
	files: {
		javascripts: {
			joinTo: {
				'vendor.js': /^(?!app)/,
				'theme.js': /^app/,
			}
		},
		stylesheets: {
			joinTo: {
				'vendor.css': /^(?!app)/,
				'theme.css': /^app/,
			}
		},
	},

	paths: {
		public: '../wp-content/themes/hors-lignes',
		watched: ['theme','vendor','js','css','app'],
	},

	npm: {
		globals: {
			$: 'jquery'
		},
		styles: {},
		static: [],
		aliases: {},
	},

	plugins: {
		postcss: {
			processors: [
				require('autoprefixer')(),
				require('csswring')(),
			]
		},
	},

	sourceMaps: 'inline',

};
