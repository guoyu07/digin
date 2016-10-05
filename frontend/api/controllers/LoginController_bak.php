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
    
}
