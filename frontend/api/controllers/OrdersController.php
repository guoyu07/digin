<?php

namespace frontend\api\controllers;

use Yii;
use backend\models\Orders;
use backend\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                    'createorder' => ['post','get'],
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
    
   /* public function actionCreateorder()
    {
        $userid=$_GET['userid'];
        $addrid=$_GET['adrid'];
                  
        $success1=false;
        $success2=false;
        $orderupdate=false;
        $result=array();
        
        $total=0;
        
        $order= new Orders();
        $order->displayid=uniqid();
        $order->userid=$userid;
        $order->adrid=$addrid;        
        $order->total=0;
        $order->status='Pending';
        $order->crtdt=date('Y-m-d H:i:s');
        $order->crtby=$userid;
        $order->upddt=date('Y-m-d H:i:s');
        $order->updby=$userid;
        $success1=$order->save(false);
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
            $orderitem->crtdt=date('Y-m-d H:i:s');
            $orderitem->crtby=$userid;
            $orderitem->upddt=date('Y-m-d H:i:s');
            $orderitem->updby=$userid;       
            $total+=$orderitem->producttotal;
            $success2=$orderitem->save(false);
        }                        
       
        $order->total=$total;
        $orderupdate= $order->save(false);
        
        if($orderupdate)
        {
            $result=["status"=>1, "orderid"=>$order->displayid,"error"=>''];   
        }
        else
        {           
           $result=["status"=>0, "orderid"=>"", "error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);  
    }*/

   /* public function actionAddorders()
    {
        $userid=$_GET['userid'];
        $addrid=$_GET['adrid'];
        $ref=$_GET['ref'];    
               
        $orderupdate=false;
        $result=array();
        
         /*$total=0;
        
       $order= new Orders();
        $order->displayid=uniqid();
        $order->userid=$userid;
        $order->adrid=$addrid;
        $order->transref=$ref;
        $order->total=0;
        $order->crtdt=date('Y-m-d H:i:s');
        $order->crtby=$userid;
        $order->upddt=date('Y-m-d H:i:s');
        $order->updby=$userid;
        $success1=$order->save(false);
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
        $orderitem->crtdt=date('Y-m-d H:i:s');
        $orderitem->crtby=$userid;
        $orderitem->upddt=date('Y-m-d H:i:s');
        $orderitem->updby=$userid;       
        $total+=$orderitem->producttotal;
        $success2=$orderitem->save(false);
        }
        if($success2)
        {          
            \backend\models\Cart::deleteAll();
        }                    
       
        $order->total=$total;
        $orderupdate= $order->save(false);
        */
       /* \backend\models\Cart::deleteAll(['userid'=>$userid]);
        $order=  Orders::find()->where(['userid'=>$userid, 'adrid'=>$addrid])->one();
        $order->transref=$ref;
        $order->status='Confirm';
        $order->upddt=date('Y-m-d H:i:s');
        //var_dump($order->attributes);
        $orderupdate=$order->save(false);
        if($orderupdate)
        {
            $result=["status"=>1, "orderid"=>$order->displayid,"error"=>''];   
        }
        else
        {           
           $result=["status"=>0, "orderid"=>"", "error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);    
    }*/
    
    
    public function actionVieworders()
    {
        
        $userid=$_GET['userid'];
        $addrid=$_GET['adrid'];
        $orderid=$_GET['orderid'];
        
        $ordersdata=array();
        $orders=array();
        $orderitems=array();
        
        $url=$_SERVER['SERVER_NAME']; 
        $url1="http:/".$url."/images/productimages/";
        $query1 = (new \yii\db\Query())   
               ->select(['orid','userid', 'displayid', 'transref', 'total'])
               ->from('orders')
               ->where(['userid'=>$userid])
               ->andWhere(['displayid'=>$orderid]);
        $order=$query1->all(); 
        //echo json_encode($order);
        $query = (new \yii\db\Query())   
               ->select(['name','email', 'phone', 'address1', 'address2', 'city', 'state', 'country', 'pin'])
               ->from('address')
               ->where(['userid'=>$userid])
               ->andWhere(['adrid'=>$addrid]);
        $address=$query->all();        
        
        foreach ($order as $or){
           // $orderitem=  \backend\models\Orderitem::find()->where(['orid'=>$or['orid']])->all();
             $query1 = (new \yii\db\Query())                           
                    ->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname','i.ismain'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                    ->join('inner join', 'product p', 'p.prid=vp.prid')
                    ->join('inner join', 'product_images i', 'i.prid=p.prid') 
                    ->join('inner join', 'orderitem o','o.vpid=vp.vpid')
                    ->where(['orid'=>$or['orid']])
                    ->andWhere(['ismain'=>1]);
             $orderitem=$query1->all();     
        }  
        
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
        
            // echo json_encode($orderitems); 
       array_push($ordersdata, $order);
       array_push($ordersdata, $address);
       array_push($ordersdata, $orderitems); 
       echo json_encode($ordersdata);
    }
    
   public function actionViewallorders()
   {
         $userid=$_GET['userid'];
         $query1 = (new \yii\db\Query())   
               ->select(['(displayid) AS Order_No','Status','DATE_FORMAT(crtdt,\'%d-%m-%Y\') AS Date','Total'])
               ->from('orders')
               ->where(['userid'=>$userid]);
        $order=$query1->all();
        echo json_encode($order);
   }
    
