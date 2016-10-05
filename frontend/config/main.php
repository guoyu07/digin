<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php'),
    ['kmrad'=>100000000],['tax'=>15],['phn'=>8408883838]
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
     'aliases' => [
        '@backendurl' => 'http://backend.digin.in/',
        '@frontendimagepath' => '/home/ad045fcf/public_html/digin.in/advanced/frontend/web',
        '@frontendimageurl' => 'https://www.digin.in/',
      ],

    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
       /* 'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ], */
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
            'errorAction' => 'site/errors',
        ],
              
         
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
        
       'request' => [
            'baseUrl' => 'https://www.digin.in',
        ],
       
         'session' => [
            'name' => 'FRONTENDID',   //Set name
            'savePath' => __DIR__ . '/../temp', //create temp folder and set path
        ],
        /*'modules' => [
            'user' => [
                'class' => 'dektrium\user\Module',
                // following line will restrict access to admin page
                'as frontend' => 'dektrium\user\filters\FrontendFilter',
            ],
        ], */
    ],
    'params' => $params,
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            // following line will restrict access to admin page
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
      
    ],
];
