<?php
use \kartik\datecontrol\Module;
use yii\filters\AccessControl;
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
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','debug'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
/*            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
*/         ],
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
                    'levels' => ['error', 'warning', 'trace'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
		        'viewPath' => '@backend/mail',
		        'useFileTransport' => false,//set this property to false to send mails to real email addresses
		        //comment the following array to send mail using php's mail function
		        'transport' => [
		            'class' => 'Swift_SmtpTransport',
		            'host' => 'smtp.1und1.de',
		            'username' => 'info@wingtzun.de',
		            'password' => 'veronica',
		            'port' => '587',
		            'encryption' => 'ssl',
		        ],
    		], 
    ],
    'params' => $params,
    'modules' => [
    		'debug' => [
						'class' => 'yii\debug\Module',
						'allowedIPs' => ['127.0.0.1','172.16.55.24' ]
				],
				'backup'=> [
						'class'=>'\spanjeta\modules\backup\Module',
						// other module settings
				],
				'dynagrid'=> [
						'class'=>'\kartik\dynagrid\Module',
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
//				    'modelMap' => [
//				        'User' => 'frontend\models\User',
//				    ],
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
				'aliases' => [
		        '@rgraph' => '@vendor/robregonm/rgraph',
		    ],
		]  // -- modules
    ,'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' =>  [
            [
               'actions' => ['login', 'error'],
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
    ]
    
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