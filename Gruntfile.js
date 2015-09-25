/* global module:false */
module.exports = function(grunt) {

   // Load Dependencies
  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

  // Project configuration
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    meta: {
      banner:
        '/*!\n' +
        ' * LegalNetwork <%= pkg.version %> (<%= grunt.template.today("yyyy-mm-dd, HH:MM") %>)\n' +
        ' * Copyright (C) 2015 Labigar, http://labigar.nl\n' +
        ' */'
    },


    jshint: {
      options: {
        curly: true, //This option requires you to always put curly braces around blocks in loops and conditionals.
        eqeqeq: true, //This options prohibits the use of == and != in favor of === and !==
        immed: true, //This option prohibits the use of immediate function invocations without wrapping them in parentheses
        indent: false, //This option enforces specific tab width for your code
        latedef: true, //This option prohibits the use of a variable before it was defined.
        sub: true, //This option suppresses warnings about using [] notation when it can be expressed in dot notation: person['name'] vs. person.name.
        undef: false, //This option prohibits the use of explicitly undeclared variables. This option is very useful for spotting leaking and mistyped variables.
        eqnull: true, //This option suppresses warnings about == null comparisons. Such comparisons are often useful when you want to check if a variable is null or undefined.
        browser: true, //This option defines globals exposed by modern browsers: all the way from good old document and navigator to the HTML5 FileReader and other new developments in the browser world.
        globals: { 
          head: false,
          module: false,
          console: false
        },
        jquery: true,
        devel:true // This allows to work with alerts and console logs
      },
      files: [ 'Gruntfile.js', 'js/src/**.js']
    },

    // minified (source and destination files)
    uglify: {
      options: {
        banner: '<%= meta.banner %>\n'
      },
      buildJsFiles: {
        files: {
          'js/scripts.min.js': [
            'js/src/**.js'
            //'!js/src/reservations.js',
            //'!js/src/timeline.js'
          ]
          //MODULES
          //'js/reservations.min.js': [ 'js/src/reservations.js' ],
          //'js/timeline.min.js': [ 'js/src/timeline.js' ]
        }
      }
    },

    sass: {
      options: {
        style: 'compressed',
        banner: '<%= meta.banner %>\n'
      },
      buildSassFiles: {
        files: {
          'css/styles.min.css': [
            'css/src/base.scss'
          ],
          'css/flexslider.min.css': ['css/src/plugins/flexslider.scss'],
          'css/slidebars.min.css': ['css/src/plugins/slidebars.scss'],
          '../../plugins/ubermenu/custom/custom.css': 'css/src/plugins/ubermenu.scss'
        }
      }
    },

    zip: {
      'teamadvocaten.zip': [ 
        'css/**',
        '!css/src/**',
        '!css/img/*.psd',
        '!css/*.map',
        'images/**',
        'js/**',
        '!js/src/**', //Lets ignore src files
        'package.json',
        'favicon.ico'
      ]
    },

    // Tasks being executed with 'grunt watch'
    watch: {
      css: {
        files: ['**/*.scss','Gruntfile.js','**/plugins/*.scss',],
        tasks: ['sass']
      },
      js: {
        files: ['js/src/*.js','Gruntfile.js'],
        tasks: ['jshint','uglify']
      }
    },

    shell: {
      bumpVersion: {
        command: 'npm version patch'
      }
    }


  });

   // Package presentation to archive
  grunt.registerTask( 'deploy', ['jshint','sass:buildSassFiles','uglify:buildJsFiles','shell:bumpVersion','zip'] );

};