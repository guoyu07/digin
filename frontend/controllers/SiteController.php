<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use  yii\web\Session;
/**
 * Site controller
 */
class SiteController extends Controller
{   
    public $category=array();
    public $usedcategory=array();   

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * to add current details of address as like lat, lng, addr in session
     */
    public function actionDetails()
    {
        $lat=$_GET['lat'];
        $lng=$_GET['lng'];
        $addr=$_GET['address'];
        $country=$_GET['country'];    
        $session = Yii::$app->session;
        $session['lat']=$lat;
        $session['lng']=$lng;
        $session['addr']=$addr;
        $session['country']=$country; 
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result=$this->category_list();
        //var_dump($category);
        return $this->render('index', array('menuhtml'=>$result));
    }
   public function actionTest()
    {

     // Yii::setAlias('@backendurl', 'http://backend.digin.in/'); 
      $imagesrc=Yii::getAlias("@backendurl")."/images/productimages/10002/darkbrownhenna.png";
      echo "<img class='img-responsive moboSingle' alt='' src=$imagesrc>";
    }

    
  public function actionViewallproductsearch()
    {
        if(isset($_REQUEST['search']) && $_REQUEST['search']!=""){
        $keyword=$_REQUEST['search'];
       
        $key="%".$keyword."%";  
         $query3 = (new \yii\db\Query())                           
                ->select(['c.id','c.name','c.parentid','c.path','c1.id','c1.name','c1.parentid'])
                ->from('category c')
                ->join('join','category c1','c1.parentid=c.id')
                ->where('c.name LIKE :query')
                ->addParams([':query'=>$key])
                ->all(); 
        return $this->render('viewallproducts', array('search'=>$query3));  
        }else{
          
          return $this->redirect('index');  
        }
         
    }

  public function actionViewallproducts()
    {
        $result=$this->category_list();
       // var_dump($result);
         return $this->render('viewallproducts', array('menuhtml'=>$result));
    }

    public function category_list()
    {
        //$sql="SELECT c1.parentid, (select name from category where id=c1.parentid) as parentname, group_CONCAT(c1.id, ' : ', c1.name) as catid from category AS c1 INNER JOIN category AS c2 ON c1.id = c2.id group by c1.parentid";
        //$category=  \backend\models\Category::findBySql($sql)->all();
        $rows = (new \yii\db\Query())
               ->select(['c1.parentid', "GROUP_CONCAT(c1.id, ':', c1.name) as catid"])
               ->from('category c1')
               ->join('inner join','category c2','c1.id=c2.id')
               ->where(['not in','c1.parentid','0'])
               ->andWhere(['!=','c1.parentid',1])
               ->groupBy('c1.parentid')
               ->all();  
        //echo sizeof($rows);
        $result=array();
        $output=array();
        $catassoc=array();
        $category=array();
        $categorydone=array();
        foreach ($rows as $r)
        {                     
              //$result['parentid']=$r['parentid'];                
              if($r['parentid']!=1)
              {                  
                  $pnm=  \backend\models\Category::find()->select('name')->where(['id'=>$r['parentid']])->one();                                    
                  $result['parent']=$r['parentid'].":".$pnm['name'];
              }
              else{                  
                   $result['parent']=$r['parentid'].":".'Main';
              }
             
              $result['catid']=$r['catid'];   
              $this->category[$result['parent']]=$result['catid'];
              //array_push($this->category, $result['parent']=>$result['catid']);              
              
         }                   
         //echo json_encode($this->category);
        
          //$htmldata="<ul><li><a href=''>Categories<span class='drop-icon'>▾</span></a><ul>";
         $htmldata="<ul class='lvl'>";
          foreach ($this->category as $c=>$v)
          {   
              //echo "Processing...".$c;
              $parent=  explode(":", $c)[1];              
              if(!in_array($c, $this->usedcategory)){
              $htmldata.="<li class='lvl_1'><b><a href='index.php?r=productdetail/productdetails&catid=".explode(":",$c)[0]."'>$parent<span class='drop-icon'>▾</span></a></b><ul>";
              //array_push($categorydone,$c);
              $res=  $this->createlist($c,'lvl_2');
              //unset($this->category[$c]);
              $htmldata.=$res."</ul></li>";//to display ROOT Category.
              //$htmldata.=$res;    
              }
          }
          $htmldata.='</ul>';
         //echo $htmldata;
       return $htmldata;
    }
    
