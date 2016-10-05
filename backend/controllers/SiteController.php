<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','error','signeagreement','agreement','logout', 'errors', 'createbadge','emailbadge'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
            $frarray = array();
            $role='';
            $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
            foreach($userrole as $r)
            {
              $role=$r->name;
            }
            if($role=='Franchisee Manager') {
            $franchuser = \backend\models\FranchiseeUser::find()->where(['userid'=>\Yii::$app->user->identity->id])->one();
            $frid = \backend\models\FranchiseeUser::find()->where(['frid'=>$franchuser['frid']])->one();
            $sgnfrn = \backend\models\Franchisee::find()->where(['frid'=>$frid['frid']])->one();
            $frarray = ['frid'=>$sgnfrn['frid']];
            //var_dump($sgnfrn['Is_eagreement_sign']);
            //echo 'hi i am Is E agreement value..'.$sgnfrn;
             if($sgnfrn['Is_eagreement_sign']==0){
                 return $this->render('signed', array('frarray'=>$frarray));
             }else{
                 return $this->render('index');
             }
           }else{
                return $this->render('index');
           }
        }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
  public function actionSigneagreement()
    {
        return $this->render('signed');
    }
  
  public function actionAgreement()
  {
       
        $success = FALSE;
        if(isset($_POST['agree']) && isset($_POST['franchisee'])){
        $frsgnid=$_POST['agree'];
        $frid=$_POST['franchisee'];
        $franchid=\backend\models\FranchiseeUser::find()->where(['userid'=>$frid])->one(); 
        $fnd = \backend\models\Franchisee::find()->where(['frid'=>$franchid['frid']])->one();
        $fnd['Is_eagreement_sign']=$frsgnid;
        $fnd['signed_by']=\Yii::$app->user->identity->id;
         $success=$fnd->Save();
       }
       if($success){
          return $this->render('index');
        }else{
    
         return $this->render('signed');
        }
  }
    
      public function actionCreatebadge()
      {
          return $this->render('badge');
      }
      
    public function actionEmailbadge()
      {
            $emails = array();
            if((isset($_REQUEST['email']) && $_REQUEST['email']!="")
                &&  (isset($_REQUEST['badgecode']) && $_REQUEST['badgecode']!="")
                && (isset($_REQUEST['message']) && $_REQUEST['message']!="")){
                
            //var_dump($_REQUEST);
           
           $emailsarr = $_REQUEST['email'];
           $emails = explode(',' , $emailsarr);
           $badge = $_REQUEST['badgecode'];
           $msg = $_REQUEST['message'];
          
          // $emailhtm = "<p>Hello <b>".$name."</b>. Your mail has been sent Successfully. Thank you!<br> Meassage:<p>".$message."</p>"; 
        $emailhtm = "<p><b>Click on the image below to go to my store on Digin</b><br><br><br>".$badge."<br><br><br>".$msg."";  
           
           \Yii::$app->mailer->compose()                       
                   ->setFrom('mail@digin.in')
                   ->setTo($emails)
                   ->setBcc('sheetaljagdale250@gmail.com')
                   ->setSubject('Find us on digin.in')
                   //->setTextBody('hi...') 
                   ->setHtmlBody($emailhtm)                  
                   ->send();
             Yii::$app->session->setFlash('success', 'Your mail has been sent Successfully.');  
                return $this->render('badge');
                
                }  else {
                     return $this->render('badge');
                }
              
              		
        }

}
