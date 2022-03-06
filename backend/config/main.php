<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
	        'class' => 'dektrium\user\Module',
 		      'modelMap' => [
				        'User' => 'backend\models\User',
				    ],
	          'admins' => ['test','sifu'],
        ],
  		'gridview' => [
				'class' => '\kartik\grid\Module'
				// enter optional module parameters below - only if you need to
				// use your own export download action or custom translation
				// message source
				// 'downloadAction' => 'gridview/export/download',
				// 'i18n' => []
		],

    ],
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
        ],
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
        'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'params' => $params,
];
