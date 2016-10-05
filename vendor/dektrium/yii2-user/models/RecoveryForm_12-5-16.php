<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dektrium\user\models;

use dektrium\user\Finder;
use dektrium\user\Mailer;
use yii\base\Model;

/**
 * Model for collecting data on password recovery.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RecoveryForm extends Model
{
    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var User */
    protected $user;

    /** @var \dektrium\user\Module */
    protected $module;

    /** @var Mailer */
    protected $mailer;

    /** @var Finder */
    protected $finder;

    /**new @var string */
    public $phone;
    
    /**
     * @param Mailer $mailer
     * @param Finder $finder
     * @param array  $config
     */
    public function __construct(Mailer $mailer, Finder $finder, $config = [])
    {
        $this->module = \Yii::$app->getModule('user');
        $this->mailer = $mailer;
        $this->finder = $finder;
        parent::__construct($config);
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'email'    => \Yii::t('user', 'Email'),
            'password' => \Yii::t('user', 'Password'),
        ];
    }

    /** @inheritdoc */
    public function scenarios()
    {
        return [
            'request' => ['email', 'phone'],    //new
            'reset'   => ['password']
        ];
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            'emailTrim' => ['email', 'filter', 'filter' => 'trim'],
            //'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'emailExist' => ['email', 'exist',
                'targetClass' => $this->module->modelMap['User'],
                'message' => \Yii::t('user', 'There is no user with this email address')
            ],
            'emailUnconfirmed' => ['email', function ($attribute) {
                $this->user = $this->finder->findUserByEmail($this->email);
                if ($this->user !== null && $this->module->enableConfirmation && !$this->user->getIsConfirmed()) {
                    $this->addError($attribute, \Yii::t('user', 'You need to confirm your email address'));
                }
            }],
            'passwordRequired' => ['password', 'required'],
            'passwordLength' => ['password', 'string', 'min' => 6],
                    
            [['phone'], 'string'],
        ];
    }

    /**
     * Sends recovery message.
     *
     * @return bool
     */
    public function sendRecoveryMessage($field)
    {        
        if($field=='email') {  
            if ($this->validate()) {
                /** @var Token $token */
                $token = \Yii::createObject([
                    'class'   => Token::className(),
                    'user_id' => $this->user->id,
                    'type'    => Token::TYPE_RECOVERY
                ]);
                $token->save(false);
                $this->mailer->sendRecoveryMessage($this->user, $token);
                /****************New Code**************************/
                $email=  $this->email;           
                $user=  \dektrium\user\models\User::find()->where(['email'=>$email])->one();  
                $pass=  \dektrium\user\helpers\Password::generate(8);            
                $user->setScenario('update');     //Scenario is set beacause already it is default, change it to 'update'                   
                $user->password=$pass;            
                $user->save();
                //$message='<p>Your password is changed. <b>'.$pass.'</b> This is your new password to login!</p>';
                $message='<p>As per your request, your password is changed. Reset and your new password is <b>'.$pass.'</b></p>';
               \Yii::$app->mailer->compose()
                         ->setFrom('mail@digin.in')
                         ->setTo($email)
                         ->setSubject('Password Recovery')
                         //->setTextBody($message)
                         ->setHtmlBody($message)
                         ->send();
               /*****************************************************/
                \Yii::$app->session->setFlash('info', \Yii::t('user', 'An email has been sent with instructions for resetting your password'));
                return true;
            }
        }
        else if($field=='phone'){                        
            $this->user=User::findOne(['phone'=>$this->phone]);            
            $pass=  \dektrium\user\helpers\Password::generate(8);            
            $this->user->setScenario('update');     //Scenario is set beacause already it is default, change it to 'update'                   
            $this->user->password=$pass;            
            $this->user->save(); 
            $sms= new \backend\models\Smssetting();
            $url=$sms->getUrlWithPhone($pass, $this->phone);
            $sms->sendMessage($url); 
            
            $link=  \yii\helpers\Html::a('here',['/user/security/login']);     
            \Yii::$app->session->setFlash('info', \Yii::t('user', 'A message has been sent to your phone number '.$this->phone.' with your password. Please login '.$link));
            return true;
        }
        return false;
    }

    /**
     * Resets user's password.
     *
     * @param  Token $token
     * @return bool
     */
    public function resetPassword(Token $token)
    {
        if (!$this->validate() || $token->user === null) {
            return false;
        }

        if ($token->user->resetPassword($this->password)) {
            \Yii::$app->session->setFlash('success', \Yii::t('user', 'Your password has been changed successfully.'));
            $token->delete();
        } else {
            \Yii::$app->session->setFlash('danger', \Yii::t('user', 'An error occurred and your password has not been changed. Please try again later.'));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return 'recovery-form';
    }
}
