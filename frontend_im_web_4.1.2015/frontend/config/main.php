<?php
use \kartik\datecontrol\Module;
//use \dektrium\user\Module;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','debug'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
/*        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
         ],
*/				'view' => [
						'theme' => [
								'pathMap' => [
										'@app/views' => '@app/themes/basic',
										'@app/modules' => '@app/themes/basic/modules', // <-- !!!
										'@app/widgets' => '@app/themes/basic/widgets',
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
                    'levels' => ['error', 'warning', 'trace', 'info'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
    'modules' => [
    		'debug' => [
						'class' => 'yii\debug\Module',
						'allowedIPs' => ['127.0.0.1','172.16.55.24' ]
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

		         // automatically use kartik\widgets for each of the above formats
						'autoWidget' => true,
						 
						// default settings for each widget from kartik\widgets used when autoWidget is true
						'autoWidgetSettings' => [
								Module::FORMAT_DATE => ['type'=>2, 
									'pluginOptions'=>['autoClose'=>true,  
											'todayHighlight' => true,
											'todayBtn' => true,
											'format' => 'dd.mm.yyyy',
											'language' => 'de'
									]
								], // example
								Module::FORMAT_DATETIME => [
										'pluginOptions'=>[
												'autoClose'=>true,  
												'todayHighlight' => true,
												'todayBtn' => true
										]
								], // setup if needed
								Module::FORMAT_TIME => [], // setup if needed
						],


		    ],		    
	      'user' => [
	          'class' => 'dektrium\user\Module',
	          'enableUnconfirmedLogin' => true,
	          'confirmWithin' => 21600,
	          'cost' => 12,
	          'admins' => ['test'],
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
				    'dateFormat' => 'php:d-M-Y',
				    'datetimeFormat' => 'php:d-M-Y H:i:s',
				    'timeFormat' => 'php:H:i:s',
				]
		]  // -- modules
];
