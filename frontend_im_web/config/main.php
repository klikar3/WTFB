<?php
use \kartik\datecontrol\Module;


$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
         ],
				'view' => [
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
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
    'modules' => [
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
          'admins' => ['test']
      ],
		]
];
