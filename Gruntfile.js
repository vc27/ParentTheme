module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			css: {
				files: 'sass/style.scss',
				tasks: ['sass']
			},
			scripts: {
				files: ['js/childTheme.js'],
				tasks: ['concat']
			}
		},
		sass: {
			dist: {
				files: {
					'style.css': 'sass/style.scss'
				}
			}
		},
		concat: {
			dist: {
				src: ['js/modernizr.custom.45533.js', 'js/respond.src.js', 'js/childTheme.js'],
				dest: 'js/siteScripts.js',
			},
		}
	});
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default', ['watch']);
}
