<?php

namespace frontend\api\controllers;

class LoginController extends \yii\web\Controller
{
   public $enableCsrfValidation = false;   
   
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {    
        if(isset($_REQUEST['username']) && $_REQUEST['username']!='' &&
           isset($_REQUEST['password']) && $_REQUEST['password']!=''){
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];   
        $success=false;
         $user = new \dektrium\user\models\User();
         $model=\Yii::createObject(\dektrium\user\models\LoginForm::className());
         $model->login=$username;
         $model->password=$password;
        $success=$model->login();
        $user=  \dektrium\user\models\User::find()->where(['username'=>$username])->one();      
        $result=array();
        if($success)
        {
            $result=["userid"=>$user->id, "username"=>$user->username, "email"=>$user->email, "phone"=>$user->phone, "auth_key"=>$user->auth_key, "error"=>''];                          
        } 
        else
        {
            $result=["userid"=>'', "username"=>"", "email"=>"", "phone"=>"", "auth_key"=>'', "error"=>'Either username or password is wrong.'];
           
         }
       }
       else {
            $result=["userid"=>'', "username"=>"", "email"=>"", "phone"=>"", "auth_key"=>'', "error"=>'Either username or password is missing.'];
        }
       echo json_encode($result);   
      
    }
    
    public function actionRequest()
    {     
         if(isset($_REQUEST['email']) && $_REQUEST['email']!='' ||
           isset($_REQUEST['phone']) && $_REQUEST['phone']!=''){
            //$result==array();         
            $success=false;
            $recoveryfield=$this->checkRecoveryField($_GET);  
            //echo $recoveryfield;
            $success=$this->sendRecoveryMessage($recoveryfield);          
            if($success)
            {
                if($recoveryfield=="email"){
                    $result=["status"=>1,"Message"=>"An email has been sent with instructions for resetting your password", "error"=>""];
                }
                else if($recoveryfield=="phone")
                {
                    $result=["status"=>1,"Message"=>"A message has been sent to your phone number ".$_GET["phone"]." with your password.", "error"=>""];
                }
            }
            else{
                $result=["status"=>0, "Message"=>"", "error"=>"Either email or phone no. is wrong."];
            }
       }
      else{
            $result=["status"=>0, "Message"=>"", "error"=>"Either email or phone no. is missing."];  
       }
       echo json_encode($result);
    }
    public function checkRecoveryField($check)
    {       
        if(array_key_exists('email', $check))
        {
            return "email";
        }
        else if(array_key_exists('phone', $check))
        {
            return "phone";
        }        
    }
    
    public function sendRecoveryMessage($field)
    {          
        if($field=='email') {   
           $email=$_GET["email"];
           //$message = \Yii::$app->mailer->compose();
          $user=  \dektrium\user\models\User::find()->where(['email'=>$email])->one();  
          $pass=  \dektrium\user\helpers\Password::generate(8);            
          $user->setScenario('update');     //Scenario is set beacause already it is default, change it to 'update'                   
          $user->password=$pass;            
          $user->save();
          $message='<p>An email has been sent with instructions for resetting your password. '.$pass.' Here is your new password to login!</p>';
         \Yii::$app->mailer->compose()
                   ->setFrom('mail@digin.in')
                   ->setTo($email)
                   ->setSubject('Password Recovery')
                   //->setTextBody($message)
                   ->setHtmlBody($message)
                   ->send();
             
            return true;         
        }
        else if($field=='phone'){   
            $phone=$_GET["phone"];
            $sms=new \frontend\models\Smssetting();
            //$user=new \dektrium\user\models\User();
            $user=  \dektrium\user\models\User::find()->where(['phone'=>$phone])->one();  
            //var_dump($user);
            $pass=  \dektrium\user\helpers\Password::generate(8);            
            $user->setScenario('update');     //Scenario is set beacause already it is default, change it to 'update'                   
            $user->password=$pass;            
            $user->save(); 
            $url=$sms->getUrlWithPhone($pass, $phone);
            //echo rawurldecode($url);            
            $sms->sendMessage($url);            
            return true;
        }
        return false;
    }
}
