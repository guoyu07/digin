<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dektrium\user\controllers;

use dektrium\user\Finder;
use dektrium\user\models\LoginForm;
use dektrium\user\Module;
use Yii;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use dektrium\user\traits\AjaxValidationTrait;

/**
 * Controller that manages user authentication process.
 *
 * @property Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class SecurityController extends Controller
{
    use AjaxValidationTrait;
    
    /** @var Finder */
    protected $finder;

    /**
     * @param string $id
     * @param Module $module
     * @param Finder $finder
     * @param array  $config
     */
    public function __construct($id, $module, Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($id, $module, $config);
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['login', 'auth'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['login', 'auth', 'logout'], 'roles' => ['@']],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /** @inheritdoc */
    public function actions()
    {
        return [
            'auth' => [
                'class' => AuthAction::className(),
                // if user is not logged in, will try to log him in, otherwise
                // will try to connect social account to user.
                'successCallback' => \Yii::$app->user->isGuest
                    ? [$this, 'authenticate']
                    : [$this, 'connect'],
            ]
        ];
    }

    /**
     * Displays the login page.
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = \Yii::createObject(LoginForm::className());

        $this->performAjaxValidation($model);
          
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {                                 
            $user=   \dektrium\user\models\User::find()->where(['id'=>Yii::$app->user->identity->id])->one();            
            $auth=Yii::$app->authManager;
            $userRole=$auth->getRolesByUser($user['id']);
            //var_dump(array_keys($userRole)[0]);
            //var_dump($userRole);
            if(array_keys($userRole)[0]=='Vendor' )
            {
                $vendor= \backend\models\Vendor::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
                if($vendor['Is_active']==0)
                {
                    Yii::$app->getUser()->logout(); 
                    \Yii::$app->session->setFlash('error', 'Your account is inactive. To activate your account please contact site administrator!'); 
                    return $this->render('login', [
                        'model'  => $model,
                        'module' => $this->module,
                    ]);                    
                }
                else{
                     return $this->goBack(); 
                }
            }
            else
            {               
                //return $this->goBack();
                if(strpos(Yii::$app->request->baseUrl,'frontend') !== false && array_keys($userRole)[0]!='Subscriber'){
                    Yii::$app->getUser()->logout();
                    \Yii::$app->session->setFlash('error', 'You are not allowed to perform this action!'); 
                    //echo "Not subscriber..";
                }else{
                    return $this->goBack();                 
                } 
            }            
            //return $this->goBack();
        }
       //else{
        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
        //}
    }

    /**
     * Logs the user out and then redirects to the homepage.
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout();
        return $this->goHome();
    }

    /**
     * Tries to authenticate user via social network. If user has alredy used
     * this network's account, he will be logged in. Otherwise, it will try
     * to create new user account.
     *  
     * @param  ClientInterface $client
     */
    public function authenticate(ClientInterface $client)
    {
        $account = forward_static_call([
            $this->module->modelMap['Account'],
            'createFromClient'
        ], $client);
        
        if (null === ($user = $account->user)) {
            $this->action->successUrl = Url::to([
                '/user/registration/connect',
                'account_id' => $account->id
            ]);
        } else {
            Yii::$app->user->login($user, $this->module->rememberFor);
        }
    }

    /**
     * Tries to connect social account to user.
     * 
     * @param ClientInterface $client
     */
    public function connect(ClientInterface $client)
    {
        forward_static_call([
            $this->module->modelMap['Account'],
            'connectWithUser',
        ], $client);
        $this->action->successUrl = Url::to(['/user/settings/networks']);
    }
}
