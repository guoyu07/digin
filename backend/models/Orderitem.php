<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orderitem".
 *
 * @property integer $oritemid
 * @property integer $orid
 * @property integer $vpid
 * @property double $rate
 * @property integer $quantity
 * @property double $producttotal
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Orderitem extends \yii\db\ActiveRecord
{
    public $city;
    public $dlvrpin;
    public $payvendor;
    public $dwnldl;
    public $digincomisn;
    public $payacn;
    public $vendorname;
    public $status;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orid', 'vpid', 'rate', 'quantity', 'producttotal', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['orid','quantity', 'crtby', 'updby'], 'integer'],
            [['rate', 'producttotal', 'shipment', 'grosstotal'], 'number'],
            [['crtdt', 'upddt','city','delivery_pin','dlvrpin','delivery_status','vendor_pay_date','digincomisn','vpid','status'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oritemid' => 'Oritemid',
            'orid' => 'Orid',
            'vpid' => 'Vpid',
            'rate' => 'Rate',
            'quantity' => 'Quantity',
            'producttotal' => 'Producttotal',
            'delivery_pin' => 'Delivery Pin/Status',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'vendor_pay_date' =>'Pay Date',
            'digincomisn'=> 'Digin Comission',
            'payacn'=> '',
            'status' =>'Payment Status',
        ];
    }
    
   public function getOrderItems($vpid)
    {
       $prid= VendorProducts::find()->where(['vpid'=>$vpid])->all();
       foreach ($prid as $p){
       $prodnm = Product::find()->where(['prid'=>$p['prid']])->one();
       return $prodnm['prodname'];
       }
    }
    
    public function getOrderNo($orid)
      {
        $ordr=  Orders::find()->where(['orid'=>$orid])->one();
        return $ordr['displayid'];
      }
    
   public function getDeliveryDetails($orid)
   {
        $ordr=  Orders::find()->where(['orid'=>$orid])->one();
        $address = \frontend\models\Address::findOne(['adrid'=>$ordr['adrid']]);
        //var_dump($address);
        return $address['name'].' '.$address['address1'].' '.$address['address2'].' '.$address['city'].' '.$address['pin'].' '.$address['country'];
   }
      
   public function getAddress($orid)
      {
          $ordr=  Orders::find()->where(['orid'=>$orid])->one();
          $addr = Address::find()->where(['adrid'=>$ordr['adrid']])->one();
          return $addr['city'];
      }
    public function getVendor()  
    {
         return $this->hasOne(Vendor::className(), ['vid' => 'vid'])
			    ->viaTable(VendorProducts::tableName(), ['vpid' => 'vpid']);
     }
      
      
      public function getVendorNm($vpid)
      {
          //var_dump($vpid);
          $oritem = Orderitem::find()->where(['vpid'=>$vpid])->all();
          $venpro = VendorProducts::find()->where(['vpid'=>$vpid])->all();
         foreach ($venpro as $o){
             $vnam = Vendor::find()->where(['vid'=>$o['vid']])->one();
             return $vnam['businessname'];
         }
         
      }
      public function getDiginComissn($vpid,$oritemid)
      {
          $venpro = VendorProducts::find()->where(['vpid'=>$vpid])->all();
          foreach ($venpro as $v){
          $vendr = Vendor::findOne(['vid'=>$v['vid']]);
          $prototal = Orderitem::findOne(['oritemid'=>$oritemid]);//'vpid'=>$vpid,
          //var_dump($prototal['oritemid']);
          $plncmsn = Plan::findOne(['id'=>$vendr['plan']]);
          //var_dump($plncmsn['digin_commision']);
          $comm=$plncmsn['digin_commision']*$prototal['producttotal']/100;
          return $comm.' '.'('.$plncmsn['digin_commision'].'%)';
          }
      }
      
      public function getPaytovendor($vpid)
      {
          $venpro = VendorProducts::find()->where(['vpid'=>$vpid])->all();
          foreach ($venpro as $v){
          $vendr = Vendor::findOne(['vid'=>$v['vid']]);
          $prototal = Orderitem::findOne(['vpid'=>$vpid]);
          $plncmsn = Plan::findOne(['id'=>$vendr['plan']]);
          $comm=$plncmsn['digin_commision']*$prototal['producttotal']/100;
          return $prototal['producttotal']-$comm;
          }
         
      }
      public function getPaystatus($orid)
      {
          $prototal = Orderitem::findOne(['oritemid'=>$orid]);
          if($prototal['paid_to_vendor']==1){
              return 'Paid';
          }else{
              return 'Pending';
          }
      }
}
