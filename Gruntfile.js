module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			css: {
				files: 'sass/*.scss',
				tasks: ['sass', 'notify:sass']
			},
			scripts: {
				files: ['js/childTheme.js'],
				tasks: ['uglify', 'notify:uglify']
			}
		},
		sass: {
			dist: {
				options: {
					style: 'compressed'
				},
				src: 'sass/style.scss',
				dest: 'css/style.css'
			}
		},
		concat: {
			dist: {
				src: ['js/modernizr.custom.45533.js', 'js/respond.src.js', 'js/childTheme.js'],
				dest: 'js/siteScripts.js',
			},
		},
		uglify: {
			options: {
				mangle: false
			},
			my_target: {
				files: {
					'js/siteScripts.js': ['js/modernizr.custom.45533.js', 'js/respond.src.js', 'js/childTheme.js']
				}
			}
		},
		browserSync: {
			default_options: {
				bsFiles: {
					src: [
						"style.css",
						"*.php",
						"js/siteScripts.js",
					]
				},
				options: {
					watchTask: true,
					proxy: "parenttheme.v1"
				}
			}
		},
		notify: {
			sass: {
				options: {
					title: "SCSS Compile",
					message: "Success!"
				}
			},
			uglify: {
				options: {
					title: "Uglify Compile",
					message: "Success!"
				}
			}
		}
	});
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-browser-sync');
	grunt.loadNpmTasks('grunt-notify');

	grunt.registerTask('default', ['browserSync', 'watch']);
}
