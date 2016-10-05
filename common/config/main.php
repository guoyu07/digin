<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
'modules' => [
    'user' => [
        'class' => 'dektrium\user\Module',
		'admins' => ['superadmin'],                
    ],
	 'rbac' => [
        'class' => 'dektrium\rbac\Module',
    ],
      'frontend-api' => [
           'class' => 'frontend\api\api',
       ],
],
    
    
	
];
