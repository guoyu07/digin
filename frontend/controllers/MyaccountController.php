<?php

namespace frontend\controllers;



class MyaccountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
   
    
     public function actionAddaddress()
    {
       /* $userid=$_REQUEST['userid'];
        $name=$_REQUEST['name'];
        $email=$_REQUEST['email'];
        $phone=$_REQUEST['phone'];
        $addr1=$_REQUEST['addr1'];
        $addr2=$_REQUEST['addr2'];
        $city=$_REQUEST['city'];
        $state=$_REQUEST['state'];
        //$country=$_REQUEST['country'];
        $country='India';
        $pin=$_REQUEST['pin'];*/        
        
        \Yii::info("In MyaccountController within action Addaddress. Logged userid is:".\Yii::$app->user->identity->id);         
        $userid=\Yii::$app->user->identity->id;
        $name=$_POST['username'];
        $email=$_POST['mail'];
        $phone=$_POST['phone'];
        $addr1=$_POST['address1'];
        $addr2=$_POST['address2'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $country=$_POST['country'];       
        $pin=$_POST['pin'];        
        
        $address=new \frontend\models\Address();
        $result = $address->insertAddress($userid,$name,$email,$phone,$addr1,$addr2,$city,$state,$country,$pin);
           
        $user=  \dektrium\user\models\User::find()->where(['id'=>$userid])->one();            
        $data=['name'=>$user['username'], 'email'=>$user['email'], 'phone'=>$user['phone']];
        return $this->render('account',array('address'=>$result, 'myaccount'=>$data));
        
    }
    public function actionViewaddress()
    {
        if(isset(\Yii::$app->user->identity->id)){
        \Yii::info("In MyaccountController within action Viewaddress. Logged userid is:".\Yii::$app->user->identity->id);         
        //$userid=$_GET['userid'];         
        $userid=\Yii::$app->user->identity->id;
        
        $address=new \frontend\models\Address();
        $result = $address->showaddress($userid);
        
        $user=  \dektrium\user\models\User::find()->where(['id'=>$userid])->one();            
        $data=['name'=>$user['username'], 'email'=>$user['email'], 'phone'=>$user['phone']];
        
        $query1 = (new \yii\db\Query()) 
                ->select(['o.orid','o.userid','o.displayid','o.grosstotal','o.status','o.crtdt'])
                ->from('orders o')
                ->where(['o.userid'=>$userid]);
        $orderdata=$query1->all(); 
       // var_dump($orderdata);
        
        return $this->render('account',array('address'=>$result, 'myaccount'=>$data ,'orderdetail'=>$orderdata));
        }else{
            return $this->redirect('index.php?r=login/login'); 
        }
    }
    
    public function actionOrderdetail(){
      
         $url=$_SERVER['SERVER_NAME'];  
         $orid=$_GET['orid'];
         
         $url1="http://".$url."/images/productimages/";
         
         $query1 = (new \yii\db\Query()) 
                ->select(['oi.orid','oi.shipment','oi.vpid','oi.rate','oi.quantity','oi.producttotal','vp.prid','vp.prid','("product") as type','CONCAT("'.$url1.'",if(pri.image IN (NULL, ""),"default_image.png", CONCAT(pr.prid,"/",pri.image))) as Image','pr.prodname'])
                ->from('orderitem oi')
                ->join('inner join', 'vendor_products vp', 'vp.vpid=oi.vpid')
                ->join('inner join', 'product pr', 'vp.prid=pr.prid')
                ->join('inner join', 'product_images pri', 'pri.prid=pr.prid')
                ->where(['oi.orid'=>$orid])
                ->andWhere(['pri.ismain'=>1]);    
         $orderitemdata=$query1->all(); 
        
        return $this->render('orderitemdata',array('orderinteminfo'=>$orderitemdata));
        
    }

}