//   public function actionViewallorders()
//    {
//        $userid=$_GET['userid'];
//        
//        $ordersdata=array();
//        $orders=array();
//        $orderitems=array();
//        
//        $url=$_SERVER['SERVER_NAME']; 
//        $url1="http:/".$url."/images/productimages/";
//        $query1 = (new \yii\db\Query())   
//               ->select(['orid','userid', 'displayid', 'transref', 'total'])
//               ->from('orders')
//               ->where(['userid'=>$userid]);
//        $order=$query1->all(); 
//           
//        foreach ($order as $or){
//           // $orderitem=  \backend\models\Orderitem::find()->where(['orid'=>$or['orid']])->all();
//             $query1 = (new \yii\db\Query())                           
//                    ->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname'])
//                    ->from('vendor v')
//                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
//                    ->join('inner join', 'product p', 'p.prid=vp.prid')
//                    ->join('inner join', 'product_images i', 'i.prid=p.prid')                     
//                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
//                    ->where(['orid'=>$or['orid']]);                    
//             $orderitem=$query1->all();             
//            foreach ($orderitem as $i)
//            {  
//                $orders['orid']=$i['orid'];
//                $orders['vpid']=$i['vpid'];
//                $orders['rate']=$i['rate'];
//                $orders['quantity']=$i['quantity'];
//                $orders['producttotal']=$i['producttotal'];
//                $orders['prodname']=$i['prodname'];
//                $orders['Image']=$i['Image'];
//                $orders['businessname']=$i['businessname'];
//                array_push($orderitems, $orders);                
//            }            
//        }       
//        array_push($ordersdata, $order);
//        array_push($ordersdata, $orderitems);
//      
//        echo json_encode($ordersdata);
//    }
//    

 public function actionCreateorder()
  {

    

      $addrid=Yii::$app->request->get('adrid');
      $userid =Yii::$app->request->get('userid');
      
      $total=0;
      $vparray = array();
      $shiparray = array();
     
      $shiparray = Yii::$app->request->get('shipping');
      //var_dump($shiparray);
   
 
        $i=0;
        $totalproorder = 0;
        $totalshiprate = 0;
        $totalshipment=0;
        $grosstotalorder=0;
        $additionldt= array();
        $useinfo = array();
        $finalresult = array();
        $useinfoother = array();
        
        
        $order= new Orders();
        $order->displayid=uniqid();
        $order->userid=$userid;
        $order->adrid=$addrid;
        $order->transref=uniqid();
        $order->total=0;
        $order->shipment=0;
        $order->grosstotal=0;    
        $order->status='Payment Pending';
        //$order->errorcode = 'Ehn';
        //$order->payumoneyid = 0;
        $order->crtdt=date('Y-m-d H:i:s');
        $order->crtby=$userid;
        $order->upddt=date('Y-m-d H:i:s');
        $order->updby=$userid;
        $success1=$order->save(false);
         
      
        $query1 = (new \yii\db\Query())                           
                ->select(['c.vpid', 'quantity','vp.price', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                  
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')           
                ->where(['c.userid'=>$userid]);                      
        $cart=$query1->all(); 
       
        //var_dump($cart);
        foreach ($cart as $c){
            
        //var_dump($shiparray[$c['vpid']]);
        //var_dump($c['vpid']);
        $orderitem=new \backend\models\Orderitem();
        $orderitem->orid=$order->orid;
        $orderitem->vpid=$c['vpid'];
        $orderitem->rate=$c['price'];
        $orderitem->quantity=$c['quantity'];
        $orderitem->producttotal=$c['total'];
          $orderitem->shipment=$shiparray[$c['vpid']];
        $orderitem->grosstotal=$c['total']+$shiparray[ $orderitem->vpid];
        $orderitem->crtdt=date('Y-m-d H:i:s');
        $orderitem->crtby=$userid;
        $orderitem->upddt=date('Y-m-d H:i:s');
        $orderitem->updby=$userid;       
        $total+=$orderitem->producttotal;
        $totalshiprate = $totalshiprate + $shiparray[ $orderitem->vpid];/***Total for shipment in orders****/
        $totalproorder = $totalproorder + $c['total'];/**product total for orders*/
        $success2=$orderitem->save(false);
        $i++;
        }
        
        $orderdata = \backend\models\Orders::find()->where(['orid'=>$order->orid])->one();
        $orderdata->shipment = $totalshiprate;
        $orderdata->total = $totalproorder;
        $orderdata->grosstotal = $totalshiprate + $totalproorder;
        $orderdata->save(false);
       //}
       $query2 = (new \yii\db\Query())
                ->select(['p.prodname'])
                ->from('vendor_products vp')
                ->join('inner join', 'product p', 'p.prid=vp.prid')                  
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')           
                ->where(['c.userid'=>$userid]);                      
        $productinfo = $query2->all(); 
        //echo json_encode($finalresult);
        $query3 = (new \yii\db\Query())
                ->select(['userid','name','email','phone'])
                ->from('address')
                ->where(['userid'=>$userid]);
        $useinfo = $query3->one();
        $orderdata = \backend\models\Orders::find()->where(['orid'=>$order->orid])->one();
      
        $output = array();
        array_push($output, $productinfo);
        array_push($finalresult,["userid"=>$useinfo['userid'], "firstname"=>$useinfo['name'], "email"=>$useinfo['email'], "phone"=>$useinfo['phone'],'transref'=>$orderdata->transref,'addrid'=>$addrid,'ammount'=>$orderdata->grosstotal,'type'=>'C']);
        array_push($output, $finalresult);
        //$finalresult=["productinfo"=>json_encode($productinfo),"userid"=>$useinfo['userid'], "firstname"=>$useinfo['name'], "email"=>$useinfo['email'], "phone"=>$useinfo['phone'],'txtid'=>$orderdata->transref,'addrid'=>$addrid,'ammount'=>$orderdata->grosstotal,'type'=>'C'];
        //array_push($finalresult,['Productinfo'=>[$productinfo,$useinfo,$useinfoother]]);
        echo json_encode($output);
  }
  
 public function actionAddorders()
  {
       $session = Yii::$app->session;
       //$userid=Yii::$app->user->identity->id;
        
        $ref=$_POST['transref'];
        $addrid=$_POST['adrid'];
        $type=$_POST['type'];
        $status=$_POST['status'];
        $error=$_POST['error'];
        $payuid=$_POST['payuMoneyId'];
        $userid = $_POST['userid'];

       //echo json_encode($_POST); 
                
        $sms=new \frontend\models\Smssetting();
         
        $order=  Orders::find()->where(['transref'=>$ref])->one();
        //var_dump($order);

        $orderid=$order['displayid'];

      
        if($status=='success')
        {
            $order->status=$status;
            $order->errorcode=$error;
            $order->payumoneyid=$payuid;
            $order->save(false);
            Yii::info("Order is confirmed by PayUmoney successfully!");
        }
       
        $orderarray=array();
        $address=  \frontend\models\Address::find()->where(['adrid'=>$addrid])->one();
        $phone=$address['phone'];
        $url=$sms->getUrl($orderid, $phone);
        $sms->sendMessage($url);  
        Yii::info("A message has been sent as: Your order is received successfully. We will deliver it very soon. Your order id is ".$orderid.". Thank you.");
        $orderarray=$this->getOrder($userid, $addrid, $orderid,null);
        
        $dpemails=array();
        $dpdata=array();
        $vpid=array();
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
            //echo $dpkey.".....".$dpval."<br>";
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
        
        //$this->sendMessage($url);
        //$userdata=\dektrium\user\models\User::find()->select('email')->where(['id'=>Yii::$app->user->identity->id])->one();        
        //$email=$userdata['email'];
        $email=$address['email'];
       
         \Yii::$app->mailer->compose('emailorder',['orderdetails'=>$orderarray, 'showtotal'=>true])
                   ->setFrom('mail@digin.in')
                   ->setTo($email)
                   ->setBcc('mail@digin.in')
                   ->setSubject('Order Detail : '.$orderid)
                   //->setTextBody($message)
                   //->setHtmlBody($emailhtml)                  
                   ->send();
         $result =array();
         array_push($result,['Status'=>$status,'Order_id'=>$orderid]);
           echo json_encode($result);
           
     /*************Delete From completed when order created properly**************/
        //if($userid= Yii::$app->user->identity->id){
            
        \backend\models\Cart::deleteAll(['userid'=>$userid]);
      //}
   }
    
    
  public function getOrder($userid,$addrid,$orderid,$vpid)
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
           // $orderitem=  \backend\models\Orderitem::find()->where(['orid'=>$or['orid']])->all();
             $query1 = (new \yii\db\Query())                           
                    //->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname', 'o.shipment'])
                    ->select(['orid', 'o.vpid', 'rate', 'quantity', 'producttotal' ,'p.prodname', 'v.businessname', 'o.shipment'])
                    ->from('vendor v')
                    ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                    ->join('inner join', 'product p', 'p.prid=vp.prid')
                    //->join('inner join', 'product_images i', 'i.prid=p.prid')                     
                    ->join('inner join', 'orderitem o', 'o.vpid=vp.vpid')
                    ->where(['orid'=>$or['orid']]);
             if(isset($vpid)){
               $query1->andWhere(['o.vpid'=>$vpid]);
             }
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
                array_push($orderitems, $orders);                
            }            
        }       
        array_push($ordersdata, $order);
        array_push($ordersdata, $address);
        array_push($ordersdata, $orderitems);
      
        return $ordersdata;      
    }
    
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
  
//   public function beforeAction($action)
//    {            
//   // if($action->id=='createorder')
//    //{
//        if (parent::beforeAction($action)) {
//        $this->enableCsrfValidation = false;
//        Yii::$app->getRequest()->validateCsrfToken()= true;
//        //Yii::app()->request->enableCsrfValidation = false;
//    //}
//      //echo $this->enableCsrfValidation;
//        }
//    return false;
//    }
}
