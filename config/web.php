<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-CN',       //ȫ������Ϊ����--�Ƽ�
    'timeZone' => 'Asia/Shanghai',//����ʱ��
    //'defaultRoute' => 'manage/index',//Ĭ��·��
    //'catchAll' => ['site/maintenance'],Ӧ�ó�����ʱ����ά��ģʽ
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
            'appendTimestamp' => true,//�����Ѿ�������AssetManager ����������� appendTimestamp ���ԡ�
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
        // �����ͨ����������Ļ������� Gii������ᱻ���ڰ�ȫԭ��ܾ��� ��������� Gii Ϊ�����������ʵ� IP ��ַ.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
