<?php

namespace frontend\controllers;

use Yii;
use backend\models\Cart;
use backend\models\CartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
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
     * Lists all Cart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
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
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cart model.
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
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAddtocart()
    {
        $userid=$_GET['userid'];
        $vpid=$_GET['vpid'];
        $qty=$_GET['quantity'];
        //echo $userid."......".$vpid."......".$qty."<br>";
        
        $success=false;
        $result=array();        
        
        $cart=  Cart::find()->where(['userid'=>$userid,'vpid'=>$vpid])->one();
        //var_dump($cartdata);
        if($cart == NULL)
        {
            $cart=new Cart();
        }
       
        $cart->userid=$userid;
        $cart->vpid=$vpid;        
        $cart->quantity=$qty;
        $cart->crtdt=date('Y-m-d H:i:s');
        $cart->crtby=$userid;
        $cart->upddt=date('Y-m-d H:i:s');
        $cart->updby=$userid;
       
        $success=$cart->save(false);
        $cart2=  Cart::find()->where(['userid'=>$userid])->all();
        if($success)
        {            
            $result=["status"=>1, "Total items"=>sizeof($cart2),"error"=>''];   
        }        
        else
        {           
           $result=["status"=>0, "Total items"=>sizeof($cart2), "error"=>'One or more parameter missing.'];   
        }
      
        echo json_encode($result);
    }
    
    public function actionDisplaycart()
    {   
        Yii::info("In CartController within action Displaycart. Logged userid is:".Yii::$app->user->identity->id);
//        $ip = 0;
//        if(isset($_GET['ip'])){
//             $ip = $_GET['ip'];
//        }
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect('index.php?r=login/login');
        }
        else{
        //$userid=$_GET['userid'];          
        $userid=Yii::$app->user->identity->id;      
        $url=$_SERVER['SERVER_NAME'];          
       
        $url1="https://".$url."/images/productimages/";
                $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.vid','v.businessname','vp.price','vp.vpid', 'c.quantity', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid') 
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')  
                //->join('inner join', 'cart c', 'c.vpid=p.prid')    
                ->where(['c.userid'=>$userid,'i.ismain'=>1]);       
               
        $product=$query1->all(); 
       // $productdata=$query1->all();        for currency
       //echo json_encode($product);  
        $address=new \frontend\models\Address();       
        $result = $address->showAddress($userid);
        //$pincodes=array();
        $delivery=array();       
        $items=array();
        $items=$this->getUseritems(Yii::$app->user->identity->id, ""); 
        //var_dump($result);
        //$result[0]['pin']=null;
        if(isset($result[0]['pin']) && $result[0]['pin']!=""){
            $delivery=$this->checkDelivery($items,$result[0]['pin']);
        }
        else{
            $delivery=$this->checkDelivery($items,null);
        }
        /*  For currency
         * 
          $cartdata=array();
          $product=array();
          $convertedprice=0;
         foreach ($productdata as $p){
                $cartdata['prid']=$p['prid'];
                $cartdata['prodname']=$p['prodname'];
                $cartdata['type']=$p['type'];
                $cartdata['Image']=$p['Image'];
                $cartdata['vid']=$p['vid'];
                $cartdata['businessname']=$p['businessname'];
                
                $convertedprice=  $this->convertcurrency($p['vid'], $p['price'],$ip);  
                
                //echo "<br>Price.......".$convertedprice;
                //$vendorarry['price']=$v['price'];
                $cartdata['price']=$convertedprice;
                $cartdata['vpid']=$p['vpid']; 
                $cartdata['quantity']=$p['quantity']; 
                $cartdata['total']=$p['total']; 
              array_push($product, $cartdata);
              // array_push($output, $vendorresult);
         }   */
        
        //var_dump($delivery);
        return $this->render('addtoCart',array('cart'=>$product, 'address'=>$result, 'delivery'=>$delivery));
        }
    }
    
    public function checkDelivery($items,$pin) 
    {       
       $vendor=  new \backend\models\Vendor(); 
       //$address=new \frontend\models\Address();
       $isdeliverable=array();
       $delivery=array();
       //$result = $address->showAddress(Yii::$app->user->identity->id);
       $isdelivery=null;
       
      //  if(sizeof($result)>0){
        foreach ($items as $i){
            $dppkgid=$vendor->getVendordppkgid($i['vid']);
            $dppkg=$vendor->getDeliveryPackage($dppkgid['dppkgid']);
            $checkdelivery=$vendor->isDigindelivery($i['vid']);
            $isdelivery=$checkdelivery;
            //echo $isdelivery;
            //echo "<br>Delivery Partner..".$dppkg["dpid"];
            //$servpins=  \backend\models\ServicablePincodes::find()->where(['dpid'=>$dppkg["dpid"], 'pincode'=>$result[0]['pin']])->all();                      
            $servpins=  \backend\models\ServicablePincodes::find()->where(['dpid'=>$dppkg["dpid"], 'pincode'=>$pin])->all();                      
            //echo sizeof($servpins);
             $isdeliverable[$i['vpid']]=$isdelivery;
            if(sizeof($servpins)>0){
              //$pincodes=['vpid'=>$i['vpid'], 'delivery'=>1]; 
              //$isdeliverable=[$i['vpid']=>1];             
              //array_push($delivery, $isdeliverable);
               $delivery [$i['vpid']]=1;                        
            } else {
                //$isdeliverable=[$i['vpid']=>0];
                //$pincodes=['vpid'=>$i['vpid'], 'delivery'=>0]; 
                //array_push($delivery, $isdeliverable);
                $delivery [$i['vpid']]=0;
              
                //array_push($delivery, [$i['vpid']=>0, 'isdelivery'=>$isdelivery]); 
            } 
           
        }
        $deliveryresult=[$delivery,$isdeliverable];
        
    //}
        return $deliveryresult;
    }
   
    
    public function actionAddandshowcart()
    {
        Yii::info("In CartController within action Addandshowcart. Logged userid is:".Yii::$app->user->identity->id);
        $userid=$_GET['userid'];
        $vpid=$_GET['vpid'];
        $qty=$_GET['quantity'];      //echo $userid."<br>"; 
        //echo $userid."......".$vpid."......".$qty."<br>";
        
        $success=false;
        $result=array();        
        
        $cart=  Cart::find()->where(['userid'=>$userid,'vpid'=>$vpid])->one();
        //var_dump($cartdata);
        if($cart == NULL)
        {
            $cart=new Cart();
        }
       
        $cart->userid=$userid;
        $cart->vpid=$vpid; 
        if($cart!=NULL){
            $cart->quantity=$cart['quantity']+$qty;
        }
        else{
            $cart->quantity=$qty;
        }
        $cart->crtdt=date('Y-m-d H:i:s');
        $cart->crtby=$userid;
        $cart->upddt=date('Y-m-d H:i:s');
        $cart->updby=$userid;
       
        $success=$cart->save(false);
        $cart2=  Cart::find()->where(['userid'=>$userid])->all();
   
              
        $url=$_SERVER['SERVER_NAME'];          
       
        $url1="https://".$url."/images/productimages/";
                $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.vid', 'v.businessname','vp.price','vp.vpid', 'c.quantity', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid') 
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')  
                //->join('inner join', 'cart c', 'c.vpid=p.prid')    
                ->where(['c.userid'=>$userid,'i.ismain'=>1]);       
               
        $product=$query1->all();  
        //$productdata=$query1->all();     for currency
       //echo json_encode($product);    
        $address=new \frontend\models\Address();
        $result = $address->showAddress($userid);        
         //var_dump($result);
        
        $delivery=array();       
        $items=array();
        $items=$this->getUseritems(Yii::$app->user->identity->id, ""); 
       
        if(sizeof($result)>0){
            $delivery=$this->checkDelivery($items,$result[0]['pin']);
        }else{
            $delivery=$this->checkDelivery($items,null);
        }
        
   /*   Code for currency
   *      $cartdata=array();
          $product=array();
          $convertedprice=0;
         foreach ($productdata as $p){
                $cartdata['prid']=$p['prid'];
                $cartdata['prodname']=$p['prodname'];
                $cartdata['type']=$p['type'];
                $cartdata['Image']=$p['Image'];
                $cartdata['vid']=$p['vid'];
                $cartdata['businessname']=$p['businessname'];
                
                $convertedprice=  $this->convertcurrency($p['vid'], $p['price'],$ip);  
                
                //echo "<br>Price.......".$convertedprice;
                //$vendorarry['price']=$v['price'];
                $cartdata['price']=$convertedprice;
                $cartdata['vpid']=$p['vpid']; 
                $cartdata['quantity']=$p['quantity']; 
                $cartdata['total']=$p['total']; 
              array_push($product, $cartdata);
              // array_push($output, $vendorresult);
         }  */
        return $this->render('addtoCart',array('cart'=>$product,  'address'=>$result, 'delivery'=>$delivery));
    }


    public function actionRemovefromcart() 
    {
        //$userid=$_GET['userid'];
        $userid=Yii::$app->user->identity->id;
        $vpid=$_GET['vpid'];
        $result=array();
        $success=Cart::deleteAll(['userid'=>$userid, 'vpid'=>$vpid]);
        if($success)
        {
             //$result=["status"=>1, "error"=>''];              
             return $this->redirect('index.php?r=cart/displaycart');
        }               
    }
    
    public function actionCart()
    {
        return $this->render('cart');
    }
    
    
    public function getUseritems($userid, $vpid)
    {
        $url=$_SERVER['SERVER_NAME'];
        $selected=array();        
        $product=array(); 
        if($userid!=""){
        $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', 'vp.vid', 'vp.vpid', 'vp.price','c.quantity as quantity', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
               // ->join('inner join', 'product_images i', 'i.prid=p.prid') 
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')           
                //->where(['c.userid'=>$userid,'i.ismain'=>1]); 
                ->where(['c.userid'=>$userid]); 
               
        $product=$query1->all(); 
        //array_push($selected, array($product));  
       }
       else if($vpid!=""){
           $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', 'vp.vid', 'vp.vpid', 'vp.price'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')                                    
                //->where(['c.userid'=>$userid,'i.ismain'=>1]); 
                ->where(['vp.vpid'=>$vpid]); 
               
           //$items=$query1->one();
           $product=$query1->one();
           //array_push($product, $items);
       }
        return $product;
    }

    public function actionShipmenttotal()
    {
        $pin=$_GET['pincode'];
        $type=$_GET['type'];
        //$ip=$_GET['ip'];
        
        Yii::info("In CartController within action Shipmenttotal. Logged userid is:".Yii::$app->user->identity->id);
        
        $items=array();
        if($type=='B'){
        if (isset($_SESSION["buynow"] )){
        foreach ($_SESSION["buynow"] as $key=>$value)
        {
            $baughtitems=  $this->getUseritems("", $key);
            //$items=  $this->getUseritems("", $key);
            array_push($items,$baughtitems);
        }}
        }
        //var_dump($items);
        if($type=='C'){
        if(sizeof($items)==0){
            $items=$this->getUseritems(Yii::$app->user->identity->id, "");
        }
        }
        $servicetax = \Yii::$app->params['tax'];
        
        $vendor=  new \backend\models\Vendor();
        $dp=  new \backend\models\DeliveryPartner();
        $shipping=array();
        $shipment=array();    
        $delivery=array();
        $shippingall=array();
        $deliverable=0;
        //$delivery=$this->checkDelivery($items);
        
        $address=new \frontend\models\Address();      
        $result = $address->showAddress(Yii::$app->user->identity->id);  
        if(sizeof($result)>0 && $result[0]['pin']==$pin){            
            $delivery=$this->checkDelivery($items, $result[0]['pin']);
            //$delivery=$this->checkDeliveryforother($items, $pin);            
        }
        else
        {
            //if($result[0]['pin']!=$pin){
                $delivery=$this->checkDelivery($items, $pin); 
            //}
        }
       
        //var_dump($delivery);        
        foreach ($items as $i)
        { 
            $checkdelivery=$vendor->isDigindelivery($i['vid']);            
            //echo "<br>Digin delivery: ".$checkdelivery;
            //Checking of delivery that product is deliverable or not           
           $deliverable=$delivery[0][$i['vpid']];
           
         if ($checkdelivery == 3)
          {
            //echo "<br>Item product total: ".$i['total'];
            $checkdelivery = $this->resolveSplDelieveryOption($i['vid'],$i['total']);   
            //echo "<br>Return Digin delivery: ".$checkdelivery;
          }
          
          if($checkdelivery==1 && $deliverable==1) 
            {
                //echo "<br>Calculating shipment....";
                 Yii::info("Product is deliverable & Vendor also has digin delivery. ");
                $vendorpin= $vendor->getVendorPincode($i['vpid']);            
                if($vendorpin[0]['pin']==0 || $vendorpin[0]['pin']=="")
                {                
                    $result=$dp->getApplicability("",$pin,$vendorpin[0]['city']);                
                     Yii::info("Applicable result is: ".$result);
                }
                else {                
                    $result=$dp->getApplicability($vendorpin[0]['pin'],$pin,"");                
                    Yii::info("Applicable result is: ".$result);
                }
            
            $vendorproduct=  \backend\models\VendorProducts::find()->where(['vpid'=>$i['vpid']])->one();
            
            $dppkgid=$vendor->getVendordppkgid($i['vid']);
            $dppkg=$vendor->getDeliveryPackage($dppkgid['dppkgid']);
            //For Normal rates
            $pkgrate= \backend\models\Packagerates::find()->where(['pkgid'=>$dppkg['id']])->one();
                    
            $deliverypartner=  \backend\models\DeliveryPartner::find()->where(['dpid'=>$dppkg['dpid']])->one();   
            
            //For Bulk rates
            $bulkpkgrates=  \backend\models\Bulkrates::find()->where(['pkgid'=>$dppkg['id']])->one();
            
            if (sizeof($bulkpkgrates)>0){
                $minimumwt=$bulkpkgrates['minimumweight'];             
                $bulkwtmultiple=$bulkpkgrates['weightmultiple'];
            }
            
            $rate=0;            
            $initialwt=$pkgrate['initialweight'];
            $wtmultiple=$pkgrate['addweightmultiple'];
            $addrate=0;
            $bulkrate=0;
            
            if($result=='City')
            {             
                $rate=$pkgrate['withincityrate'];
                $addrate=$pkgrate['addwithincityrate'];
                if (sizeof($bulkpkgrates)>0){
                    $bulkrate=$bulkpkgrates['withincityrate'];
                }
            }
            if($result=='Zone')
            {            
                $rate=$pkgrate['zonerate'];
                $addrate=$pkgrate['addzonerate'];
                if (sizeof($bulkpkgrates)>0){
                    $bulkrate=$bulkpkgrates['zonerate'];
                }
            }
            if($result=='Metro')
            {             
                $rate=$pkgrate['metrorate'];
                $addrate=$pkgrate['addmetrorate'];
                if (sizeof($bulkpkgrates)>0){
                    $bulkrate=$bulkpkgrates['metrorate'];
                }
            }
            if($result=='RoI-A')
            {            
                $rate=$pkgrate['RoIArate'];
                $addrate=$pkgrate['addRoIArate'];
                if (sizeof($bulkpkgrates)>0){
                    $bulkrate=$bulkpkgrates['RoIArate'];
                }
            }
            if($result=='RoI-B')
            {            
                $rate=$pkgrate['RoIBrate'];
                $addrate=$pkgrate['addRoIBrate'];
                if (sizeof($bulkpkgrates)>0){
                    $bulkrate=$bulkpkgrates['RoIBrate'];
                }
            }
            if($result=='Special Destination')
            {                          
                $rate=$pkgrate['spldestrate'];
                $addrate=$pkgrate['addspldestrate'];
                if (sizeof($bulkpkgrates)>0){
                    $bulkrate=$bulkpkgrates['spldestrate'];
                }
            }
                        
            
            $volumetricweight=(($vendorproduct['lenght']*$vendorproduct['height']*$vendorproduct['width'])/$deliverypartner['volwtdenominator'])*$i['quantity'];          
            $volumetricweight=round($volumetricweight,2);            
            $volumetricweight_ingm=$volumetricweight*1000;
       
            $productweight=$vendorproduct['weight']*$i['quantity'];
            if($vendorproduct['weightunit']==1){
                $productweight=$vendorproduct['weight']*1000;
            }
      
            $weight=$productweight;
            Yii::info("Product actual weight is:".$weight);
            if($volumetricweight_ingm > $productweight)
            {                
                $weight=$volumetricweight_ingm;
                Yii::info("Volumetric weight of product is greater that its actual weight. So product weight is: ".$weight);
            }
            
            $additionaltotal=0;
            
            if( sizeof($bulkpkgrates)>0 && $weight>$minimumwt) //$weight>$minimumwt &&
            {      
                Yii::info("In Bulk rate calculation.");                                          
                    $multiplier=$weight/$bulkwtmultiple;
                    $reminder=  fmod($weight, $bulkwtmultiple);      
                    if($reminder>0){
                        $additionaltotal=(intval($multiplier)+1)*$bulkrate;
                    }
                    else{
                        $additionaltotal=$multiplier*$bulkrate;
                    }              
                $basedeliverycharge=$additionaltotal;                
             }
              else{
                  Yii::info("In Normal rate calculation.");
                    $additionalwt=$weight-$initialwt;
                    if($additionalwt>0){
                        $multiplier=$additionalwt/$wtmultiple;
                        $reminder=  fmod($additionalwt, $wtmultiple);     
                        if($reminder>0){
                            $additionaltotal=(intval($multiplier)+1)*$addrate;
                        }
                        else{
                            $additionaltotal=$multiplier*$addrate;
                        }
                    }
                    $basedeliverycharge=$rate+$additionaltotal;
            }
            Yii::info("Base Delivery charge is: ".$basedeliverycharge);  
             
            $chargewithfuelsurcharge=$basedeliverycharge+$basedeliverycharge*($deliverypartner['fuelsurcharge']/100); 

            Yii::info("With Fuel Surcharge is: ".$chargewithfuelsurcharge); 
            if($type=='B'){                 
                 $COF=round($_SESSION['buynow'][$i['vpid']]*$i['price'])*0.02; 
             } 
             else if($type=='C') {
                $COF=$i['total']*0.02; 
             }
             Yii::info("COF is: ".$COF); 

            //$COF=$i['total']*0.02;   
            $shipmenttotal=$chargewithfuelsurcharge+$COF;
            $total=0;
               Yii::info("Service tax is: ".$servicetax); 

            $total=round(($shipmenttotal*$servicetax)/100)+$shipmenttotal;
            Yii::info("Shipment total: ".$total); 
  
            $shipment['vpid']=$i['vpid'];
//            $convertedprice=0;
//            $convertedprice=  $this->convertcurrency($i['vid'], $total,$ip); 
//            $shipment['shipping']=  $convertedprice;
            $shipment['shipping']=  round($total);
            
            if($type=='B'){
                 $shipment['itemtotal']=round($_SESSION['buynow'][$i['vpid']]*$i['price']);
             }  
             else if($type=='C'){
                 $shipment['itemtotal']=round($i['total']);  
             }            
        }
        else{
            if($checkdelivery==1)
                Yii::info("Product is not deliverable, but Vendor has delivery.");
            if($checkdelivery==2) 
                Yii::info("Product is not deliverable & Vendor has self delivery.");
            $shipment['vpid']=$i['vpid'];
            $shipment['shipping']=0;
            if($type=='B'){
                 $shipment['itemtotal']=round($_SESSION['buynow'][$i['vpid']]*$i['price']);
            }  
            else if($type=='C') {
                 $shipment['itemtotal']=round($i['total']);  
             }
            //$shipment['itemtotal']=round($i['total']);  
        }
            array_push($shipping, $shipment); 
           
        }
        array_push($shippingall,$shipping);
        array_push($shippingall, $delivery[0]);
        array_push($shippingall, $delivery[1]);
        echo json_encode($shippingall);        
    }
    
    
    public function actionAddaddress()
    {
        Yii::info("In CartController within action Addaddress. Logged userid is:".Yii::$app->user->identity->id);
        //var_dump($_POST);       
        $userid=Yii::$app->user->identity->id;
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
        
            
        $url=$_SERVER['SERVER_NAME'];          
       
        $url1="https://".$url."/images/productimages/";
                $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.vid','v.businessname','vp.price','vp.vpid', 'c.quantity', '(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid') 
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')                    
                ->where(['c.userid'=>$userid,'i.ismain'=>1]);       
               
        $product=$query1->all();         
       //echo json_encode($product);         
        
        $delivery=array();       
        $items=array();
        $items=$this->getUseritems($userid, ""); 
                
        //$delivery=$this->checkDelivery($items, $result[0]['pin']);
        if(sizeof($result)>0){
            $delivery=$this->checkDelivery($items,$result[0]['pin']);
        }else{
            $delivery=$this->checkDelivery($items,null);
        }
        //var_dump($delivery);
        return $this->render('addtoCart',array('cart'=>$product, 'address'=>$result, 'delivery'=>$delivery)); 
        //return $this->render('selectAddress',array('address'=>$result));
    }
    
    public function actionBuynow()
    {
        Yii::info("In CartController within action Buynow. Logged userid is:".Yii::$app->user->identity->id);
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect('index.php?r=login/login');
        }
        if(isset($_GET['vpid'])){
        $vpid=$_GET['vpid'];
        
            if ( !isset( $_SESSION["buynow"] ) ) {  
                $_SESSION["buynow"] = array();  
            }
            $buynow=$_SESSION["buynow"];
            if(isset($buynow[$vpid])){
            $_SESSION["buynow"][$vpid]+= 1;
            }else{
                $_SESSION["buynow"][$vpid]=1;
            }
        }                    
       // var_dump($_SESSION["buynow"]);
        $userid=Yii::$app->user->identity->id;  
        $url=$_SERVER['SERVER_NAME'];          
       
        $url1="https://".$url."/images/productimages/";
        $cartdata=array();
        foreach ($_SESSION["buynow"] as $key=>$value)
        {
            //echo $key."......".$value."<br>";        
            $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.vid','v.businessname','vp.price','vp.vpid'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid')                                                
                ->where(['vp.vpid'=>$key,'i.ismain'=>1]);     
               
           $product=$query1->one(); 
           array_push($cartdata, $product);
          // echo json_encode($product);
        }         
        $address=new \frontend\models\Address();       
        $result = $address->showAddress($userid);
        
        $delivery=array();       

        if(isset($result[0]['pin']) && $result[0]['pin']!=""){            
            $delivery=$this->checkDelivery($cartdata,$result[0]['pin']);
        }
        else{            
            $delivery=$this->checkDelivery($cartdata,null);
        }
        
        //var_dump($delivery);
        return $this->render('buynow',array('cart'=>$cartdata, 'address'=>$result, 'delivery'=>$delivery));
        
    }
    
    public function actionChangequantity()
    {  
        Yii::info("In CartController within action Changequantity. Logged userid is:".Yii::$app->user->identity->id);
        $vpid=$_GET['vpid'];
        $qty=$_GET['quantity'];
        $session = Yii::$app->session;
        // var_dump($session);
        $buynow = $session['buynow'];
        //var_dump($buynow);
        $message='';
        foreach ($buynow as $key=>$value)
        {
             if($key==$vpid){
                  $buynow[$vpid]=$qty;
                  if($qty>$value){
                      $message="Quantity is increased by 1.";
                  }
                  else{
                      $message="Quantity is decreased by 1.";
                  }
             }
        }
        $session['buynow']=$buynow;
        echo $message;
    }
    
    public function actionRemoveitem()
    {
        Yii::info("In CartController within action Changequantity. Logged userid is:".Yii::$app->user->identity->id);
        $vpid=$_GET['vpid'];
        
        $session = Yii::$app->session;       
        $buynow = $session['buynow'];      
        $message='';
        foreach ($buynow as $key=>$value)
        {
             if($key==$vpid){                  
                  unset($buynow[$vpid]);
                  if (isset($buynow[$vpid])){
                      $message=0;
                  }
                  else{
                      $message=1;
                  }
             }
        }
        $session['buynow']=$buynow;
        echo $message;
    }
    
    public function actionAddressforbuynow()
    {
        Yii::info("In CartController within action Addressforbuynow. Logged userid is:".Yii::$app->user->identity->id);
        //var_dump($_POST);       
        $userid=Yii::$app->user->identity->id;
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
        
            
        $url=$_SERVER['SERVER_NAME'];          
       
        $url1="https://".$url."/images/productimages/";
        $session = Yii::$app->session;       
        $buynow = $session['buynow'];      
        $items=array();
        foreach ($buynow as $key=>$value)
        {
             $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', '("product") as type','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.vid','v.businessname','vp.price','vp.vpid'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                ->join('inner join', 'product_images i', 'i.prid=p.prid')                                                
                ->where(['vp.vpid'=>$key,'i.ismain'=>1]);     
               
           $product=$query1->one(); 
           array_push($items, $product);
        }         
        $session['buynow']=$buynow;
         
        $delivery=array();       
   
        if(sizeof($result)>0){
            $delivery=$this->checkDelivery($items,$result[0]['pin']);
        }else{
            $delivery=$this->checkDelivery($items,null);
        }
        //var_dump($delivery);       
        return $this->render('buynow',array('cart'=>$items, 'address'=>$result, 'delivery'=>$delivery));
    }
    
    
    /***** For Currency Conversion
     * Sheetal's code
     */
    public function convertcurrency($vid,$price,$ip){         
         $ip1 = $ip;
         $amt = $price;
         $vendorprice=null;
         $amount = urlencode($amt);
        /**************vendor*****************/
         $venid = \backend\models\Vendor::find()->where(['vid'=> $vid])->one();        
         $venstate = \frontend\models\States::find()->where(['name'=> $venid['state']])->one();
         $vencountry = \backend\models\CountryCurrency::find()->where(['country_id'=> $venstate['country_id']])->one();
         $vencur = \backend\models\Currency::find()->where(['id'=> $vencountry['currency_id']])->one();
         $from_Currency = urlencode($vencur['currency_code']);
         //echo 'From....'.$from_Currency.'<br>';
         
         /**************Buyer*****************/
                
        $addr_details = unserialize(file_get_contents("https://www.geoplugin.net/php.gp?ip=$ip1"));
        $city = stripslashes(ucfirst($addr_details['geoplugin_city']));
        $countrycode = stripslashes(ucfirst($addr_details['geoplugin_countryCode']));
        $country = stripslashes(ucfirst($addr_details['geoplugin_countryName']));
       /* echo $city;
        echo $countrycode;
        echo $country;*/
         
         $cntryid = \frontend\models\Countries::find()->where(['sortname' => $countrycode])->one();
         $cntrycrrn = \backend\models\CountryCurrency::find()->where(['country_id' => $cntryid['id']])->one();
         $burcurrency = \backend\models\Currency::find()->where(['id' => $cntrycrrn['currency_id']])->one();
         $to_Currency = $burcurrency['currency_code'];
         $sign = $burcurrency['currency_sign'];
         //echo 'to...'.$to_Currency.'<br>';
         
      if($from_Currency !=  $to_Currency ){
                 $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");  
                  $get = explode("<span class=bld>",$get);       
                ///var_dump($get);
                 if (isset($get[1])) {
                  $get = explode("</span>",$get[1]);  
                 
                 }else{
                    $get ='INR' ;
               }
             
              $converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
                 
              $vendorprice= $converted_amount;
               // echo 'ammount..'.$vendorprice;
      }
      else{
                  $vendorprice = $price;  
                }

               // echo "Converted..........".$vendorprice;
      return ($vendorprice."-".$to_Currency."-".$sign);
    }
    
    public function actionGeneratehash()
    {
        $key=$_GET['key'];              
        $txnid=$_GET['txnid'];
        $amount=$_GET['amount'];
        $productinfo=$_GET['productinfo'];
        $firstname=$_GET['firstname'];
        $email=$_GET['email'];
        $salt=$_GET['salt'];
        
        $posted = array();
        $posted['key']=$key;
        $posted['txnid']=$txnid;
        //$posted['hash']='';
        $posted['amount']=$amount;
        $posted['firstname']=$firstname;
        $posted['email']=$email;
      //  $posted['phone']=$p;
        $posted['productinfo']=$productinfo;
      //  $posted['surl']='https://www.google.co.in/';
      //  $posted['furl']='https://in.yahoo.com/';
        $posted['service_provider']='payu_paisa';
        $hash = '';
        // Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';	
            foreach($hashVarsSeq as $hash_var) {
          $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
          $hash_string .= '|';
        }

        $hash_string .= $salt;


        $hash = strtolower(hash('sha512', $hash_string));
        echo $hash;
    }
    
    public function actionAddshippingtosession()
    {
        Yii::info("In CartController within action Addshippingtosession. Logged userid is:".Yii::$app->user->identity->id);
        $shippingresult=$_GET['shipping'];
        //echo json_encode($shippingresult);
        
        if ( !isset( $_SESSION["shipping"]) ) {  
             $_SESSION["shipping"] = array();  
        }
        $_SESSION["shipping"] = $shippingresult;
        if(isset($_SESSION["shipping"]) && $_SESSION["shipping"]!="")
            echo "1";
        else
            echo "0";
        //echo json_encode($_SESSION["shipping"]);
    }
    
    public function ResolveSplDelieveryOption($vid,$itemtotal)
    {
        $spdlopn = \backend\models\SpecialDeliveryOption::findOne(['vid'=>$vid]);
                if($spdlopn['delivery_limit']=='City'){
                  $getvencity = $vendor->getVendorCity($vid);
                  $getdlvrcity = $vendor->getDeliveryCity(Yii::$app->user->identity->id);  
                if($getvencity==$getdlvrcity){
                  return 2;
                }else{
                   return $spdlopn['rest_all']; 
                }
               }else if($spdlopn['delivery_limit']=='Country'){
                  $getvencountry = $vendor->getVendorCountry($vid);
                  $getdlvrcountry = $vendor->getDeliveryCountry(Yii::$app->user->identity->id);
                  if($getvencountry==$getdlvrcountry){
                     return 2;
                   }else{
                      return $spdlopn['rest_all']; 
                   }
               }else if($spdlopn['delivery_limit']=='Kms'){
                  $getvenpin = $vendor->getVendorPin($vid);
                  $getdlvrpin = $vendor->getDeliveryPin($vid);
                  $distance  = $this->getDistance($getvenpin,$getdlvrpin);
                  if($distance < $spdlopn['km_radius'] && $itemtotal > $spdlopn['min_order_val']){
                      return 2;
                  }else if($distance > $spdlopn['km_radius'])
                  {
                      return $spdlopn['rest_all']; 
                  }
                  
               }
               
    }
    
  public function getLnt($zip){
	
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false&Key=AIzaSyD_qpzDaIVNke4z3Xem4YvX6Yt1eFbVULE";
	$result_string = file_get_contents($url);
	$result = json_decode($result_string, true);
	$result1[]=$result['results'][0];
	$result2[]=$result1[0]['geometry'];
	$result3[]=$result2[0]['location'];
	
	return $result3[0];

  }

public function getDistance($zip1, $zip2, $unit="K"){
	
	$first_lat = getLnt($zip1);
	$next_lat = getLnt($zip2);
	
	$lat1 = $first_lat['lat'];
	$lon1 = $first_lat['lng'];
	
	$lat2 = $next_lat['lat'];
	$lon2 = $next_lat['lng'];	
	
	$theta=$lon1-$lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
			cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
			cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);
	
	if ($unit == "K"){
		return ($miles * 1.609344)." KM";
	}
	else if ($unit =="N"){
		return ($miles * 0.8684)." Miles";
	}
	else{
		return $miles." Miles";
	}
	
}
 
   
}
