<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'css/site-bs4.css',
        'fonts/font-awesome5/css/all.min.css',
        'fonts/font-awesome4/css/font-awesome.min.css',
    ];
    public $js = [
        'js/bootstrap.bundle.min.js',
        'js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
