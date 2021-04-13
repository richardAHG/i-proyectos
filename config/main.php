<?php

$config = [
    'id' => 'iwasi-proyectos',
    'basePath' => dirname(__DIR__),
    'modules' => require __DIR__ . '/modules.php',
    'aliases' => [
        '@bower' => '@vendor/bower-asset'
    ],
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8'
        ],
        'request' => [
            'cookieValidationKey' => 'iwasi-proyectos',
            'parsers' => [
                'application/jon' => 'yii\web\JsonParser'
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => require __DIR__ . '/routes.php'
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1']
    ];
}

return $config;
