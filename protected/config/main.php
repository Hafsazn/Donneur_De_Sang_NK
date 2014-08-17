<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Donneur de sang',
    'theme' => 'myTheme',
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap'
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array('bootstrap.gii'),
        ),
    ),
    // application components
    'components' => array(
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js' => FALSE,
		'jquery.min.js' => FALSE,
                'notify.min.js' => FALSE,
               /*'bootstrap.min.js'=>FALSE,*/
                'bootbox.min.js'=>FALSE,
                'bootstrap-noconflict.js'=>FALSE,
                'jquery.yiiactiveform.js'=>FALSE,
                'jquery-ui-bootstrap.css' => 'themes/myTheme/css/app.min.css',
                'bootstrap-yii.css' => 'themes/myTheme/css/app.min.css',
                'bootstrap.min.css' => 'themes/myTheme/css/app.min.css',
            ),
        ),
        'message' => array(
            'source' => 'MPhpMessageSource'
        ),
        'bootstrap' => array(
            'class' => 'ext.yiibooster.components.Bootstrap',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format

        /* 'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          --		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),

          /*'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        /*'db' => array(
            'connectionString' => 'mysql:host=mysql.hostinger.fr;dbname=u284614134_sang',
            'emulatePrepare' => true,
            'username' => 'u284614134_sang',
            'password' => 'don123sang',
            'charset' => 'utf8',
        ),*/
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=donneur',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
    'log' => array(
      'class' => 'CLogRouter',
      'routes' => array(
      array(
      'class' => 'CFileLogRoute',
      'levels' => 'error, warning',
      ),
      // uncomment the following to show log messages on web pages

      array(
      'class'=>'CWebLogRoute',
      ),

      ),
      ), 
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
