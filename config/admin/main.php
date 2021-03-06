<?php

use common\models\Admin;
use kriss\iframeLayout\component\IframeMode;

$modules = require __DIR__ . '/modules.php';
$definitions = require __DIR__ . '/definitions.php';
$moduleName = 'admin';
$cookieKey = getenv('COOKIE_KEY');

$config = [
    'id' => "app-{$moduleName}",
    'basePath' => "@{$moduleName}",
    'runtimePath' => "@runtimePath/{$moduleName}",
    'controllerNamespace' => "{$moduleName}\controllers",
    'bootstrap' => ['log'],
    // 网站维护，打开以下注释
    //'catchAll' => ['site/offline'],
    'modules' => $modules,
    'container' => [
        'definitions' => $definitions,
    ],
    'components' => [
        'request' => [
            'csrfParam' => "_csrf-{$moduleName}",
            'cookieValidationKey' => "{$moduleName}-{$cookieKey}",
        ],
        'user' => [
            'class' => \kriss\modules\auth\components\User::class,
            'authClass' => \common\models\base\Auth::class,
            'identityClass' => Admin::class,
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => "_identity-{$moduleName}", 'httpOnly' => true],
        ],
        'session' => [
            'class' => \yii\redis\Session::class,
            'redis' => 'sessionRedis',
            'name' => "_session-{$moduleName}",
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        IframeMode::COMPONENT_NAME => [
            'class' => IframeMode::class,
            'enable' => true,
            'defaultSwitch' => false,
        ],
    ],
];

if (YII_ENV === 'dev') {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*', '172.*', '10.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*', '172.*', '10.*'],
        'generators' => [
            'Kriss Auth' => [
                'class' => \kriss\modules\auth\generators\Generator::class,
            ],
            'kriss Dynagrid' => [
                'class' => \kriss\generators\dynagrid\Generator::class,
            ],
            'kriss Crud' => [
                'class' => \kriss\generators\crud\Generator::class,
            ],
        ],
    ];
}

return $config;
