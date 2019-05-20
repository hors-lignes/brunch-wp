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
				require( 'autoprefixer' )( ['last 4 versions'] ),
				require( 'postcss-preset-env' )(),
				require( 'cssnano' )( { preset: 'default' } ),
			]
		}
	},

	sourceMaps: 'inline',

};
