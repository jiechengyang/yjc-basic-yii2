<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-CN',       //全局设置为中文--推荐
    'timeZone' => 'Asia/Shanghai',//设置时区
    //'defaultRoute' => 'manage/index',//默认路由
    //'catchAll' => ['site/maintenance'],应用程序暂时开启维护模式
    'modules' => [
            'forum' => [
                    'class' => 'app\modules\forum\Module',
            ],
            'user' =>[
                    'class' => 'app\modules\user\UserModule',
            ],
            'manage' =>[
                    'class' => 'app\modules\manage\ManageModule',
            ]
    ],
    'components' => [
         'assetManager' => [
            'appendTimestamp' => true,//我们已经增加了AssetManager 组件，并设置 appendTimestamp 属性。
         ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'cgtB3zvzXHeLoQVvEQnX0K0PzHqprIU5',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        /*'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'timeFormat' => 'HH:mm:ss',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss'
        ], */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'about' => 'site/about',
                'articles/<year:\d{4}>/<category>' => 'article/index',
                'articles' => 'article/index',
                'article/<id:\d+>' => 'article/view',
            ],
            'enableStrictParsing' => false,
            //'suffix' => '.html'
        ],
       
    ],
    'params' => $params,
    'controllerMap' => [
        'account' => 'app\controllers\UserController',
        'article' => [
            'class' => 'app\controllers\PostController',
            'enableCsrfValidation' => false,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // 如果你通过本机以外的机器访问 Gii，请求会被出于安全原因拒绝。 你可以配置 Gii 为其添加允许访问的 IP 地址.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
