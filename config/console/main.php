<?php

return [
    'id' => 'app-console',
    'basePath' => '@console',
    'runtimePath' => '@runtimePath/console',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@app/migrations',
                '@vendor/yii2mod/yii2-settings/migrations',
            ]
        ],
    ],
    'components' => [
    ],
];
