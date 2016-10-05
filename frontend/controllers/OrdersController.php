<?php

namespace frontend\controllers;

use Yii;
use backend\models\Orders;
use backend\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DOMNode;
require_once (Yii::$app->basePath.'/models/WsdlforDTDC.php');

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    /*** to test sending email*/
   /*  public function actionMailtest()
    {
        echo "Started sending mail";
        Yii::info('Started sending mail...');        
        // $message='<p>Welcome! Your account has been registered at.'.date('Y-m-d H:i:s').' Here is your login credentials!</p>';         
        $unm='bhagyashri'; $pass='bhagyashri123';
        $email=['bhagyashri@aayati.co.in', 'bhagyashrilatkar27@gmail.com'];
        $message='<p>New mail from Digin <br> <b>Subject:&nbsp;</b>Vendor Registration Details<br><b>From:&nbsp;</b>mail@digin.in <br><b>Message:&nbsp;</b>bhagyashri@aayati.co.in Your account has been registered successfully</p><br>'.date('Y-m-d H:i:s').'<br><p>Your login credentials are as follows:<br><b>Username:&nbsp;</b>'.$unm.'<br><b>Password:&nbsp;</b>'.$pass.'</p>';         
                \Yii::$app->mailer->compose()
                   ->setFrom('mail@digin.in')
                   //->setBcc('sameer@aayati.co.in')     
                   ->setTo($email)
                   ->setSubject('Vendor Account Registration Details')
                   ->setHtmlBody($message)
                   ->send();
         Yii::info('End sending mail...');       
        echo "End sending mail";  
    } */
    
  public function actionCreateorder()
  {      
      Yii::info("In OrdersController within action Createorder. Logged userid is:".Yii::$app->user->identity->id);
      
      $userid=Yii::$app->user->identity->id;
      $ref=$_GET['txnid'];
      $addrid=$_GET['udf1'];
      $type=$_GET['udf2'];
      //echo $ref."......".$addrid."....".$type;
      $session = Yii::$app->session;
        if(isset($session['shipping'])){
            $shippingresult = $session['shipping'];
        }
        
        $servicetax = \Yii::$app->params['tax'];
       
        $randomno=  uniqid();        
        $success1=false;
        $success2=false;
        $success3=false;
        $success4=false;
        $orderupdate=false;
        $result=array();
        
        $total=0;
                     
        
     //   $session = Yii::$app->session;
        if(isset($session['buynow'])){
            $buynow = $session['buynow'];  
        }
       
        $order= new Orders();
        $order->displayid=uniqid();
        $order->userid=$userid;
        $order->adrid=$addrid;
        $order->transref=$ref;
        $order->total=0;
        $order->shipment=0;
        $order->grosstotal=0;    
        $order->status='Payment Pending';
        $order->crtdt=date('Y-m-d H:i:s');
        $order->crtby=$userid;
        $order->upddt=date('Y-m-d H:i:s');
        $order->updby=$userid;
        $success1=$order->save(false);
        
        if($type=='C'){
        $query1 = (new \yii\db\Query())                           
                ->select(['c.vpid', 'quantity','vp.price', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                  
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')           
                ->where(['c.userid'=>$userid]);                      
        $cart=$query1->all(); 
       
        foreach ($cart as $c){
        $orderitem=new \backend\models\Orderitem();
        $orderitem->orid=$order->orid;
        $orderitem->vpid=$c['vpid'];
        $orderitem->rate=$c['price'];
        $orderitem->quantity=$c['quantity'];
        $orderitem->producttotal=$c['total'];
        $orderitem->shipment=0;
        $orderitem->grosstotal=0;
        $orderitem->crtdt=date('Y-m-d H:i:s');
        $orderitem->crtby=$userid;
        $orderitem->upddt=date('Y-m-d H:i:s');
        $orderitem->updby=$userid;       
        $total+=$orderitem->producttotal;
        $success2=$orderitem->save(false);
        }
     }
     else if($type=='B'){               
        $items=array();
        foreach ($buynow as $key=>$value)
        {
             $query1 = (new \yii\db\Query())                           
                ->select(['v.vid','vp.price','vp.vpid'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                                                                         
                ->where(['vp.vpid'=>$key]);     
               
           $product=$query1->one(); 
           array_push($items, $product);
        }         
        //unset($session['buynow']);
                
        foreach ($items as $i){
            $orderitem=new \backend\models\Orderitem();
            $orderitem->orid=$order->orid;
            $orderitem->vpid=$i['vpid'];
            $orderitem->rate=$i['price'];
            $orderitem->quantity=$buynow[$i['vpid']];
            $orderitem->producttotal=$buynow[$i['vpid']]*$i['price'];
            $orderitem->shipment=0;
            $orderitem->grosstotal=0;
            $orderitem->crtdt=date('Y-m-d H:i:s');
            $orderitem->crtby=$userid;
            $orderitem->upddt=date('Y-m-d H:i:s');
            $orderitem->updby=$userid;       
            $total+=$orderitem->producttotal;
            $success4=$orderitem->save(false);
        }
     }  
     
        $totalshipment=0;
        $grosstotal=0;
        $shipping=0;
        
        foreach ($shippingresult as $s){
            $shipment=  explode('_', $s);               
            $saveditems=  \backend\models\Orderitem::find()->where(['vpid'=>$shipment[0], 'orid'=>$order->orid])->one();
            $saveditems->shipment=$shipment[1];
            $saveditems->grosstotal=$saveditems['producttotal']+$shipment[1];
            $totalshipment+=$saveditems->shipment;
            $grosstotal+=$saveditems->grosstotal;
            $success3=$saveditems->save(false);           
        }
        unset($session['shipping']);
        
        if($success2 && $success3)
        {    
            Yii::info("Order is created successfully! Total shipping of order with service tax ".$servicetax."% is Rs.".$totalshipment);
           // \backend\models\Cart::deleteAll(['userid'=>$userid]);            
           // Yii::info("Cart is empty!");
        }                    
        if($success4 && $success3)
        {    
            Yii::info("Order is created successfully! Total shipping of order with service tax ".$servicetax."% is Rs.".$totalshipment);                  
            //Yii::info("Session data has become empty!");
        }   
        
       
        $order->total=$total;
        $order->shipment=$totalshipment;
        $order->grosstotal=$grosstotal;
        $orderupdate= $order->save(false);
        echo $orderupdate; 
  }

    public function actionAddorders()
    {	          
        Yii::info("In OrdersController within action Addorders. Logged userid is:".Yii::$app->user->identity->id);
        $userid=Yii::$app->user->identity->id;
      
        $ref=$_POST['txnid'];
        $addrid=$_POST['udf1'];
        $type=$_POST['udf2'];
        $status=$_POST['status'];
        $error=$_POST['error'];
        $payuid=$_POST['payuMoneyId'];
         
        \Yii::info('ref'.$ref.'addr'.$addrid.'type'.$type.'status'.$status.'error'.$error.'payid'.$payuid);

        $sms=new \frontend\models\Smssetting();
         
        $order=  Orders::find()->where(['transref'=>$ref])->one();
        if(!isset($userid) && $userid==""){
            $userid=$order['userid'];
        }
        
        $orderid=$order['displayid'];
        $session = Yii::$app->session;      

        if($status=='success')
        {
            $order->status=$status;
            $order->errorcode=$error;
            $order->payumoneyid=$payuid;
            $order->save(false);
            Yii::info("Order is confirmed by PayUmoney successfully!");
            if($type=='C')
            {
                \backend\models\Cart::deleteAll(['userid'=>$userid]);
                Yii::info("Cart is empty!");
            }
            else if($type=='B'){                
                 unset($session['buynow']);
                 Yii::info("Session data has become empty!");
            }
        }
       
        $orderarray=array();
        $address=  \frontend\models\Address::find()->where(['adrid'=>$addrid])->one();
        $phone=$address['phone'];
         if($phone==""){
           $user = \dektrium\user\models\User::find()->where(['id'=>$userid])->one();
           $phone = $user['phone'];
        }
        $url=$sms->getUrl($orderid, $phone);
        $sms->sendMessage($url);  
        Yii::info("A message has been sent as: Your order is received successfully. We will deliver it very soon. Your order id is ".$orderid.". Thank you.");
        $orderarray=$this->getOrder($userid, $addrid, $orderid,null);

             

        $dpemails=array();
        $dpdata=array();
        $vpid=array();
        foreach($orderarray[2] as $or){            
            $query1 = (new \yii\db\Query())                           
                    //->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname', 'o.shipment'])
                    ->select(['dp.emailid', 'dp.dpid'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                                               
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->join('inner join', 'dppackage d', 'd.id=v.dppkgid')
                    ->join('inner join', 'delivery_partner dp', 'dp.dpid=d.dpid')                                       
                    ->where(['orid'=>$or['orid']])
                    ->andWhere(['o.vpid'=>$or['vpid']]);
            $oritem=$query1->one();           
//           if(!in_array($oritem['emailid'], $dpemails))
//                array_push($dpemails, $oritem['emailid']);
           if(!array_key_exists($oritem['dpid'], $dpdata)){                                         
               $dpdata[$oritem['dpid']]=$oritem['emailid'];              
           }
           if(!in_array($or['vpid'], $vpid))
               array_push ($vpid, $or['vpid']);
        }
        foreach($dpdata as $dpkey=>$dpval)
        {           
            //$dpkey is dpid & $dpval is dp emailid
            //To send email to Delivery Partners
            $orderarrdp=array();
            if($dpkey!=1){
            $orderarrdp=  $this->getOrderforDP($userid, $addrid, $orderid,$dpkey);
            \Yii::$app->mailer->compose('dpemailorder',['orderdetails'=>$orderarrdp])
                       ->setFrom('mail@digin.in')
                       //->setTo($dpemails)
                       ->setTo($dpval)
                       ->setBcc('mail@digin.in')
                       ->setSubject('Order Detail : '.$orderid)                                    
                       ->send();
            }
        }
      
        //to get each vendor & send them separate mail according to product
         $query2 = (new \yii\db\Query())  
                  ->select(['v.vid', 'v.email', 'GROUP_CONCAT(vp.vpid) as vpid'])
                  ->from('vendor v')
                  ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid') 
                  ->groupBy('v.vid')                  
                  ->where(['vp.vpid'=>$vpid]);
        $vendors=$query2->all();
        foreach ($vendors as $v)
        {            
            $vmail=$v['email'];
            $orderarrven=array();
            $orderarrven=$this->getOrder($userid, $addrid, $orderid,$v['vpid']);
            \Yii::$app->mailer->compose('emailorder',['orderdetails'=>$orderarrven, 'showtotal'=>false])
                   ->setFrom('mail@digin.in')
                   ->setTo($vmail)
                   ->setBcc('mail@digin.in')
                   ->setSubject('Order Detail : '.$orderid)                                    
                   ->send();
        }
       
      
        
        $email=$address['email'];
        if($email==""){
          $user = \dektrium\user\models\User::find()->where(['id'=>$userid])->one();
          $email = $user['email'];
        }
       
         \Yii::$app->mailer->compose('emailorder',['orderdetails'=>$orderarray, 'showtotal'=>true])
                   ->setFrom('mail@digin.in')
                   ->setTo($email)
                   ->setBcc('mail@digin.in')
                   ->setSubject('Order Detail : '.$orderid)                                  
                   ->send();
         

        //Checking Delivery Partner & adding his details to Database 
        $xmlbatch=$this->Detectdeliverypartner($addrid,$orderid);

        //Passing XMLbatch to function & calling DTDC API
        if($xmlbatch){
            $this->DTDCpushOrderDataAPI($xmlbatch);
        }  
        return $this->render('orderdetail', array('orderdetails'=>$orderarray));  
    }
    
    /*** Use this function to send email to User & Vendors
    * **/ 
    public function getOrder($userid,$addrid,$orderid,$vpid)
    {
        $ordersdata=array();
        $orders=array();
        $orderitems=array();
        $dlvrpin = 0;
        
        
        $url=$_SERVER['SERVER_NAME']; 
        $url1="http://".$url."/images/productimages/";
        $query1 = (new \yii\db\Query())   
               ->select(['orid','userid', 'displayid', 'transref', 'total', 'shipment', 'grosstotal'])
               ->from('orders')
               ->where(['userid'=>$userid])
               ->andWhere(['displayid'=>$orderid]);
        $order=$query1->all();
                
        $query = (new \yii\db\Query())   
               ->select(['name','email', 'phone', 'address1', 'address2', 'city', 'state', 'country', 'pin'])
               ->from('address')
               ->where(['userid'=>$userid])
               ->andWhere(['adrid'=>$addrid]);
        $address=$query->all();
           
        foreach ($order as $or){
             $query1 = (new \yii\db\Query())                           
                    //->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname', 'o.shipment'])
                    ->select(['orid','v.delivery','o.vpid','o.delivery_pin','o.oritemid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'v.businessname', 'o.shipment'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                    ->join('inner join', 'product p', 'p.prid=vp.prid')                                      
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->where(['orid'=>$or['orid']]);
             if(isset($vpid)){
               $query1->andWhere(['o.vpid'=>$vpid]);
             }
                                       
             $orderitem=$query1->all();             
            foreach ($orderitem as $i)
            {  
                $orders['orid']=$i['orid'];
                $orders['vpid']=$i['vpid'];
                $orders['rate']=$i['rate'];
                $orders['quantity']=$i['quantity'];
                $orders['producttotal']=$i['producttotal'];
                $orders['prodname']=$i['prodname'];               
                $orders['businessname']=$i['businessname'];
                $orders['shipping']=$i['shipment'];
                if($i['delivery']==2){
                if($vpid == NULL){
                $dlvrpin = mt_rand(100000, 999999); 
                $orders['delivery_pin']=  $dlvrpin;
                $uporitem =  \backend\models\Orderitem::findOne($i['oritemid']);
                $uporitem->delivery_pin = $dlvrpin;
                $uporitem->update();
                }    
               
               }
                
                array_push($orderitems, $orders);                
            }            
        }       
        array_push($ordersdata, $order);
        array_push($ordersdata, $address);
        array_push($ordersdata, $orderitems);
      
        return $ordersdata;      
    }
  
   /*** Use this function to send email for Delivery Partners
    *   of that vendors
    * **/ 
   public function getOrderforDP($userid,$addrid,$orderid, $dpid)
   {
      $ordersdata=array();
        $orders=array();
        $orderitems=array();
        
        $url=$_SERVER['SERVER_NAME']; 
        $url1="http://".$url."/images/productimages/";
        $query1 = (new \yii\db\Query())   
               ->select(['orid','userid', 'displayid', 'transref', 'total', 'shipment', 'grosstotal'])
               ->from('orders')
               ->where(['userid'=>$userid])
               ->andWhere(['displayid'=>$orderid]);
        $order=$query1->all();
                
        $query = (new \yii\db\Query())   
               ->select(['name','email', 'phone', 'address1', 'address2', 'city', 'state', 'country', 'pin'])
               ->from('address')
               ->where(['userid'=>$userid])
               ->andWhere(['adrid'=>$addrid]);
        $address=$query->all();
           
        foreach ($order as $or){          
             $query1 = (new \yii\db\Query())                                     
                    ->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'v.businessname', 'o.shipment', 'dp.emailid', 'v.address1', 'v.address2', 'v.city', 'v.state', 'v.pin', 'v.phone1', 'v.email'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                    ->join('inner join', 'product p', 'p.prid=vp.prid')                                        
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->join('inner join', 'dppackage d', 'd.id=v.dppkgid')
                    ->join('inner join', 'delivery_partner dp', 'dp.dpid=d.dpid')                                     
                    ->where(['orid'=>$or['orid']])
                    ->andWhere(['dp.dpid'=>$dpid]);                                       
             $orderitem=$query1->all();             
            foreach ($orderitem as $i)
            {  
                $orders['orid']=$i['orid'];
                $orders['vpid']=$i['vpid'];
                $orders['rate']=$i['rate'];
                $orders['quantity']=$i['quantity'];
                $orders['producttotal']=$i['producttotal'];
                $orders['prodname']=$i['prodname'];                
                $orders['businessname']=$i['businessname'];
                $orders['shipping']=$i['shipment'];
                $orders['dpemail']=$i['emailid'];
                $orders['address1']=$i['address1'];
                $orders['address2']=$i['address2'];
                $orders['city']=$i['city'];
                $orders['state']=$i['state'];
                $orders['pin']=$i['pin'];
                $orders['phone']=$i['phone1'];
                $orders['email']=$i['email'];
                array_push($orderitems, $orders);                
            }            
        }       
        array_push($ordersdata, $order);
        array_push($ordersdata, $address);
        array_push($ordersdata, $orderitems);
        return $ordersdata; 
   }

   public function actionVieworders()
    {
        //$this->layout='mailtemp';
        $userid=$_GET['userid'];
        $addrid=$_GET['adrid'];
        $orderid=$_GET['orderid'];
        
        
        $ordersdata=array();
        $orders=array();
        $orderitems=array();
        
        $url=$_SERVER['SERVER_NAME']; 
        $url1="http://".$url."/images/productimages/";
        $query1 = (new \yii\db\Query())   
               ->select(['orid','userid', 'displayid', 'transref', 'total', 'shipment', 'grosstotal'])
               ->from('orders')
               ->where(['userid'=>$userid])
               ->andWhere(['displayid'=>$orderid]);
        $order=$query1->all();
                
        $query = (new \yii\db\Query())   
               ->select(['name','email', 'phone', 'address1', 'address2', 'city', 'state', 'country', 'pin'])
               ->from('address')
               ->where(['userid'=>$userid])
               ->andWhere(['adrid'=>$addrid]);
        $address=$query->all();
           
        foreach ($order as $or){
           // $orderitem=  \backend\models\Orderitem::find()->where(['orid'=>$or['orid']])->all();
             $query1 = (new \yii\db\Query())                           
                    //->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname', 'o.shipment'])
                    ->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'v.businessname', 'o.shipment', 'dp.emailid', 'v.address1', 'v.address2', 'v.city', 'v.state', 'v.pin', 'v.phone1', 'v.email'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                    ->join('inner join', 'product p', 'p.prid=vp.prid')
                    //->join('inner join', 'product_images i', 'i.prid=p.prid')                     
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->join('inner join', 'dppackage d', 'd.id=v.dppkgid')
                    ->join('inner join', 'delivery_partner dp', 'dp.dpid=d.dpid')
                    //->groupBy('d.dpid')                   
                    ->where(['orid'=>$or['orid']]);
                    //->andWhere(['d.dpid'=>1]);
                    //->andWhere(['vp.vpid'=>453]);
                    //->andWhere(['i.ismain'=>1]);                    
             $orderitem=$query1->all();             
            foreach ($orderitem as $i)
            {  
                $orders['orid']=$i['orid'];
                $orders['vpid']=$i['vpid'];
                $orders['rate']=$i['rate'];
                $orders['quantity']=$i['quantity'];
                $orders['producttotal']=$i['producttotal'];
                $orders['prodname']=$i['prodname'];
                //$orders['Image']=$i['Image'];
                $orders['businessname']=$i['businessname'];
                $orders['shipping']=$i['shipment'];
                $orders['dpemail']=$i['emailid'];
                $orders['address1']=$i['address1'];
                $orders['address2']=$i['address2'];
                $orders['city']=$i['city'];
                $orders['state']=$i['state'];
                $orders['pin']=$i['pin'];
                $orders['phone']=$i['phone1'];
                $orders['email']=$i['email'];
                array_push($orderitems, $orders);                
            }            
        }       
        array_push($ordersdata, $order);
        array_push($ordersdata, $address);
        array_push($ordersdata, $orderitems);
        
    /*    $userid=537;
        $addrid=6;
        $orderid='56c73bc8eb4a7';
        $orderarray=$this->getOrder($userid, $addrid, $orderid,null);
        //var_dump($orderarray);
        $dpemails=array();
        $vpid=array();
        $dpdata=array();       
        foreach($orderarray[2] as $or){
            //echo $or['vpid']."<br>";
            $query1 = (new \yii\db\Query())                           
                    //->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname', 'o.shipment'])
                    ->select(['dp.emailid', 'dp.dpid'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                                               
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->join('inner join', 'dppackage d', 'd.id=v.dppkgid')
                    ->join('inner join', 'delivery_partner dp', 'dp.dpid=d.dpid')                                       
                    ->where(['orid'=>$or['orid']])
                    ->andWhere(['o.vpid'=>$or['vpid']]);
            $oritem=$query1->one(); 
          // echo $oritem['emailid'].".....".$or['vpid']."<br>";
         //  if(!in_array($oritem['emailid'], $dpemails)){ 
            if(!array_key_exists($oritem['dpid'], $dpdata)){
                //array_push($dpemails, $oritem['emailid']);                          
               $dpdata[$oritem['dpid']]=$oritem['emailid'];              
           }
           
           if(!in_array($or['vpid'], $vpid))
               array_push ($vpid, $or['vpid']);
        }  
        
        //var_dump($dpemails);
        //var_dump($dpdata);
//        foreach($dpdata as $dpkey=>$dpval)
//        {
//            echo $dpkey.".....".$dpval."<br>";
//        }
   //     echo "<br>";        
        //var_dump($vpid);        
        $query2 = (new \yii\db\Query())  
                  ->select(['v.vid', 'v.email', 'GROUP_CONCAT(vp.vpid) as vpid'])
                  ->from('vendor v')
                  ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid') 
                  ->groupBy('v.vid')
                  //->where(['in', 'vp.vpid',$vpids]);
                  ->where(['vp.vpid'=>$vpid]);
        $vendors=$query2->all();
        foreach ($vendors as $v)
        {
            //echo $v['vpid'];
        } */
    //    var_dump($vendors);
        //echo json_encode($ordersdata);
     //   return $this->render('orderdetail', array('orderdetails'=>$ordersdata));
        return $this->render('order1', array('orderdetails'=>$ordersdata));
        //return $this->render('emailorder', array('orderdetails'=>$ordersdata));
    }
    
    /*public function actionGetlastshippedaddress()
    {
        $userid=$_GET['userid'];
        
        $query = (new \yii\db\Query())   
               ->select(['name','pin','orid'])
               ->from('orders o')
               ->join('inner join','address a', 'o.adrid=a.adrid')
               ->where(['o.userid'=>$userid])
               ->orderBy('o.upddt DESC');                              
        
        $data=$query->one();
               
        if(!$data){
            $query = (new \yii\db\Query())   
               ->select(['pin'])
               ->from('address')
               ->where(['userid'=>$userid])
               ->orderBy('upddt DESC');  
        $data=$query->one();
        echo "0";
        }
        //var_dump($data);
        echo json_encode($data['pin']);        
        }*/
    /* public function actionViewallorders()
    {
        $userid=$_GET['userid'];
        
        $ordersdata=array();
        $orders=array();
        $orderitems=array();
        
        $url=$_SERVER['SERVER_NAME']; 
        $url1="http:/".$url."/images/productimages/";
        $query1 = (new \yii\db\Query())   
               ->select(['orid','userid', 'displayid', 'transref', 'total'])
               ->from('orders')
               ->where(['userid'=>$userid]);
        $order=$query1->all(); 
           
        foreach ($order as $or){
           // $orderitem=  \backend\models\Orderitem::find()->where(['orid'=>$or['orid']])->all();
             $query1 = (new \yii\db\Query())                           
                    ->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                    ->join('inner join', 'product p', 'p.prid=vp.prid')
                    ->join('inner join', 'product_images i', 'i.prid=p.prid')                     
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->where(['orid'=>$or['orid']]);                    
             $orderitem=$query1->all();             
            foreach ($orderitem as $i)
            {  
                $orders['orid']=$i['orid'];
                $orders['vpid']=$i['vpid'];
                $orders['rate']=$i['rate'];
                $orders['quantity']=$i['quantity'];
                $orders['producttotal']=$i['producttotal'];
                $orders['prodname']=$i['prodname'];
                $orders['Image']=$i['Image'];
                $orders['businessname']=$i['businessname'];
                array_push($orderitems, $orders);                
            }            
        }       
        array_push($ordersdata, $order);
        array_push($ordersdata, $orderitems);
      
        echo json_encode($ordersdata);
    } */
    
    /* public function getUrl()
    {
        $smsdata= \frontend\models\Smssetting::find()->one();        
        $unm=$smsdata['SMSUserNm'];
        $pass=$smsdata['SMSPassword'];
        $senderid=$smsdata['SMSSenderID'];
        $msg="Your order is received successfully. We will deliver it very soon. Thank you.";        
       
        $userdata=\dektrium\user\models\User::find()->select('phone')->where(['id'=>\Yii::$app->user->identity->id])->one();
        $mobno=$userdata['phone'];
        
        $url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$unm."&pass=".$pass."&senderid=".$senderid."&dest_mobileno=".$mobno."&message=".$msg."&response=Y";
        return urlencode($url);
    }
    
    public function sendMessage($url)
    {
        $ch = curl_init();                    // initiate curl
       
        $url=  urldecode($url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format

        $output = curl_exec ($ch); 
        echo $output; 
    } */
  public function actionOrder()
  {
      //var_dump($_POST);
      //var_dump(Yii::$app);
      //return $this->render('order');
   }
   
   public function actionMakepayment()
   {
       return $this->render('PayUMoney_form');
   }
   public function actionPaymentsuccess()
   {
       return $this->render('success');
   }
   public function actionPaymentfailure()
   {        
        Yii::info("In OrdersController within action Paymentfailure. Logged userid is:".Yii::$app->user->identity->id);
        $userid=Yii::$app->user->identity->id;
       if(isset($_POST['txnid']) && $_POST['txnid']!='' &&
           isset($_POST['udf1']) && $_POST['udf1']!='' && isset($_POST['udf2']) && $_POST['udf2']!='' && isset($_POST['status']) && $_POST['status']!='' && isset($_POST['error']) && $_POST['error']!='' && isset($_POST['payuMoneyId']) && $_POST['payuMoneyId']!=''){
        $ref=$_POST['txnid'];
        $addrid=$_POST['udf1'];
        $type=$_POST['udf2'];
        $status=$_POST['status'];
        $error=$_POST['error'];
        $payuid=$_POST['payuMoneyId'];
        
        $order=  Orders::find()->where(['transref'=>$ref])->one();              
      
        $order->status=$status;
        $order->errorcode=$error;
        $order->payumoneyid=$payuid;
        $order->save(false);
        Yii::info("Order is declined by PayUmoney!");
       }
        return $this->render('failure');
   }
   
   /*** Use this function to detect Delivery Partner whether it is DTDC
    *   and pass data of that DP to upload order for DTDC
    * **/ 
   public function Detectdeliverypartner($addrid,$orderid)
   {
        Yii::info("In OrdersController within action Detectdeliverypartner. Logged userid is:".Yii::$app->user->identity->id);
        $userid=Yii::$app->user->identity->id;
                
        $orders=array();
        $orderitems=array();
        $query1 = (new \yii\db\Query())   
               ->select(['orid', 'userid','displayid', 'grosstotal'])
               ->from('orders')
               //->where(['userid'=>$userid])
               ->where(['displayid'=>$orderid]);
        $order=$query1->one();
                
        $query = (new \yii\db\Query())   
               ->select(['name','email', 'phone', 'address1', 'address2', 'city', 'state', 'country', 'pin'])
               ->from('address')
               //->where(['userid'=>$userid])
               ->where(['adrid'=>$addrid]);
        $address=$query->one();
 
        $query1 = (new \yii\db\Query())                                          
                    ->select(['orid', 'oritemid' ,'o.vpid', 'p.prid', 'rate', 'quantity','p.prodname', 'dp.name', 'v.businessname', 'v.address1', 'v.address2', 'v.pin', 'v.phone1', 'weight', 'weightunit'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                    ->join('inner join', 'product p', 'p.prid=vp.prid')                           
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->join('inner join', 'dppackage d', 'd.id=v.dppkgid')
                    ->join('inner join', 'delivery_partner dp', 'dp.dpid=d.dpid')  
                    ->where(['orid'=>$order['orid']]);
        $orderitem=$query1->all();     
    
     
        foreach ($orderitem as $i)
        {  
               //take only those items whose delivery partner is DTDC
                if($i['name']=="DTDC"){
                    Yii::info("Delivery partner is DTDC.");                    
                    $orders['oritemid']=$i['oritemid'];                  
                    $orders['prid']=$i['prid'];                    
                    $orders['quantity']=$i['quantity'];                
                    $orders['prodname']=$i['prodname'];                
                    $orders['businessname']=$i['businessname'];                              
                    $orders['address1']=$i['address1'];
                    $orders['address2']=$i['address2'];                
                    $orders['pin']=$i['pin'];
                    $orders['phone']=$i['phone1'];
                    if($i['weightunit']==1)
                    {
                         $orders['weight']=$i['weight'];
                    }
                    else{
                         $orders['weight']=$i['weight']/1000;
                    } 
                    $orders['weightunit']="Per KG";
                     array_push($orderitems, $orders);
                }
                else{
                    Yii::info("Delivery partner is other than DTDC.");
                }                               
            } 
         //var_dump($orderitems);
         if(sizeof($orderitems)>0){
            return $this->Setdatatouploadorder($order, $address, $orderitems);   
         }
         else{
             return false;
         }
   }
   
   /*** Use this function to create Docket of passed data 
    *   for creating XML batch
    * **/ 
   public function Setdatatouploadorder($order, $address, $orderitems)
   {
        Yii::info("In OrdersController within function Setdatatouploadorder. Logged userid is:".Yii::$app->user->identity->id);
       
        $orderdata=array();
        $userid=Yii::$app->user->identity->id; 
        if(!isset($userid) && $userid==""){
            $userid=$order['userid'];
        }

        foreach ($orderitems as $i)
        {  
                $connection=  (new \yii\db\Query());
                $connection->createCommand()->insert('dtdcawbno', ['AWBno' => null])->execute();
                /*$qry=(new \yii\db\Query())
                    ->select('AUTO_INCREMENT')
                    ->from('information_schema.TABLES')
                    ->where(['TABLE_SCHEMA'=>'ad045fcf_diginnu_new'])
                    ->andWhere(['TABLE_NAME'=>'dtdcawbno'])
                    ->all();
                $awbno=$qry[0]['AUTO_INCREMENT'];*/

                $sql =  'CALL SP_Generate_AWBno' ;
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand($sql);
                $awbno = $command->queryScalar();
        
                $dtdcmodel=new \frontend\models\Dtdcdetails();
                $dtdcmodel->oritemid=$i['oritemid'];
                $dtdcmodel->AWBno=$awbno;
                $dtdcmodel->status="Not Sent";
                $dtdcmodel->reason="";
                $dtdcmodel->crtdt=date('Y-m-d H:i:s');
                $dtdcmodel->crtby=$userid;
                $dtdcmodel->upddt=date('Y-m-d H:i:s');
                $dtdcmodel->updby=$userid;
                $dtdcmodel->save();             
                Yii::info("DTDC details are saved before calling API.");
            
                //creating docket object
                $docket=new \frontend\models\Docket();
                $docket->Order_No=$order['displayid'];
                $docket->AWB_No=$awbno;
                $docket->Product_Code=$i['prid'];
                $docket->Item_Name=$i['prodname'];
                $docket->N0_of_Pieces=$i['quantity'];
                $docket->Customer_Name=$address['name'];
                $docket->Shipping_Add1=$address['address1'];
                $docket->Shipping_Add2=$address['address2'];
                $docket->Shipping_City=$address['city'];
                $docket->Shipping_State=$address['state'];
                $docket->Shipping_Zip=$address['pin'];
                $docket->Shipping_TeleNo=$address['phone'];
                $docket->Shipping_MobileNo=$address['phone'];
                $docket->Shipping_EmailId=$address['email'];
                $docket->Total_Amt=$order['grosstotal'];
                $docket->Collectable_amount=0;                
                $docket->Weight=$i['weight'];                
                $docket->UOM=$i['weightunit'];
                $docket->VendorName=$i['businessname'];
                $docket->VendorAddress1=$i['address1'];
                $docket->VendorAddress2=$i['address2'];
                $docket->VendorPincode=$i['pin'];
                $docket->VendorTeleNo=$i['phone'];
                
                array_push($orderdata, $docket);                             
            }            
            //var_dump($orderdata);          
       return $this->createXMLbatchforDTDC($orderdata);
   }
   
   /*** Use this function to create XML batch
    * for DTDC & returns that XML back to 
	* Addorder function
	**/ 
   public function createXMLbatchforDTDC($orderdata)
   {
        Yii::info("In OrdersController within function createXMLbatchforDTDC. Logged userid is:".Yii::$app->user->identity->id);
        $schema = new \DOMDocument();

       $query=(new \yii\db\Query())
               ->select(['customercode'])
               ->from('dtdcsettings')                                      
               ->one();
     
       //Create Dataset
       $dataset=$schema->createElement('NewDataSet');
       $schema->appendChild($dataset);
       
       $customer=$schema->createElement('Customer');
       $dataset->appendChild($customer);
       
       $nodecid = $schema->createElement('CUSTCD');
       $customer->appendChild($nodecid);
       $nodecid->appendChild(new \DOMText($query['customercode']));    
    
       foreach($orderdata as $or)
       {   
            //Creating Docket
            $docket=$schema->createElement('Docket');
            $dataset->appendChild($docket);              
            
            //Adding Order No.
            $nodeorid=$schema->createElement('Order_No');            
            $docket->appendChild($nodeorid);
            $nodeorid->appendChild(new \DOMText($or->Order_No));
            
            //Adding Agent ID
            $nodeagid = $schema->createElement('AGENT_ID');            
            $docket->appendChild($nodeagid);
            $nodeagid->appendChild(new \DOMText(''));

            //Adding Product Code            
            $nodeprid=$schema->createElement('Product_Code');
            $docket->appendChild($nodeprid);
            $nodeprid->appendChild(new \DOMText($or->Product_Code));
            
            //Adding Item Name
            $nodeitem=$schema->createElement('Item_Name');
            $docket->appendChild($nodeitem);
            $nodeitem->appendChild(new \DOMText($or->Item_Name));
            
            //Adding AWB No.            
            $nodeawbno=$schema->createElement('AWB_No');
            $docket->appendChild($nodeawbno);            
            $nodeawbno->appendChild(new \DOMText($or->AWB_No));
            
            //Adding no.of pieces           
            $nodepiece=$schema->createElement('N0_of_Pieces');
            $docket->appendChild($nodepiece);               
            $nodepiece->appendChild(new \DOMText($or->N0_of_Pieces));
            
            //Adding Customer Name            
            $nodecustnm=$schema->createElement('Customer_Name');
            $docket->appendChild($nodecustnm);
            $nodecustnm->appendChild(new \DOMText($or->Customer_Name));
            
            //Adding Shipping Address1            
            $nodeshipaddr1=$schema->createElement('Shipping_Add1');
            $docket->appendChild($nodeshipaddr1);            
            $nodeshipaddr1->appendChild(new \DOMText($or->Shipping_Add1));
            
            //Adding Shipping Address2            
            $nodeshipaddr2=$schema->createElement('Shipping_Add2');
            $docket->appendChild($nodeshipaddr2); 
            $nodeshipaddr2->appendChild(new \DOMText($or->Shipping_Add2));
            
            //Adding Shipping City            
            $nodeshipcity=$schema->createElement('Shipping_City');
            $docket->appendChild($nodeshipcity);
            $nodeshipcity->appendChild(new \DOMText($or->Shipping_City));
            
            //Adding Shipping State            
            $nodeshipstate=$schema->createElement('Shipping_State');
            $docket->appendChild($nodeshipstate);
            $nodeshipstate->appendChild(new \DOMText($or->Shipping_State));
            
            //Adding Shipping Zip (pincode)            
            $nodeshipzip=$schema->createElement('Shipping_Zip');            
            $docket->appendChild($nodeshipzip);
            $nodeshipzip->appendChild(new \DOMText($or->Shipping_Zip));
            
            //Adding Shipping Telephone no.           
            $nodeshiptel=$schema->createElement('Shipping_TeleNo');
            $docket->appendChild($nodeshiptel);
            $nodeshiptel->appendChild(new \DOMText($or->Shipping_TeleNo));
            
            //Adding Shipping Mobile No.           
            $nodeshipmob=$schema->createElement('Shipping_MobileNo');
            $docket->appendChild($nodeshipmob);
            $nodeshipmob->appendChild(new \DOMText($or->Shipping_MobileNo));
            
            //Adding Shipping Email Id            
            $nodeshipmail=$schema->createElement('Shipping_EmailId');
            $docket->appendChild($nodeshipmail);
            $nodeshipmail->appendChild(new \DOMText($or->Shipping_EmailId));
            
            //Adding Total amt            
            $nodeamt=$schema->createElement('Total_Amt');
            $docket->appendChild($nodeamt);
            $nodeamt->appendChild(new \DOMText($or->Total_Amt));
            
            //Adding Mode
            $nodemode = $schema->createElement('Mode');            
            $docket->appendChild($nodemode);
            $nodemode->appendChild(new \DOMText('P'));
            
            //Adding collectable amount
            $nodecolamt = $schema->createElement('Collectable_amount');           
            $docket->appendChild($nodecolamt);
            $nodecolamt->appendChild(new \DOMText(0));
            
            //Adding Weight
            $nodewt = $schema->createElement('Weight');            
            $docket->appendChild($nodewt);
            $nodewt->appendChild(new \DOMText($or->Weight));
            
            //Adding UOM
            $nodeunit = $schema->createElement('UOM');
            $docket->appendChild($nodeunit);                    
            $nodeunit->appendChild(new \DOMText($or->UOM));

            //Chaning Type of service
            $nodetos = $schema->createElement('Type_of_Service');            
            $docket->appendChild($nodetos);
            $nodetos->appendChild(new \DOMText('Economy'));
            
            //Adding Vendor Name
            $nodevennm = $schema->createElement('VendorName');           
            $docket->appendChild($nodevennm);
            $nodevennm->appendChild(new \DOMText($or->VendorName));
            
            //Adding Vendor address1
            $nodevenaddr1 = $schema->createElement('VendorAddress1');           
            $docket->appendChild($nodevenaddr1);
            $nodevenaddr1->appendChild(new \DOMText($or->VendorAddress1));
            
            //Adding Vendor Address2
            $nodevenaddr2 = $schema->createElement('VendorAddress2');
            $docket->appendChild($nodevenaddr2);            
            $nodevenaddr2->appendChild(new \DOMText($or->VendorAddress2));
            
            //Adding Vendor Pincode
            $nodevenpin = $schema->createElement('VendorPincode');            
            $docket->appendChild($nodevenpin);
            $nodevenpin->appendChild(new \DOMText($or->VendorPincode));
            
            //Adding Vendor Tele no.
            $nodeventel = $schema->createElement('VendorTeleNo');
            $docket->appendChild($nodeventel);
            $nodeventel->appendChild(new \DOMText($or->VendorTeleNo));

            //Adding IsPUDO
            $nodeispudo = $schema->createElement('IsPUDO');            
            $docket->appendChild($nodeispudo);
            $nodeispudo->appendChild(new \DOMText('N'));
            
            //Adding Type of Delivery
            $nodetod = $schema->createElement('TypeOfDelivery');            
            $docket->appendChild($nodetod);
            $nodetod->appendChild(new \DOMText('HOME DELIVERY'));
            
            //Adding PUDO ID
            $nodepudoid = $schema->createElement('PUDO_Id');            
            $docket->appendChild($nodepudoid);
            $nodepudoid->appendChild(new \DOMText(''));
            
       }
      // print $schema->saveXML();
       
       $xmlbatch=$schema->saveXML();       
       yii::info("XML is generated.");
       return $xmlbatch;       
   }
   
   /*** Use this function to call DTDC API 
    *   PushOrderData_PUDO
    * **/ 
   public function DTDCpushOrderDataAPI($xmlbatch)
   {
       Yii::info("In OrdersController within function DTDCpushOrderDataAPI. Logged userid is:".Yii::$app->user->identity->id);
       $query=(new \yii\db\Query())
               ->select(['clientid', 'username', 'password'])
               ->from('dtdcsettings')                                      
               ->one();
                     
       //Calling PushOrderData_PUDO Method with its parameter
       $pushorderdataPUDOobj=new \frontend\models\PushOrderData_PUDO();
       $pushorderdataPUDOobj->ClientId=$query['clientid'];
       $pushorderdataPUDOobj->UserName=$query['username'];
       $pushorderdataPUDOobj->Password=$query['password'];
       $pushorderdataPUDOobj->xmlBatch=$xmlbatch;       //xmlbatch which is printed
       
       $dtdcapiclient=new \frontend\models\WsdlforDTDC();       
       \yii::info("Calling PushOrderData_PUDO API");
      
       $PUDOresponse=$dtdcapiclient->PushOrderData_PUDO($pushorderdataPUDOobj);
      // var_dump($PUDOresponse);
       $this->parse_response($PUDOresponse->PushOrderData_PUDOResult);  
   }

   /*** Use this function to parse response in XML returned 
    *   from PushOrderData_PUDO & returns back to Addorder()
    * **/ 
   public function parse_response($response)
   {
       Yii::info("In OrdersController within function parse_response. Logged userid is:".Yii::$app->user->identity->id);       
      
       $dtdcxmlresponse = new \SimpleXMLElement($response);
       $success=false;
      
      // var_dump($dtdcxmlresponse);

       foreach ($dtdcxmlresponse as $x)
       {
           $dtdcdetailsupdate=  \frontend\models\Dtdcdetails::find()->where(['AWBno'=>$x->DockNo])->one();
           if($x->Succeed=="Yes"){
                $dtdcdetailsupdate->status="Success";
           }
           else if($x->Succeed=="No"){
                $dtdcdetailsupdate->status="Failure";
           }           
           $dtdcdetailsupdate->reason=(string)$x->Reason;                    
            
          $success=$dtdcdetailsupdate->save();
          Yii::info("DTDC details are updated after calling API.");         
       }
   
       return;      
    }
}