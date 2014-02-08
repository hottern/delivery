<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
echo YiiBase::getPathOfAlias('application.components.WebApplicationEndBehavior');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Track the package',
    'sourceLanguage' => 'en',
    'language' => 'en',
	// preloading 'log' component
	'preload'=>array('log'),
    'behaviors'=>array(
        'runEnd'=>array(
            'class'=>'application.components.WebApplicationEndBehavior',
        ),
    ),
	// autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    'theme'=>'bootstrap',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
        'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',

            # send activation email
            'sendActivationMail' => false,

            # allow access for non-activated users
            'loginNotActiv' => false,

            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,

            # automatically login from registration
            'autoLogin' => true,

            # registration path
            'registrationUrl' => array('/user/registration'),

            # recovery password path
            'recoveryUrl' => array('/user/recovery'),

            # login form path
            'loginUrl' => array('/user/login'),

            # page after login
            'returnUrl' => array('/user/profile'),

            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        'admin',

	),
    'controllerMap'=>array(
        'YiiFeedWidget' => 'ext.yii-feed-widget.YiiFeedWidgetController'
    ),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login', 'admin/index/login'),
		),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        'request'=>array(
            'enableCsrfValidation'=>true,
        ),
		// uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<language:(ru|zh_cn|en)>/' => 'site/index',
                '<language:(ru|zh_cn|en)>/<action:(contact|login|logout)>/*' => 'site/<action>',
                '<language:(ru|zh_cn|en)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<language:(ru|zh_cn|en)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(ru|zh_cn|en)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
        ),
        ),

		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',*/
		//),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=delivery',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123',
			'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'languages'=>array('ru'=>'Русский', 'zh_cn'=>'Chinese', 'en'=>'English'),
	),
);