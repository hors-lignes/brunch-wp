module.exports = {
	files: {
		javascripts: {
			joinTo: {
				'vendor.js': /^(?!js)/,
				'theme.js': /^js/,
			}
		},
		stylesheets: {
			joinTo: {
				'vendor.css': /^vendor/,
				'theme.css': /^css/,
			}
		},
	},

	conventions: {
		assets: /^theme\//,
		vendor: /^vendor\//,
	},

	paths: {
		public: '../wp-content/themes/hors-lignes',
		watched: ['theme','vendor','js','css'],
	},

	modules: {
		nameCleaner: function( path ) {
			return path.replace(/^theme\/|vendor\/|js\/|css\//g, '');
		},
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