    /*******recursive function*********/
    public function createlist($id,$lvl)
    {   
         //var_dump($id)."<br>";
        $html='';
        $htmlstr='';
        $returnhtml='';
         $childcats=array(); 
         $usedcats=array();
        //echo json_encode($this->category);
       // if(isset($this->category[$id])){        
        if(isset($this->category[$id]) && !in_array($id, $this->usedcategory) ){
            $childcats=  explode(',', $this->category[$id]);
            //unset($this->category[$id]);    //to delete element
            array_push($this->usedcategory, $id);
            // echo "Deleted catid..".$id;
           // var_dump($childcats);
            foreach ($childcats as $c)
            {                
                if(isset($this->category[$c]) && !in_array($c, $this->usedcategory)){
                    $parentin= explode(":",$c)[1];                                                    
                  $returnhtml.="<li class='".$lvl."'><b><a href='index.php?r=productdetail/productdetails&catid=".explode(":",$c)[0]."'>$parentin<span class='drop-icon'>▾</span></a></b><ul>"; 
                  $lvlarr=explode('_',$lvl);
                  $lvlinner=  intval($lvlarr[1])+1;
                  $lvlinnerstr='lvl_'.$lvlinner;                
                  $htmlstr=$this->createlist($c,$lvlinnerstr);
                  $returnhtml.=$htmlstr."</ul></li>";                   
                 }
                else{                   
                    $cat= explode(':', $c);
                    if(isset($cat[1]))
                      $returnhtml.='<li class="'.$lvl.'"><a href="index.php?r=productdetail/productdetails&catid='.$cat[0].'">'.$cat[1].'</a></li>';                 
                    else{
                      $returnhtml.='<li class="'.$lvl.'"><a href="index.php?r=productdetail/productdetails&catid='.$cat[0].'">'.$cat[0].'</a></li>';
                    }                                
                }
               //echo $this->category[$c];                         
            }
        }      
          return $returnhtml;          
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    
    /**
	 * This is the action to handle external exceptions.
	 */
      public function actionErrors()
      {
            //$message="In SiteController action Error and logged in user id = ".Yii::app()->user->id;
           // Yii::log($message, 'info' ,'');
          
          $error=Yii::$app->errorHandler->exception;          
              if ($error !== null) {
                      return $this->render('errors');
               } 		
      }
      
      public function actionTermscondven()
      {
               
           return $this->render('termcondiven');
                		
      }
      
       public function actionPrivacypolven()
      {
                   
           return $this->render('privacypolicyven');
                		
      }
      
      public function actionAboutus()
      {
           return $this->render('aboutus');
      }
      public function actionWhydigin()
      {
           return $this->render('whydigin');
      }
      
       public function actionTermcondbuyr()
      {
           return $this->render('termcondbyr');
      }
      
      public function actionPrivacypolbuyr()
      {
                   
           return $this->render('privacypolicybuyr');
                		
      }
        public function actionShippingpolicy()
      {
                   
           return $this->render('shippingpolicy');
                		
      }
        public function actionOrderpaymntpolicy()
      {
                   
           return $this->render('orderpaypolicy');
                		
      }
       public function actionVendorplans()
      {
           return $this->render('vendorplans');
      }
      
      /**contact us**/

      public function actionContactus()
      {
            if((isset($_REQUEST['usernm']) && $_REQUEST['usernm']!="")
                &&  (isset($_REQUEST['mail']) && $_REQUEST['mail']!="")
                && (isset($_REQUEST['subj']) && $_REQUEST['subj']!="")
                && (isset($_REQUEST['msg']) && $_REQUEST['msg']!="")){
            //var_dump($_REQUEST);
           $name = $_REQUEST['usernm'];
           $email = $_REQUEST['mail'];
           $subject = $_REQUEST['subj'];
           $message = $_REQUEST['msg'];
           
          // $emailhtm = "<p>Hello <b>".$name."</b>. Your mail has been sent Successfully. Thank you!<br> Meassage:<p>".$message."</p>"; 
         //$emailhtm = "<p><b>New Mail From Contact Us<br><br>Name:</b>&nbsp;".$name."<br><b>Subject:&nbsp;</b>".$subject."<b><br>From:&nbsp;</b>".$email."<br><b>Meassage:&nbsp;</b><br>".$message.""; 
         $emailhtm = "<p><b>Click on image bellow go to my store on Digin</b><br><br><br>".$badge."<br><br><br>".$msg."";
           
           \Yii::$app->mailer->compose()                       
                   ->setFrom($email)
                   ->setTo('mail@digin.in')
                   ->setBcc('sheetaljagdale250@gmail.com')
                   ->setSubject('Contact Us Mail From Digin')
                   //->setTextBody('hi...') 
                   ->setHtmlBody($emailhtm)                  
                   ->send();
             Yii::$app->session->setFlash('success', 'Your mail has been sent Successfully.');  
                return $this->render('contactus');
                
                }  else {
                     return $this->render('contactus');
                }
              		
      }

      public function actionShare()
      {
          return $this->render('share');
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
           //var_dump($emails);
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