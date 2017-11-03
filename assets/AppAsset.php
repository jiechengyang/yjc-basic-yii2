<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
        'static/css/site.css',
    ];
    public $js = [
        'static/js/common.js',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    //public $cssOptions = ['condition' => 'lte IE8'];
    /**
     *  <!--[if lte IE9]>
     *  <link rel="stylesheet" href="path/to/foo.css">
     *  <![endif]--> 
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    /*public $publishOptions = [
        'only' => [
            'fonts/',
            'css/',
        ]
    ];*/
}
