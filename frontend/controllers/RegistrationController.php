<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace frontend\controllers;

use dektrium\user\Finder;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\ResendForm;
use dektrium\user\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use dektrium\user\traits\AjaxValidationTrait;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationController extends Controller
{
    public $enableCsrfValidation = false;
    use AjaxValidationTrait;
    
    /** @var Finder */
    protected $finder;

    /**
     * @param string           $id
     * @param \yii\base\Module $module
     * @param Finder           $finder
     * @param array            $config
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
                    ['allow' => true, 'actions' => ['register', 'connect','registeruser','testregister']],  //, 'roles' => ['Admin']
                    ['allow' => true, 'actions' => ['confirm', 'resend'], 'roles' => ['?', '@']],
                ]
            ],
        ];
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise redirects to home page.
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegister()
    {        
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException;
        } 

        $model = \Yii::createObject(RegistrationForm::className());
        $mdluserdetail=new \backend\models\UserDetail();
        
        $this->performAjaxValidation($model);
        $result='';
        $usersuccess=false;
        $userdetsuccess=false;
        $success=false;
        $connection = \Yii::$app->db;
        
        
       // if ($model->load(\Yii::$app->request->post())  && $model->register()) {           
        /**********************new**********************/
        if ($model->load(\Yii::$app->request->post())) {
            if(!\Yii::$app->user->isGuest) {
                $model->role=$_POST['register-form']['role']; 
            }
            else{
                $model->role='Subscriber';
            }
            $model->phone=$_POST['register-form']['phone']; 
            
            $mdluserdetail->firstname=$_POST['UserDetail']['firstname'];
            $mdluserdetail->lastname=$_POST['UserDetail']['lastname'];
            if(!\Yii::$app->user->isGuest) {
            $mdluserdetail->address1=$_POST['UserDetail']['address1'];
            $mdluserdetail->address2=$_POST['UserDetail']['address2'];
            $mdluserdetail->city=$_POST['UserDetail']['city'];
            $mdluserdetail->state=$_POST['UserDetail']['state'];
            $mdluserdetail->country=$_POST['UserDetail']['country'];
            $mdluserdetail->role=$model->role;
            }
            //var_dump($mdluserdetail->attributes);
            //echo "<br>";
            //var_dump($model->attributes); 
            $transaction = $connection->beginTransaction();
            $result=$model->register();
            if(strlen($result)>1)
            {
                $success1=  explode('-', $result);            
                $mdluserdetail->user_id=$success1[1];
                $usersuccess=$success1[0];
            }
            
            if($usersuccess)
            {                  
                if($model->role=='Subscriber')
                {
                     $mdluserdetail->crtdt=date('Y-m-d H:i:s');
                     $mdluserdetail->upddt=date('Y-m-d H:i:s');
                     $mdluserdetail->crtby=1;
                     $mdluserdetail->updby=1;
                     $userdetsuccess=$mdluserdetail->save(false);
                }
                else{ 
                    $userdetsuccess=$mdluserdetail->save();
                }
            }
            if($usersuccess && $userdetsuccess)
            {
                $transaction->commit();                
                return $this->render('/message', [
                    'title'  => \Yii::t('user', 'Your account has been created'),
                    'module' => $this->module,
                ]); 
            }
            else {
                 $transaction->rollBack();                 
                 return $this->render('register', [
                    'model'  => $model,
                    'module' => $this->module,
                    'mdluserdetail' => $mdluserdetail,
                ]); 
            }  
                          
        }
        else {
                return $this->render('register', [
                    'model'  => $model,
                    'module' => $this->module,
                    'mdluserdetail' => $mdluserdetail,
                ]); 
        } 
    }

    /**
     * Displays page where user can create new account that will be connected to social account.
     * @param  integer $account_id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionConnect($account_id)
    {
        $account = $this->finder->findAccountById($account_id);

        if ($account === null || $account->getIsConnected()) {
            throw new NotFoundHttpException;
        }

        /** @var User $user */
        $user = \Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'connect',
        ]);
        
        if ($user->load(\Yii::$app->request->post()) && $user->create()) {
            $account->link('user', $user);
            \Yii::$app->user->login($user, $this->module->rememberFor);
            return $this->goBack();
        }

        return $this->render('connect', [
            'model'   => $user,
            'account' => $account
        ]);
    }

    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     * @param  integer $id
     * @param  string  $code
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionConfirm($id, $code)
    {
        $user = $this->finder->findUserById($id);

        if ($user === null || $this->module->enableConfirmation == false) {
            throw new NotFoundHttpException;
        }

        $user->attemptConfirmation($code);

        return $this->render('/message', [
            'title'  => \Yii::t('user', 'Account confirmation'),
            'module' => $this->module,
        ]);
    }

    /**
     * Displays page where user can request new confirmation token. If resending was successful, displays message.
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionResend()
    {
        if ($this->module->enableConfirmation == false) {
            throw new NotFoundHttpException;
        }

        $model = \Yii::createObject(ResendForm::className());

        $this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->request->post()) && $model->resend()) {
            return $this->render('/message', [
                'title'  => \Yii::t('user', 'A new confirmation link has been sent'),
                'module' => $this->module,
            ]);
        }

        return $this->render('resend', [
            'model' => $model
        ]);
    }
    
    public function actionRegisteruser()
    {                   
        //var_dump($_REQUEST);             
        $model = \Yii::createObject(RegistrationForm::className());        
        
        $this->performAjaxValidation($model);
        $result='';        
        $usersuccess=false;
        $result_stat=array();
        $connection = \Yii::$app->db;   
        $sms=new \backend\models\Smssetting();     
     
            $model->role='Subscriber'; 
          /*  if(isset($_REQUEST['phone']) && $_REQUEST['phone']!='' &&
               isset($_REQUEST['email']) && $_REQUEST['email']!='' &&
               isset($_REQUEST['username']) && $_REQUEST['username']!='' &&
               isset($_REQUEST['password']) && $_REQUEST['password'] !='') */
           if($model->load(\Yii::$app->request->post())){
            $model->phone=$_POST['register-form']['phone']; 
            $model->email=$_POST['register-form']['email'];
            $model->username=$_POST['register-form']['username'];
            $model->password=$_POST['register-form']['password'];
            //var_dump($_POST);    
            //var_dump($model->attributes); 

            $phn = $model->phone;
            $unm = $model->username;
            $pass =$model->password;

            $transaction = $connection->beginTransaction();
            $result=$model->register();
            
            if(strlen($result)>1)
            {
                $success1=  explode('-', $result);                     
                $usersuccess=$success1[0];
            }            
             
            if($usersuccess)
            {
                $transaction->commit();  
                //To send a SMS to registered user
                $url=$sms->getUrlWithPwd($pass, $unm, $phn);
                $sms->sendMessage($url); 
  
                //$result_stat=["status"=>$usersuccess, "userid"=>$success1[1], "username"=>$model->username, "email"=>$model->email, "phone"=>$model->phone, "error"=>''];   
                //\Yii::$app->session->setFlash('success', 'Your account has been created.');  
                return $this->redirect('index.php?r=site/index');
            }
            else {
                 $transaction->rollBack();
                 //$result_stat=["status"=>$usersuccess, "userid"=>"", "username"=>"", "email"=>"", "phone"=>"", "error"=>'Either user already present or one of the parameter format is wrong.']; 
                 return $this->render('register', [
                    'model'  => $model,                    
                ]);
            }            
            }            
            else
            {
                //echo 'in else';
                 //$result_stat=["status"=>0, "userid"=>"", "username"=>"", "email"=>"", "phone"=>"", "error"=>'One or more parameter missing.'];
                 return $this->render('register', [
                    'model'  => $model,                    
                ]);
            } 
             //echo json_encode($result_stat);  
        }
        
        public function actionTestregister()
        {            
            return $this->render('register');
        }
    
}
