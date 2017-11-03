<?php
/**
 * @link http://www.jiechengyang.com/
 * @copyright Copyright (c) 2017 jie
 * @license http://www.yiiframework.com/license/
 */
 namespace app\assets;
 
 use yii\web\AssetBundle;
 
 class AdminAsset extends AssetBundle
 {
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath = '@bower/bjui';
    public $css = [
        'themes/css/bootstrap.css',
        'themes/css/style.css',
        'themes/blue/core.css',
        'themes/css/fontsize.css',
        'plugins/kindeditor_4.1.11/themes/default/default.css',
        'plugins/colorpicker/css/bootstrap-colorpicker.min.css',
        'plugins/nice-validator-1.0.7/jquery.validator.css',
        'plugins/bootstrapSelect/bootstrap-select.css',
        'plugins/webuploader/webuploader.css',
        'themes/css/FA/css/font-awesome.min.css',
        'plugins/uploadify/css/uploadify.css',
        'assets/prettify.css',
        'assets/ZeroClipboard.css',
    ];
    public $js = [
        'js/jquery-1.11.3.min.js',
        'js/jquery.cookie.js',
        'js/bjui-all.min.js',
        'plugins/swfupload/swfupload.js',
        'plugins/webuploader/webuploader.js',
        'plugins/kindeditor_4.1.11/kindeditor-all-min.js',
        'plugins/kindeditor_4.1.11/lang/zh-CN.js',
        'plugins/colorpicker/js/bootstrap-colorpicker.min.js',
        'plugins/ztree/jquery.ztree.all-3.5.js',
        'plugins/nice-validator-1.0.7/jquery.validator.js',
        'plugins/nice-validator-1.0.7/jquery.validator.themes.js',
        'plugins/bootstrap.min.js',
        'plugins/bootstrapSelect/bootstrap-select.min.js',
        'plugins/bootstrapSelect/defaults-zh_CN.min.js',
        'plugins/icheck/icheck.min.js',
        'plugins/highcharts/highcharts.js',
        'plugins/highcharts/highcharts-3d.js',
        'plugins/highcharts/themes/gray.js',
        'plugins/other/jquery.autosize.js',
        'plugins/uploadify/scripts/jquery.uploadify.min.js',
        'plugins/download/jquery.fileDownload.js',
        'assets/prettify.js',
        'assets/ZeroClipboard.js',
        'ie10-viewport-bug-workaround.js'
    ];    
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    //public $cssOptions = ['condition' => 'lte IE8'];
     //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {  
        //, 'depends' => 'backend\assets\AppAsset'
        $view->registerJsFile($jsfile, [AdminAsset::className()]);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile,$other = '') { 
        //, 'depends' => 'backend\assets\AppAsset'
        $defalut = [AdminAsset::className()];
        if(!empty($other))array_push($defalut,$other);
        $view->registerCssFile($cssfile, $defalut);  
    } 
 }
