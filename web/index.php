<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../vendor/autoload.php');//这个是composer的类自动加载机制注册文件。引入这个文件后，可以使用composer的类自动加载功能。
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');//这是Yii的工具类文件。 引入了这个类文件后，才能使用Yii的提供的各种工具， 才有 Yii::createObject() Yii::$app 之类的东东可以使用

$config = require(__DIR__ . '/../config/web.php');
/**
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);
*/
(new yii\web\Application($config))->run();
