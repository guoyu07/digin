<?php

namespace frontend\controllers;

class LoginController extends \yii\web\Controller
{
   public $enableCsrfValidation = false;
   
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin1()
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
       else 
       {
            $result=["userid"=>'', "username"=>"", "email"=>"", "phone"=>"", "auth_key"=>'', "error"=>'Either username or password is missing.'];           
        }
       echo json_encode($result);     
    }
    
    public function actionLogin()
    {
       /* if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }*/
     //var_dump(\Yii::$app->session['userView_returnURL']);
        $model = \Yii::createObject(\dektrium\user\models\LoginForm::className());

        //$this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {  
            
           // return $this->goBack("http://localhost/advanced/frontend/web/index.php");
           
           if (strpos(\Yii::$app->session['userView_returnURL'], 'login') !== false){
              \Yii::$app->session->setFlash('info', 'You have logged in successfully.');   
              return $this->redirect('index.php'); 
            
            }else{
                \Yii::$app->session->setFlash('info', 'You have logged in successfully.');  
                  return $this->redirect( \Yii::$app->session['userView_returnURL']);
            }
        }
       \Yii::$app->session['userView_returnURL']=\Yii::$app->getRequest()->referrer;
       
        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
            
        ]);
        
    }
    
    
    public function actionLogout()
    {
        $session = \Yii::$app->session;
        $session->destroy();
        \Yii::$app->getUser()->logout();
        return $this->goHome();
        
    }
    
    
}
