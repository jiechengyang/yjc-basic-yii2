<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../vendor/autoload.php');//�����composer�����Զ����ػ���ע���ļ�����������ļ��󣬿���ʹ��composer�����Զ����ع��ܡ�
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');//����Yii�Ĺ������ļ��� ������������ļ��󣬲���ʹ��Yii���ṩ�ĸ��ֹ��ߣ� ���� Yii::createObject() Yii::$app ֮��Ķ�������ʹ��

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
