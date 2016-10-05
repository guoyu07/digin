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
                    ['allow' => true, 'actions' => ['register', 'connect']],  //, 'roles' => ['Admin']
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
        $mdlfranchiseeuser=new \backend\models\FranchiseeUser();
        
        $this->performAjaxValidation($model);
        $result='';
        $usersuccess=false;
        $userdetsuccess=false;
        $connection = \Yii::$app->db;
        $sms=new \backend\models\Smssetting();       
        
       // if ($model->load(\Yii::$app->request->post())  && $model->register()) {           
        /**********************new**********************/
        if ($model->load(\Yii::$app->request->post())) {
            if(!\Yii::$app->user->isGuest) {
                $model->role=$_POST['register-form']['role']; 
            }
            else{
                $model->role='Subscriber';
            }
            $phn = $_POST['register-form']['phone'];
            $unm = $_POST['register-form']['username'];
            $pass = $_POST['register-form']['password'];

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
            
            if(isset($_POST['FranchiseeUser']['frid']) && $_POST['FranchiseeUser']['frid']!="")
            {
                $mdlfranchiseeuser->frid=$_POST['FranchiseeUser']['frid'];
                $mdlfranchiseeuser->userid=$success1[1];
          
                $mdlfranchiseeuser->crtby=\Yii::$app->user->identity->id;
                $mdlfranchiseeuser->updby=\Yii::$app->user->identity->id;
            }
            
            if($usersuccess)
            {                  
                if($model->role=='Subscriber')
                {
                     $mdluserdetail->role=$model->role;
                     $mdluserdetail->crtdt=date('Y-m-d H:i:s');
                     $mdluserdetail->upddt=date('Y-m-d H:i:s');
                     $mdluserdetail->crtby=1;
                     $mdluserdetail->updby=1;
                     $userdetsuccess=$mdluserdetail->save(false);
                }
                else{
                    if($mdlfranchiseeuser->validate())
                    {
                        $mdlfranchiseeuser->save();
                    }
                    $userdetsuccess=$mdluserdetail->save();
                }
            }
            //$usersuccess && $userdetsuccess        ..old condition in if
            if($usersuccess)
            {
                $transaction->commit();
                $url=$sms->getUrlWithPwd($pass, $unm, $phn);
                $sms->sendMessage($url); 
                   
                //mail sending code
                $email=$_POST['register-form']['email'];
                $message='<p>New mail from Digin <br> <b>Subject:&nbsp;</b>Registration Details<br><b>From:&nbsp;</b>mail@digin.in     <br><b>Message:&nbsp;</b>'.$email.' Your account has been registered successfully</p><br><p>Your login credentials are as follows:<br><b>Username:&nbsp;</b>'.$unm.'<br><b>Password:&nbsp;</b>'.$pass.'</p>';         
                \Yii::$app->mailer->compose()
                   ->setFrom('mail@digin.in')
                   //->setBcc('sameer@aayati.co.in')     
                   ->setTo($email)
                   ->setSubject('Account Registration Details')
                   ->setHtmlBody($message)
                   ->send();

  /*\Yii::$app->session->setFlash('info', \Yii::t('user', 'A message has been sent to your email address..'));
                return $this->redirect('/testing/backend/web/index.php?r=site/index');*/
              
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
                    'mdlfranchiseeuser' => $mdlfranchiseeuser,
                ]); 
            }                             
        }
        else {
                return $this->render('register', [
                    'model'  => $model,
                    'module' => $this->module,
                    'mdluserdetail' => $mdluserdetail,
                    'mdlfranchiseeuser' => $mdlfranchiseeuser,
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
}