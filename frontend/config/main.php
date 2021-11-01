<?php
use \kartik\datecontrol\Module;
//use \kartik\dynagrid\Module;
//use \dektrium\user\Module;


$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

//require_once( dirname(__FILE__) . '/../../vendor/robregonm/rgraph/RGraphWidget.php');
//require_once( dirname(__FILE__) . '/../../vendor/robregonm/rgraph/RGraphBar.php');

$config = [
    'id' => 'app-frontend',
    'name' => 'WT-Data',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'debug',
//        [   'class' => 'app\widgets\LanguageSelector',
//            'supportedLanguages' => ['en_US', 'de_DE', 'el_EL', 'el', 'en', 'de'],
//        ],    
     ],
    'controllerNamespace' => 'frontend\controllers',
    'sourceLanguage' => 'en',
    'language' => 'de',
    'timeZone' => 'Europe/Berlin',
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
/*            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
*/         ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
				'view' => [
						'theme' => [
								'pathMap' => [
										'@app/views' => '@app/themes/basic',
										'@app/modules' => '@app/themes/basic/modules', // <-- !!!
										'@app/widgets' => '@app/themes/basic/widgets',
                		'@dektrium/user/views' => '@app/views/user'
								],
								'baseUrl' => '@web/themes/basic',
						],
				],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['de', 'en', 'el'],
            'enableDefaultLanguageUrlCode' => true,
            'enableLanguagePersistence' => false,
            'ignoreLanguageUrlPatterns' => [
                // route pattern => url pattern
                '#^site/(login|register)#' => '#^(signin|signup)#',
                '#^DATA Nr.#' => '#^DATA Nr.#',
                '#^api/#' => '#^api/#',
//                '#^/favicon3.ico#' => '#/frontend/favicon3.ico#'
            ],
//            'suffix' => '.html',
            'rules' => [
                'http://swm.wingtzun.de/nl.php' => 'http://swm.wingtzun.de/nl.php',
                'page/<view:[a-zA-Z0-9-]+>' => 'site/page',
                'site/DATA<[a-zA-Z0-9-]+>' => 'site/DATA<[a-zA-Z0-9-]+>',
                // ...
            ],
        ],
        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
				/*       'mitglieder' => [
            'identityClass' => 'app\models\Mitglieder',
            'enableAutoLogin' => true,
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning', 'trace', 'info'],
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' =>  [
            [
               'actions' => ['login', 'error', 'select-language', 'language'],
               'allow' => true,
            ],
            [
              'allow' => true,
              'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
          return Yii::$app->response->redirect(['user/security/login']);
        },
    ],
    'modules' => [
    		'debug' => [
						'class' => 'yii\debug\Module',
						'allowedIPs' => ['127.0.0.1','172.16.55.24' ]
				],
				'backup'=> [
						'class'=>'\klikar3\modules\backup\Module',
						// other module settings
				],
				'gridview' => [
						'class' => '\kartik\grid\Module'
						// enter optional module parameters below - only if you need to
						// use your own export download action or custom translation
						// message source
						// 'downloadAction' => 'gridview/export/download',
						// 'i18n' => []
				],
				'dynagrid'=> [
						'class'=>'\kartik\dynagrid\Module',
            'themeConfig' => [
                'simple-default'=>['panel'=>false,'bordered'=>false,'striped'=>false,'hover'=>true,'layout'=>"<hr>{dynagrid}<hr> {summary} {items} {pager}"],
                'simple-bordered'=>['panel'=>false,'striped'=>false,'hover'=>true,'layout'=>"<hr>{dynagrid}<hr> {summary} {items} {pager}"],
                'simple-condensed'=>['panel'=>false,'striped'=>false,'condensed'=>true,'hover'=>true,'layout'=>"<hr>{dynagrid}<hr> {summary} {items} {pager}"],
                'simple-striped'=>['panel'=>false,'layout'=>"<hr>{dynagrid}<hr> {summary} {items} {pager}"],
                'panel-default'=>['panel'=>['type'=>\kartik\grid\GridView::TYPE_DEFAULT,'before'=>"{dynagrid}"]],
                'panel-primary'=>['panel'=>['type'=>\kartik\grid\GridView::TYPE_PRIMARY,'before'=>"{dynagrid}"]],
                'panel-info'=>['panel'=>['type'=>\kartik\grid\GridView::TYPE_INFO,'before'=>"{dynagrid}"]],
                'panel-danger'=>['panel'=>['type'=>\kartik\grid\GridView::TYPE_DANGER,'before'=>"{dynagrid}"]],
                'panel-success'=>['panel'=>['type'=>\kartik\grid\GridView::TYPE_SUCCESS,'before'=>"{dynagrid}"]],
                'panel-warning'=>['panel'=>['type'=>\kartik\grid\GridView::TYPE_WARNING,'before'=>"{dynagrid}"]],
                'my-condensed'=>['panel'=>['type'=>\kartik\grid\GridView::TYPE_INFO,'before'=>"{dynagrid}"],'striped'=>true,'condensed'=>true,'hover'=>true,'layout'=>"<hr>{dynagrid}<hr> {summary} {items} {pager}"],
        ],

						// other module settings
				],
		   'datecontrol' =>  [
		        'class' => '\kartik\datecontrol\Module',
 
						// format settings for displaying each date attribute (ICU format example)
						'displaySettings' => [
								Module::FORMAT_DATE => 'php:d.m.Y',
								Module::FORMAT_TIME => 'php:H:i:s',
								Module::FORMAT_DATETIME => 'php:d.m.Y H:i:s',
						],
						// format settings for saving each date attribute (PHP format example)
						'saveSettings' => [
								Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
								Module::FORMAT_TIME => 'php:H:i:s',
								Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
						],
 
						 // set your display timezone
						'displayTimezone' => 'Europe/Berlin',
						 
						// set your timezone for date saved to db
						'saveTimezone' => 'Europe/Berlin',
						
		         // automatically use kartik\widgets for each of the above formats
						'autoWidget' => true,
						'ajaxConversion' => true,
						 
						// default settings for each widget from kartik\widgets used when autoWidget is true
						'autoWidgetSettings' => [
								Module::FORMAT_DATE => ['type'=>2, 
									'pluginOptions'=>[
											'autoclose'=>true,  
											'todayHighlight' => true,
											'todayBtn' => true,
//											'format' => 'php:d-m-Y',
											'language' => 'de'
									]
								], // example
								Module::FORMAT_DATETIME => [
										'pluginOptions'=>[
												'autoclose'=>true,  
												'todayHighlight' => true,
												'todayBtn' => true
										]
								], // setup if needed
								Module::FORMAT_TIME => [
										'pluginOptions'=>[
												'autoclose'=>true,  
												'todayHighlight' => true,
												'todayBtn' => true
										]
								], // setup if needed
						],


		    ],		    
	      'user' => [
	          'class' => 'dektrium\user\Module',
/*              'controllerMap' => [
                  'admin' => 'frontend\controllers\AdminController'
              ],
*/ 		      'modelMap' => [
				        'User' => 'frontend\models\User',
				    ],
	          'enableUnconfirmedLogin' => true,
	          'confirmWithin' => 21600,  
	          'cost' => 12,
	          'admins' => ['test','sifu'],
