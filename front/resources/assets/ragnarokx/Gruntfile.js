module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({

        config: {
            banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
        },

        pkg: grunt.file.readJSON('package.json'),

        sass: {
            options: {
                update: true
            },
            global: {
                files: {
                    'dist/stylesheets/global.min.css':[
                        'src/stylesheets/global.sass'
                    ]
                }
            }
        },

        uglify: {
            options: {
                banner: '<%= config.banner %>'
            },
            libs: {
                files: {
                    'build/scripts/libs.min.js': [
                        'libs/jquery/dist/jquery.js',
                        'libs/bootstrap-sass/assets/javascripts/bootstrap.js'
                    ],
                    'build/scripts/ie9-libs.min.js': [
                        'libs/html5shiv/dist/html5shiv.js',
                        'libs/respond/dest/respond.min.js'
                    ]
                }
            },
            global: {
                files: {
                    'dist/scripts/global.min.js': [
                        'build/scripts/libs.min.js',
                        'src/scripts/global.js',
                        'src/scripts/components/welcome.js'
                    ]
                }
            }
        },

        watch: {
            css: {
                files: ['**/*.{sass,scss}'],
                tasks: ['sass'],
                options: {
                    spawn: false,
                    livereload: true,
                    interrupt: true
                },
            },
            js: {
                files: ['**/*.js'],
                tasks: ['uglify:global'],
                options: {
                    spawn: false,
                    livereload: true,
                    interrupt: true
                },
            },
        },
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', ['sass', 'uglify']);

};