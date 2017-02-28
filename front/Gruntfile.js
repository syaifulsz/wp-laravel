module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({

        config: {
            banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
            assets_path: 'resources/assets/ragnarokx',
            public_path: 'public/themes/ragnarokx',
            imgfnt_formats: '{png,jpg,gif,svg,eot,ttf,woff,woff2}'
        },

        pkg: grunt.file.readJSON('package.json'),

        clean: {
            'public_path': ['<%= config.public_path %>'],
            'dist': ['<%= config.public_path %>/dist'],
            'css': ['<%= config.public_path %>/dist/stylesheets'],
            'js': ['<%= config.public_path %>/dist/scripts'],
            'imgfnt': ['<%= config.public_path %>/**/*.<%= config.imgfnt_formats %>']
        },

        sass: {
            options: {
                update: true
            },
            global: {
                files: {
                    '<%= config.public_path %>/dist/stylesheets/global.min.css': [
                        '<%= config.assets_path %>/src/stylesheets/global.sass'
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
                    '<%= config.assets_path %>/build/scripts/libs.min.js': [
                        '<%= config.assets_path %>/libs/jquery/dist/jquery.js',
                        '<%= config.assets_path %>/libs/bootstrap-sass/assets/javascripts/bootstrap.js'
                    ],
                    '<%= config.assets_path %>/build/scripts/ie9-libs.min.js': [
                        '<%= config.assets_path %>/libs/html5shiv/dist/html5shiv.js',
                        '<%= config.assets_path %>/libs/respond/dest/respond.min.js'
                    ]
                }
            },
            global: {
                files: {
                    '<%= config.public_path %>/dist/scripts/global.min.js': [
                        '<%= config.assets_path %>/build/scripts/libs.min.js',
                        '<%= config.assets_path %>/src/scripts/global.js',
                        '<%= config.assets_path %>/src/scripts/components/welcome.js'
                    ]
                }
            }
        },

        copy: {
            global: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= config.assets_path %>/',
                        src: ['**/*.<%= config.imgfnt_formats %>'],
                        dest: '<%= config.public_path %>/'
                    }
                ]
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
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');

    // Default task(s).
    grunt.registerTask('default', ['clean:public_path', 'sass', 'uglify', 'copy']);
    grunt.registerTask('watch_css', ['watch:css']);
    grunt.registerTask('watch_js', ['watch:js']);

};