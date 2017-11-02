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
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bjui/B-JUI/themes/css/bootstrap.css',
        'bjui/B-JUI/themes/css/style.css',
        'bjui/B-JUI/themes/blue/core.css',
        'bjui/B-JUI/themes/css/fontsize.css',
        'bjui/B-JUI/plugins/kindeditor_4.1.11/themes/default/default.css',
        'bjui/B-JUI/plugins/colorpicker/css/bootstrap-colorpicker.min.css',
        'bjui/B-JUI/plugins/nice-validator-1.0.7/jquery.validator.css',
        'bjui/B-JUI/plugins/bootstrapSelect/bootstrap-select.css',
        'bjui/B-JUI/plugins/webuploader/webuploader.css',
        'bjui/B-JUI/themes/css/FA/css/font-awesome.min.css',
        'bjui/B-JUI/plugins/uploadify/css/uploadify.css',
        'bjui/assets/prettify.css',
        'bjui/assets/ZeroClipboard.css',
    ];
    public $js = [
        'bjui/B-JUI/js/jquery-1.11.3.min.js',
        'bjui/B-JUI/js/jquery.cookie.js',
        'bjui/B-JUI/js/bjui-all.min.js',
        'bjui/B-JUI/plugins/swfupload/swfupload.js',
        'bjui/B-JUI/plugins/webuploader/webuploader.js',
        'bjui/B-JUI/plugins/kindeditor_4.1.11/kindeditor-all-min.js',
        'bjui/B-JUI/plugins/kindeditor_4.1.11/lang/zh-CN.js',
        'bjui/B-JUI/plugins/colorpicker/js/bootstrap-colorpicker.min.js',
        'bjui/B-JUI/plugins/ztree/jquery.ztree.all-3.5.js',
        'bjui/B-JUI/plugins/nice-validator-1.0.7/jquery.validator.js',
        'bjui/B-JUI/plugins/nice-validator-1.0.7/jquery.validator.themes.js',
        'bjui/B-JUI/plugins/bootstrap.min.js',
        'bjui/B-JUI/plugins/bootstrapSelect/bootstrap-select.min.js',
        'bjui/B-JUI/plugins/bootstrapSelect/defaults-zh_CN.min.js',
        'bjui/B-JUI/plugins/icheck/icheck.min.js',
        'bjui/B-JUI/plugins/highcharts/highcharts.js',
        'bjui/B-JUI/plugins/highcharts/highcharts-3d.js',
        'bjui/B-JUI/plugins/highcharts/themes/gray.js',
        'bjui/B-JUI/plugins/other/jquery.autosize.js',
        'bjui/B-JUI/plugins/uploadify/scripts/jquery.uploadify.min.js',
        'bjui/B-JUI/plugins/download/jquery.fileDownload.js',
        'bjui/assets/prettify.js',
        'bjui/assets/ZeroClipboard.js',
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
