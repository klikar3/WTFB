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
class IbanAsset extends AssetBundle
{
    public $sourcePath = '@app/js'; 
    public $css = [
//        'css/site.css',
//        'css/site-bs4.css',
//        'fonts/font-awesome5/css/all.min.css',
//        'fonts/font-awesome4/css/font-awesome.min.css',
    ];
    public $js = [
        'iban.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
    ];
}
