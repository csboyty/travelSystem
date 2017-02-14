<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'travelsystemvalidationkey',
            'enableCsrfValidation' => false //后期还是建议开启http://www.yiichina.com/tutorial/449
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>array(
                /*'<namespace:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<namespace>/<controller>/<action>',
                'search/<param:.+>'=>'search/index',
                '<controller:\w+>/<paramId:\d+>/<id:\d+>'=>'<controller>/index',
                '<controller:[-a-zA-Z]+>/<paramId:\d+>'=>'<controller>/index',
                '<controller:[-a-zA-Z]+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>'*/
            ),
        ]
    ],
];