/*	          'components' => [
	                'manager' => [
                    // Active record classes
                    'userClass'    => 'dektrium\user\models\User',
                    'tokenClass'   => 'dektrium\user\models\Token',
                    'profileClass' => 'dektrium\user\models\Profile',
                    'accountClass' => 'dektrium\user\models\Account',
                    // Model that is used on user search on admin pages
                    'userSearchClass' => 'dektrium\user\models\UserSearch',
                    // Model that is used on registration
                    'registrationFormClass' => 'dektrium\user\models\RegistrationForm',
                    // Model that is used on resending confirmation messages
                    'resendFormClass' => 'dektrium\user\models\ResendForm',
                    // Model that is used on logging in
                    'loginFormClass' => 'dektrium\user\models\LoginForm',
                    // Model that is used on password recovery
                    'passwordRecoveryFormClass' => 'dektrium\user\models\RecoveryForm',
                    // Model that is used on requesting password recovery
                    'passwordRecoveryRequestFormClass' => 'dektrium\user\models\RecoveryRequestForm',
//	                    // Active record classes
//	                    'userClass'    => 'frontend\models\User',
//	                    'Class'    => 'frontend\models\User',
	                ],
	          ]
*/	      ], // -- user
	      'formatter' => [
				    'class' => 'yii\i18n\Formatter',
				    'dateFormat' => 'php:Y-m-d',
				    'datetimeFormat' => 'php:Y-m-d H:i:s',
				    'timeFormat' => 'php:H:i:s',
				    'timeZone' => 'Europe/Berlin',
        		'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
				],
		],  // -- modules
		'aliases' => [
//        '@rgraph' => '@vendor/robregonm/rgraph',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
];

if (YII_ENV_DEV) {
		//configuration adjustments for the development environment
    $config['modules']['debug'] = [
						'class' => 'yii\debug\Module',
						'allowedIPs' => ['127.0.0.1','172.16.55.24' ]
		];
		$config['modules']['utility'] = [
						'class' => '\c006\utility\migration/Module',
		];
}

return $config;