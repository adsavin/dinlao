<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'dindee',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
//    'language' =>'en-US',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'idkjhsiluywehtgkljashftqiluhwkiluhnjknliwudskjgah',
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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyDBuSAiSvY718_Aascagsk2ydjqVb3WsgM',
                        'language' => 'la',
                        'version' => '3.1.18'
                    ]
                ]
            ]
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '1869360129980672',
                    'clientSecret' => 'e22706c5e66e7a61716677ea309f288d',
                    'attributeNames' => ['name', 'email', 'first_name', 'last_name', 'birthday'],
                    'scope' => 'user_birthday'
                ],
//                'google' => [
//                    'class' => 'yii\authclient\clients\Google',
//                    'clientId' => '73926847849-o2issh3f15vo08mb8fvd183b055l0ujk.apps.googleusercontent.com',
//                    'clientSecret' => 'EsCB-vIETHbc1McPYpGmFJFe',
//                ],
            ],
        ],
        'i18n' => [
            'translations' => [
//                'app*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'sourceLanguage' => 'en-US',
//                    'basePath' => '@app/messages',
//                    'fileMap' => [
//                        'app' => 'app.php',
//                        'app/error' => 'error.php',
//                        'app/other' => 'other.php',
//                    ],
//                ],

                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en-US',
                    'forceTranslation' => true,
                    'enableCaching' => true,
                    'cachingDuration' => 864000, // 10 day
                    'on missingTranslation' => ['app\components\TranslationEventHandler', 'handleMissingTranslation']
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
