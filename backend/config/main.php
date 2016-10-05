<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
     'aliases' => [
        '@frontendimagepath' => '/home/ad045fcf/public_html/digin.in/advanced/frontend/web',
       '@frontendimageurl' => 'https://www.digin.in/',
         
    ],
   
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

       /* 'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ], */

 'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            
            'useFileTransport' => false, //NOTE: if true, the swiftmailer extension will not be used
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'plugins' => [
                    [
                        'class' => 'Swift_Plugins_LoggerPlugin',
                        'constructArgs' => [new Swift_Plugins_Loggers_ArrayLogger], //thanks @germansokolov13
                        // it could also be any Swift_Plugins_Logger implementation (e.g., the EchoLogger)
                    ],
                ],
            ],
        ],
        

        'session' => [
            'name' => 'BACKENDID',   //Set name
            'savePath' => __DIR__ . '/../temp', //create temp folder and set path
        ],
    ],
    'params' => $params,
   /* 'modules' => [
        'user' => [
            // following line will restrict access to admin page
            'as backend' => 'dektrium\user\filters\BackendFilter',            
        ],
    ],*/
];
