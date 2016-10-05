<?php

namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ExportproductController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
  
   public function actionExport()
   {     
       //$postedid = $_GET['id'];
       //var_dump($postedid);
       //$loginvendor = Yii::$app->user->identity->id;
       //if(isset($_GET['id'])){
       $loginvendor = $_GET['id'];
       //}
       $expdata=array();
       //$data=array();
       
       
       $query=(new \yii\db\Query()) 
               ->select(['vp.vid as Vendor_Id','vp.price as Price','p.prodname','vp.vpid'])
               ->from('vendor_products vp')
               //->join('inner join','vendor v','v.vid=vp.vid')
               ->join('inner join', 'product p', 'p.prid=vp.prid')
               //->join('inner join', 'user u', 'u.id=v.user_id')
               //->orderBy('prodname asc')
               ->where(['vid'=>$loginvendor]);
        $data=$query->all();
        foreach ($data as $dt){
            $exp=new \backend\models\Exportproduct();
            $exp->vendor_id=$dt['Vendor_Id'];
            $exp->product_name=$dt['prodname'];
            $exp->product_price=$dt['Price'];
            $exp->vendor_product_id = $dt['vpid'];
            array_push($expdata, $exp);
        }
        
        \moonland\phpexcel\Excel::widget([
        'models' => $expdata,    // here data of model is required..not only simple array
        'mode' => 'export', //default value as 'export'
        'columns' => ['vendor_id','vendor_product_id','product_name','product_price'], //without header working, because the header will be get label from attribute label.       
        ]);
        //return true;
      /* Above one query can be written separately as below,
       * foreach ($states as $st){
           $cities=  \frontend\models\Cities::find()->where(['state_id'=>$st['id']])->all();
           foreach ($cities as $ct){
               $pincodes=  \backend\models\Pincode::find()->where(['cityid'=>$ct['id']])->all();
               foreach ($pincodes as $p){
                   //$data=['State'=>$st['name'], 'City'=>$ct['name'], 'Pincode'=>$p['pincode']];
                   //array_push($expdata, $data);
                   $exp=new \backend\models\Exportpin();
                   $exp->state=$st['name'];
                   $exp->city=$ct['name'];
                   $exp->pincode=$p['pincode'];
                   array_push($expdata, $exp);
               }
           }
       }*/      
       //var_dump($expdata);
       
   }
}
