/* jshint node:true */
module.exports = function ( grunt ) {
	'use strict';

	grunt.initConfig( {
		// setting folder templates
		dirs: {
			css: 'assets/css',
			images: 'assets/images',
			js: 'assets/js',
			lang: 'languages'
		},

		// Generate POT files.
		makepot: {
			options: {
				type: 'wp-plugin',
				domainPath: 'languages',
				potHeaders: {
					'report-msgid-bugs-to': 'https://github.com/barrykooij/post-connector/issues',
					'language-team': 'LANGUAGE <EMAIL@ADDRESS>'
				}
			},
			frontend: {
				options: {
					potFilename: 'post-connector.pot',
					exclude: [
						'node_modules/.*',
						'tests/.*',
						'tmp/.*'
					],
					processPot: function ( pot ) {
						return pot;
					}
				}
			}
		},

		po2mo: {
			files: {
				src: '<%= dirs.lang %>/*.po',
				expand: true
			}
		}

	} );

	// Load NPM tasks to be used here
	grunt.loadNpmTasks( 'grunt-shell' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-po2mo' );

	// Just an alias for pot file generation
	grunt.registerTask( 'pot', [
		'makepot'
	] );

};