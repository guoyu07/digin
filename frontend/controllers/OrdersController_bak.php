<?php

namespace frontend\controllers;

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
    
    public function actionAddorders()
    {
        Yii::info("In OrdersController within action Addorders. Logged userid is:".Yii::$app->user->identity->id);
        $userid=Yii::$app->user->identity->id;
        $addrid=$_POST['adrid'];
        $ref=$_POST['ref'];           
        $shippingresult=$_POST['shipping'];
        
        $servicetax = \Yii::$app->params['tax'];
       
        $randomno=  uniqid();        
        $success1=false;
        $success2=false;
        $success3=false;
        $orderupdate=false;
        $result=array();
        
        $total=0;
        
        $sms=new \frontend\models\Smssetting();
       
        $order= new Orders();
        $order->displayid=uniqid();
        $order->userid=$userid;
        $order->adrid=$addrid;
        $order->transref=$ref;
        $order->total=0;
        $order->shipment=0;
        $order->grosstotal=0;
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
        $orderitem->shipment=0;
        $orderitem->grosstotal=0;
        $orderitem->crtdt=date('Y-m-d H:i:s');
        $orderitem->crtby=$userid;
        $orderitem->upddt=date('Y-m-d H:i:s');
        $orderitem->updby=$userid;       
        $total+=$orderitem->producttotal;
        $success2=$orderitem->save(false);
        }
        
        $totalshipment=0;
        $grosstotal=0;
        $shipping=0;
        
        foreach ($shippingresult as $s){
            $shipment=  explode('_', $s);           
            //$shipping=round(($shipment[1]*$servicetax)/100)+$shipment[1];
            $saveditems=  \backend\models\Orderitem::find()->where(['vpid'=>$shipment[0], 'orid'=>$order->orid])->one();
            $saveditems->shipment=$shipment[1];
            $saveditems->grosstotal=$saveditems['producttotal']+$shipment[1];
            $totalshipment+=$saveditems->shipment;
            
            $grosstotal+=$saveditems->grosstotal;
            $success3=$saveditems->save(false);           
        }
        
        if($success2 && $success3)
        {    
            Yii::info("Order is created successfully! Total shipping of order with service tax ".$servicetax."% is Rs.".$totalshipment);
            \backend\models\Cart::deleteAll();
        }                    
       
       
        $order->total=$total;
        $order->shipment=$totalshipment;
        $order->grosstotal=$grosstotal;
        $orderupdate= $order->save(false);
        $orderid=$order->displayid;
      
        $orderarray;
        $url=$sms->getUrl($orderid);
        $sms->sendMessage($url);  
        Yii::info("A message has been sent as: Your order is received successfully. We will deliver it very soon. Your order id is ".$orderid.". Thank you.");
        $orderarray=$this->getOrder($userid, $addrid, $orderid);
        //$this->sendMessage($url);
        $userdata=\dektrium\user\models\User::find()->select('email')->where(['id'=>Yii::$app->user->identity->id])->one();
        $email=$userdata['email'];
       
         \Yii::$app->mailer->compose('emailorder',['orderdetails'=>$orderarray])
                   ->setFrom('mail@digin.in')
                   ->setTo($email)
                   ->setBcc('mail@digin.in')
                   ->setSubject('Order Detail')
                   //->setTextBody($message)
                   //->setHtmlBody($emailhtml)                  
                   ->send();
        return $this->render('orderdetail', array('orderdetails'=>$orderarray));  
    }
    
   
    public function getOrder($userid,$addrid,$orderid)
    {
        $ordersdata=array();
        $orders=array();
        $orderitems=array();
        
        $url=$_SERVER['SERVER_NAME']; 
        $url1="http://".$url."/advanced/images/productimages/";
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
        $url1="http://".$url."/advanced/images/productimages/";
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
        //echo json_encode($ordersdata);
        return $this->render('orderdetail', array('orderdetails'=>$ordersdata));
        //return $this->render('emailorder', array('orderdetails'=>$ordersdata));
    }
    
   /* public function actionViewallorders()
    {
        $userid=$_GET['userid'];
        
        $ordersdata=array();
        $orders=array();
        $orderitems=array();
        
        $url=$_SERVER['SERVER_NAME']; 
        $url1="http:/".$url."/advanced/images/productimages/";
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
      return $this->render('order');
  }
}
