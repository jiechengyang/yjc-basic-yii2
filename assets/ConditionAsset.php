<?php
/**
 * @link http://www.jiechengyang.com/
 * @copyright Copyright (c) 2017 jie
 * @description 该资源包专门用于那些需要判断IE兼容性的CSS文件和JS文件---目前适用于IE9
 */
 namespace app\assets;
 use yii\web\AssetBundle;
 class ConditionAsset extends AssetBundle
 {
    public $basePath = '@webroot';
    public $baseUrl = '@web';  
    public $js = [
        'bjui/B-JUI/other/html5shiv.min.js',
        'bjui/B-JUI/other/respond.min.js',
        'bjui/B-JUI/other/jquery.iframe-transport.js',
        'bjui/B-JUI/other/jquery.iframe-transport.js',
    ];
    //public $cssOptions = ['condition' => 'lte IE9'];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD,'condition' => 'lte IE9'];
 }
?>