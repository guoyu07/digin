<?php

namespace frontend\api\controllers;

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
       
        if($success)
        {            
            $result=["status"=>1,"error"=>''];   
        }        
        else
        {           
           $result=["status"=>0,"error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);
    }

    public function getImage($prid)
    {
        $url=$_SERVER['SERVER_NAME'];             
        $url1="http://".$url."/images/productimages/";
        $qry=(new \yii\db\Query())                 
                 ->select(['CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image'])
                 ->from('product p')
                 ->join('inner join', 'product_images i', 'i.prid=p.prid')
                 ->where(['p.prid'=>$prid,'i.ismain'=>1]);  
        $images=$qry->all();
        //var_dump($images);
        if(sizeof($images)>0) 
        {            
            return $images[0]['Image'];   
        }
        else{            
            return $url1."default_image.png";
        }
    }
    
    public function actionDisplaycart()
    {
       $userid=$_GET['userid'];
       //echo $userid."<br>"; 
       $url=$_SERVER['SERVER_NAME'];          
       $pincode =0;
       $type ='C';
       
       $shipfinal = array();
       $shipresult = array();
       $shiparray = array();
       $shipping = 0;
        $url1="http:/".$url."/images/productimages/";
                $query1 = (new \yii\db\Query())                           
                //->select(['p.prid','p.prodname', '("product") as type','CONCAT("'.$url1.'",if(i.image IN (NULL, ""),"default_image.png", CONCAT(p.prid,"/",i.image))) as Image', 'v.businessname', 'vp.vpid','vp.price', 'c.quantity','(c.quantity*vp.price) as total'])
                  ->select(['p.prid','p.prodname','v.businessname', 'vp.vpid','vp.price', 'c.quantity','(c.quantity*vp.price) as total'])
              
                ->from('vendor v')
                ->distinct()        
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')
                ->join('inner join', 'product p', 'p.prid=vp.prid')
                //->join('inner join', 'product_images i', 'i.prid=p.prid') 
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid') 
                //->join('inner join', 'address a',['a.userid'=>$userid])
                ->where(['c.userid'=>$userid]);
               //->andWhere(['i.ismain'=>1]);
               
        $product=$query1->all(); 
        //var_dump($product);
       /************for address id****************/
        if(isset($_GET['adrid']) &&($_GET['adrid']!='')){
         $adrid = $_GET['adrid'];   
        }
            $query2 = (new \yii\db\Query())
                             ->select(['a.adrid','a.address1','a.address2','a.city','a.state','a.country','a.pin'])
                             ->from('address a')
                             ->where(['a.userid'=>$userid]);
                            
            $product1 = $query2->all(); 
            //echo json_encode($product1);
        
         if(isset($adrid)&&($adrid!='')){
                $query3 = (new \yii\db\Query())
                         ->select(['a.pin'])
                         ->from('address a')
                         ->where(['a.userid'=>$userid])
                         ->andWhere(['a.adrid'=>$adrid]);
                
                $product2 = $query3->all(); 
               $pincode = $product2[0]['pin'];
               //echo 'pincode in if condition..:-'.$pincode;
            }
            else{ 
                $query3 =(new \yii\db\Query())
                            ->select(['a.pin'])
                            ->from('address a')
                            ->where(['a.userid'=>$userid])
                            ->orderBy('upddt DESC');

                   $product2 = $query3->all();
                   //var_dump($product2);
                   $pincode = $product2[0]['pin'];
               }
        //var_dump($pincode);
        $i=0;
        $shipfinal = $this->calshipmenttotal($pincode,$type,$userid);
        //var_dump($shipfinal);
        foreach ($product as $p){
            $shiparray['prid']= $p['prid'];
            $shiparray['prodname']= $p['prodname'];
            $shiparray['type']= $p['type'];
            $image=$this->getImage($p['prid']);                
            $shiparray['Image']=$image;
            $shiparray['businessname']= $p['businessname'];
            $shiparray['vpid']= $p['vpid'];
            $shiparray['price']= $p['price'];
            $shiparray['quantity']= $p['quantity'];
            $shiparray['total']= $p['total'];
            //$shipping = $this->calshipmenttotal($pincode,$type);
            //var_dump($shipping);
           // var_dump($shipping[$i][$p['vpid']]);
           $shiparray['shipping']= $shipfinal[$p['vpid']];
            $i++;
            //array_push($shipresult, $product1);
             array_push($shipresult, $shiparray);
        }
        array_push($shipresult, $product1);
        //array_push($shipresult,$shipfinal);
         //array_push($selected, array($product));  
        //echo json_encode($product);
        //echo json_encode($selected);
        //var_dump($shipping);
        echo json_encode($shipresult);
    }
    
    public function actionRemovefromcart() 
    {
        $userid=$_GET['userid'];
        $vpid=$_GET['vpid'];
        $result=array();
        $success=Cart::deleteAll(['userid'=>$userid, 'vpid'=>$vpid]);
        if($success)
        {
             $result=["status"=>1, "error"=>''];   
        }
        else{
            $result=["status"=>0, "error"=>'One or more parameter missing.'];   
        }
        echo json_encode($result);
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
  public function getUseritems($userid, $vpid)
    {
        $url=$_SERVER['SERVER_NAME'];
        $selected=array();        
        $product=array(); 
        if($userid!=""){
        $query1 = (new \yii\db\Query())                           
                ->select(['p.prid','p.prodname', 'vp.vid', 'vp.vpid', 'vp.price', '(c.quantity*vp.price) as total'])
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
    
   public function calshipmenttotal($pin,$type,$uid)
    {    $userid = $uid;
        //$pin=$_GET['pincode'];
        //$type=$_GET['type'];
        //$ip=$_GET['ip'];
        $pin = $pin;
        $type= $type;
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
            $items=$this->getUseritems($userid,"");
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
        $result = $address->showAddress($userid);  
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
        //var_dump($items);
        //var_dump($delivery);        
        foreach ($items as $i)
        { 
            $checkdelivery=$vendor->isDigindelivery($i['vid']);            
            //echo "<br>Digin delivery: ".$checkdelivery;
            //Checking of delivery that product is deliverable or not           
           $deliverable=$delivery[0][$i['vpid']];
 
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
       
            //$productweight=$vendorproduct['weight'];
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
            if($type=='B'){                 
                 $COF=round($_SESSION['buynow'][$i['vpid']]*$i['price'])*0.02; 
             } 
             else if($type=='C') {
                $COF=$i['total']*0.02; 
             }
            
            //$COF=$i['total']*0.02;   
            $shipmenttotal=$chargewithfuelsurcharge+$COF;
            $total=0;
            $total=round(($shipmenttotal*$servicetax)/100)+$shipmenttotal;
            Yii::info("Shipment total: ".$total); 
  
           // $shipment['vpid']=$i['vpid'];
//            $convertedprice=0;
//            $convertedprice=  $this->convertcurrency($i['vid'], $total,$ip); 
//            $shipment['shipping']=  $convertedprice;
            //$shipment['shipping']=  round($total);
           $shipment[$i['vpid']]=round($total);
//            if($type=='B'){
//                 $shipment['itemtotal']=round($_SESSION['buynow'][$i['vpid']]*$i['price']);
//             }  
//             else if($type=='C'){
//                 $shipment['itemtotal']=round($i['total']);  
//             }            
        }
        else{
            if($checkdelivery==1)
                Yii::info("Product is not deliverable, but Vendor has delivery.");
            if($checkdelivery==2) 
                Yii::info("Product is not deliverable & Vendor has self delivery.");
//           $shipment['vpid']=$i['vpid'];
//            $shipment['shipping']=0;
            $shipment[$i['vpid']]=0;
//            if($type=='B'){
//                 $shipment['itemtotal']=round($_SESSION['buynow'][$i['vpid']]*$i['price']);
//            }  
//            else if($type=='C') {
//                 $shipment['itemtotal']=round($i['total']);  
//             }
            //$shipment['itemtotal']=round($i['total']);  
        }
            array_push($shipping, $shipment); 
           
        }
        //var_dump($shipping);
        return $shipment;
        //array_push($shippingall,$shipping);
        //return $shippingall;
        //array_push($shippingall, $delivery[0]);
        //array_push($shippingall, $delivery[1]);
        //echo json_encode($shippingall);        
    }
    
}
