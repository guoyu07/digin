<?php

namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Orderitem;
use backend\models\OrderitemSearch;

class ExportpaymentrptController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
  
   public function actionExport()
   {     
       $loginvendor = Yii::$app->user->identity->id;
       $expdata=array();
       //$data=array();
        $model = new Orderitem();
        $searchModel = new OrderitemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
       //var_dump($_POST);
       
       $query=(new \yii\db\Query()) 
               ->select(['v.vid','oi.vpid','v.businessname as Vendor_Name','o.displayid','oi.vendor_pay_date as Payment_date','oi.shipment','oi.producttotal as Payment','oi.paid_to_vendor as Payment_Status','CONCAT(a.name,a.address1,a.address2,a.city,a.country) AS Delivery_details'])
               ->from('vendor_products vp')
               ->join('inner join','orderitem oi','vp.vpid=oi.vpid')
               ->join('inner join','vendor v','v.vid=vp.vid')
               ->join('inner join','orders o','o.orid=oi.orid')
               ->join('inner join','address a','a.adrid=o.adrid')
               ->orderBy('Vendor_Name asc');
               //->where(['user_id'=>$loginvendor]);
        $data=$query->all();
        foreach ($dataProvider as $dt){
            $exp=new \backend\models\Exportpaymntrpt();
            $exp->Order_No=$dt['displayid'];
            $exp->Vendor_name=$dt['Vendor_Name'];
            $exp->Payment_Date=$dt['Payment_date'];
            $exp->Shipment_Cost = $dt['shipment'];
            $exp->Payment = $dt['Payment'];
            $exp->Payment_Status = $dt['Payment_Status'];
            $exp->delivery_detail = $dt['Delivery_details'];
            //$exp->Shipment_Cost = $dt['shipment'];
            array_push($expdata, $exp);
        }
        
        \moonland\phpexcel\Excel::widget([
        'models' => $expdata,    // here data of model is required..not only simple array
        'mode' => 'export', //default value as 'export'
        'columns' => ['Order_No','Vendor_name','Payment_Date','Shipment_Cost','Payment','Digin_Commission','Pay_to_vendor','Payment_Status','Delivery_details'], //without header working, because the header will be get label from attribute label.       
        ]);
       
   }
}
