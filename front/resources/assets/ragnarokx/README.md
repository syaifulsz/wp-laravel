# RAGNAROKX

RAGNAROKX is a modern Bootstrap stack that helps you get started with the best development tools and project framework structure.

## Development Requirements

* [NodeJS and NPM](https://nodejs.org/en/)
* [Grunt CLI](http://gruntjs.com/)
* [Bower](https://bower.io/)
* [SASS](http://sass-lang.com/)
* [Ruby](https://www.ruby-lang.org/en/)

For more information about Bootstrap documentation, click here [Bootstrap](http://getbootstrap.com/).

## How the structure works?

RAGNAROKX contains 3 main directories, they are:

* **src:** *contains the source or development files of the project*
* **libs:** *contains the project's dependencies*
* **dist:** *distribution, it usually contains the compiled project files.*

All customs stylesheets and scripts are suppose to be added into `src` directory. On `src` directory, there are 2 main directories:

* **stylesheets:** *contains custom sass, scss or css files*
* **scripts:** *contains custom javascripts*

Both directory had a `components` directory. Components directory is a directory to store custom components files such as `_welcome.sass`. And this file is added into `global.sass` so that its will be compiled with Grunt and store into `dist/stylesheets/` directory.

Same with `src/scripts/components/` directory, it serve the same purpose as `components` on `stylesheets` directory e.g. `welcome.js`. Only that for scripts components, you need to add it into `Gruntfile.js` so that it will be compiled with Grunt and store into `dist/scripts/` directory.

```
RAGNAROKX
|
│   Gruntfile.js   
│
└───src
│   │
│   └───stylesheets
│       │   global.sass
│       │
|       └───components
|           |   _welcome.sass
|           |   ...
|    
│   └───scripts
│       │   global.js
│       │
|       └───components
|           |   welcome.js
|           |   ...
│   
└───dist
│   │
│   └───stylesheets
│       │   global.min.css
│       │
|       └───components
|           |   ...
|    
│   └───scripts
│       │   global.min.js
│       │
|       └───components
|           |   ...
```
