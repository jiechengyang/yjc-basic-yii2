<?php
   namespace app\assets;
   use yii\web\AssetBundle;
   use yii\web\view;
   class DemoAsset extends AssetBundle {
      public $basePath = '@webroot';
      public $baseUrl = '@web';
      public $js = ['js/demo.js'];
      public  $jsOptions = ['position' => view::POS_HEAD];
   }