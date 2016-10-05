<?php

namespace backend\controllers;

use Yii;
use backend\models\Orderitem;
use backend\models\OrderitemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;


/**
 * OrderitemController implements the CRUD actions for Orderitem model.
 */
class OrderitemController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index','create', 'update', 'delete'],
                'rules' => [
                    /*[
                        'actions' => ['create','index', 'update', 'delete'],
                        'allow' => true,
                        //'roles' => ['Superadmin','Admin','Executive','Vendor'],
                        'roles' => ['*'],
                    ], */
                    [
                        //'actions' => ['view', 'search'],
                        'allow' => true,
                        'roles' => ['?', '*', 'Superadmin','Admin','Executive','Franchisee Manager','Franchisee Executive'],
                    ],
                      [
                        'actions' => ['update','index','create'],
                        'allow' => true,
                        'roles' => ['Vendor'],
                        
                    ],
                   
                ],
            ],
        ];
    }

    /**
     * Lists all Orderitem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderitemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orderitem model.
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
     * Creates a new Orderitem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orderitem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->oritemid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orderitem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->oritemid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orderitem model.
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
     * Finds the Orderitem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orderitem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orderitem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDeliverypin()
    {
      $orid = $_POST['orderitemid'];
       if(isset($_POST['dlvrpin'])){
          $dvlrpn=$_POST['dlvrpin'];
         $dvrpin = Orderitem::find()->where(['oritemid'=>$orid])->one();
         if($dvrpin['delivery_pin']==$dvlrpn){
            $uporitemsts = \backend\models\Orderitem::findOne($orid);
            $uporitemsts->delivery_status = 'Delivered';
            $uporitemsts->update();
         }else{
             $uporitemsts = \backend\models\Orderitem::findOne($orid);
            $uporitemsts->delivery_status = 'Peding Delivery';
            $uporitemsts->update();
         }
        }
        return $this->redirect(['orderitem/paymentrpt']);
    }
    
     public function actionPaymentrpt()
    {
         
        $userid = Yii::$app->user->identity->id;
        $model = new Orderitem();
        $searchModel = new OrderitemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        
        return $this->render('paymentreport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
        //return $this->render('paymentreport');
    }
     public function actionSaveitempay()
     {
        
         $intarrselc = array();
         $split = array();
         if(isset($_POST['selection'])){
         $intarrselc = $_POST['selection'];
         $split = split(',',$intarrselc);
         
         
           foreach($split as $as){
                $orderitem = Orderitem::findOne(['oritemid'=>$as]);
                $uporitem =  \backend\models\Orderitem::findOne(['oritemid'=>$as]);
                $uporitem->paid_to_vendor = 1;
                $uporitem->vendor_pay_date = date('Y-m-d H:i:s');
                $uporitem->update();
             }
             Yii::$app->getSession()->setFlash('success', 'Record saved successfully..!');
         }
        
        $model = new Orderitem();
        $searchModel = new OrderitemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         return $this->render('paymentreport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
     }
    
   public function actionExport()
   {     
      
       //var_dump($_GET['OrderitemSearch']['vendor_pay_date']);
       //var_dump($_GET['OrderitemSearch']['status']);
      
      $vennm = $_GET['OrderitemSearch']['vendor'];
      $stst = $_GET['OrderitemSearch']['status'];
      
      if($stst==1){
        $stst = 1;  
      }else{
          $stst = 0;
      }
      $paydate = $_GET['OrderitemSearch']['vendor_pay_date'];
      $paysplit = split('_', $paydate);
      
      //$srdate = $_GET['OrderitemSearch']['crtdt'];
      //$srdatesplit = split('_', $srdate);
      //var_dump($stst);
     // $loginvendor = Yii::$app->user->identity->id;
       $expdata=array();
       $data=array();

       //'v.account_no as Account_no','v.account_name as Account Name','v.bank_name as Bank Name','v.ifsc_code as IFSC_Code',
       $query=(new \yii\db\Query()) 
               ->select(['v.vid','oi.vpid','v.businessname as Vendor_Name','o.displayid','oi.vendor_pay_date as Payment_date','oi.shipment','oi.producttotal as Payment','oi.paid_to_vendor as Payment_Status','oi.crtdt as Order_date','CONCAT(a.name,",",a.address1,",",a.address2,",",a.city,",",a.country) AS Delivery_details'])
               ->from('vendor_products vp')
               ->join('inner join','orderitem oi','vp.vpid=oi.vpid')
               ->join('inner join','vendor v','v.vid=vp.vid')
               ->join('inner join','orders o','o.orid=oi.orid')
               ->join('inner join','address a','a.adrid=o.adrid')
               //->orderBy('Vendor_Name asc')
               ->where("oi.vendor_pay_date>='$paysplit[0]' AND oi.vendor_pay_date<='$paysplit[1]'")
               ->andWhere(['oi.paid_to_vendor'=>$stst])
               ->andWhere(['like', 'v.businessname',$vennm]);
               //->andWhere("oi.crtdt>='$srdatesplit[0]' AND oi.crtdt<='$srdatesplit[1]'");
        $data=$query->all();
        //var_dump($data);
        foreach ($data as $dt){
            $exp=new \backend\models\Exportpaymntrpt();
            $exp->order_No=$dt['displayid'];
            $vid = \backend\models\VendorProducts::findOne(['vpid'=>$dt['vpid']]);
            $pln = \backend\models\Vendor::findOne(['vid'=>$vid['vid']]);
            $exp->vendor_name = $pln['businessname'];
            $exp->payment_Date=$dt['Payment_date'];
            $exp->shipment_Cost = $dt['shipment'];
            $exp->payment = $dt['Payment'];
            if($dt['Payment_Status']==1){
            $exp->payment_Status = 'Paid';
            }else{
               $exp->payment_Status = 'Pendding';
            }
//            
            $dgncmsn = \backend\models\Plan::findOne(['id'=>$pln['plan']]);
            $comm=$dgncmsn['digin_commision']*$dt['Payment']/100;
            $exp->digin_Commission = $comm.' '.'('.$dgncmsn['digin_commision'].'%)';
            $exp->pay_to_vendor =  $dt['Payment']-$comm;
            $exp->order_date = $dt['Order_date'];
            $exp->account_no = $pln['account_no'];
            $exp->account_name = $pln['account_name'];
            $exp->bank_name =$pln['bank_name'];
            $exp->ifsc_code =$pln['ifsc_code'];
            $exp->delivery_detail = $dt['Delivery_details'];
            
            array_push($expdata, $exp);
        }
//        
        \moonland\phpexcel\Excel::widget([
        'models' => $expdata,    // here data of model is required..not only simple array
        'mode' => 'export', //default value as 'export'
        'columns' => ['order_No','vendor_name','order_date','payment_Date','shipment_Cost','payment','digin_Commission','pay_to_vendor','payment_Status','account_no','account_name','bank_name','ifsc_code','delivery_detail'], //without header working, because the header will be get label from attribute label.       
        ]);
       
   }
   
    public function actionDeliverystats()
    {
       $orid = $_POST['orderitemid'];
       if(isset($_POST['Orderitem']['delivery_status'])){
          $dvlrsts=$_POST['Orderitem']['delivery_status'];
//          var_dump($dvlrsts);
//          var_dump($orid);
         $dvrstats = Orderitem::find()->where(['oritemid'=>$orid])->one();
         if($dvlrsts=='Dispatched'){
            $uporitemsts = \backend\models\Orderitem::findOne($orid);
            $uporitemsts->delivery_status = 'Dispatched';
            $uporitemsts->update();
         }
          if($dvlrsts=='In Transit'){
            $uporitemsts = \backend\models\Orderitem::findOne($orid);
            $uporitemsts->delivery_status = 'In Transit';
            $uporitemsts->update();
         }
          if($dvlrsts=='Delivered'){
            $uporitemsts = \backend\models\Orderitem::findOne($orid);
            $uporitemsts->delivery_status = 'Delivered';
            $uporitemsts->update();
         }
        }else{
            $uporitemsts = \backend\models\Orderitem::findOne($orid);
            $uporitemsts->delivery_status = 'Peding Delivery';
            $uporitemsts->update();
       }
     
       return $this->redirect(['orderitem/paymentrpt']);
   }
  
}
