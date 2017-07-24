<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gaocnoincde0eiq389e89qn3f9euen7e89@3242431@MNJKON(J899998^&^&76YUIBiB',
        ],
        'formatter'=>[
            'dateFormat' => 'dd-MMM-yyyy',
            'decimalSeparator'=>',',
            'thousandSeparator'=>'.',
            'currencyCode'=>"IDR"
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\ResUsers',
            'enableAutoLogin' => false,
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
        'numericLib'=>[
            'class'=>'app\components\NumericLib',
        ],
        'openERPLib'=>[
            'class'=>'app\components\OpenERPLib',
            'server'=>"http://192.168.9.26:10001/xmlrpc/",
            'database'=>'LIVE_2014'
        ],
    ],
    'modules'=>[
        'gridview'=>[
            'class'=>'\kartik\grid\Module',
        ]
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug']['class'] = 'yii\debug\Module';
    $config['modules']['debug']['allowedIPs'] = ['127.0.0.1','::1','10.36.15.65'];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
