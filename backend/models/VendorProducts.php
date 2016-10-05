<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_products".
 *
 * @property integer $vpid
 * @property integer $vid
 * @property integer $prid
 * @property integer $unit
 * @property double $price
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class VendorProducts extends \yii\db\ActiveRecord
{
    public $category=null;
    public $catname=null;
    public $categorypath=null;
    public $product;
    public $prodname=null;
    public $country = null;
    public $countrylst=null;
    public $chngerate=null;




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['vid', 'prid', 'unit', 'price', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['vid','catid','prid', 'unit', 'price','can_book'], 'required'],
            [['vid', 'catid', 'prid', 'unit', 'crtby', 'updby','can_book'], 'integer'],
           // [['price'], 'number'],
            [['price','height', 'width','lenght','weight','weightunit'],'number'],
            [['crtdt', 'upddt'], 'safe'],
            [['unit'], 'unique', 'targetAttribute' => ['vid', 'prid']],
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
            ['updby', 'default', 'value' =>Yii::$app->user->identity->id]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vpid' => 'Vpid',
            'vid' => 'Vid',
            'catid'=> 'catid',
            'prid' => 'prid',
            'unit' => 'Unit',
            'price' => 'Price',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'catname'=> 'Category',
            'prodname' => 'Product',
            'height'=> 'Height',
            'width'=> 'Width',
            'lenght'=> 'Length',
            'can_book'=> 'Buy/Book',
            'weight'=> 'Weight',
            'weightunit'=>'Weight Unit',
            'countrylst' => 'Select Country',
            'chngerate'=>'Price'
        ];
    }
    public function getUnits()
    {
        return $this->hasOne(Units::className(), ['unitid' => 'unit']);
    }
    public function getUnitname()
    {
        return $this->units ? $this->units->unitname : 'Unit';
    }
    public function getProduct()
    {
        return $this->hasOne(Product::className(),['prid' => 'prid']);
    }
    public function getProductname()
    {
        return $this->product ? $this->product->prodname : 'No Product';
    }
    
    public function getCurrencySettingsVenProduct(){
        
        $vid = Vendor::find()->where(['user_id'=>  \yii::$app->user->identity->id])->one();
        $intvid = intval($vid['vid']);
        $modelcursetings  = new VendorCurrencySetting();
        $vencursetings = VendorCurrencySetting::findAll(['vid'=>$vid['vid']]);
        $vendorproducts = VendorProducts::findAll(['vid'=>$vid['vid']]);
        //Delete first record befor saving new
        foreach ($vendorproducts as $vens){
          if(isset($vens['vpid'])){
           $dlt = OtherCurrencyRates::deleteAll(['vpid'=>$vens['vpid']]);
          }
        }
        
        //if($vencursetings > 0){
         foreach ($vencursetings as $ven){
           $result = $modelcursetings->applyCurrencySetting($ven['country'],$ven['currency'],$ven['currency_rate'],$ven['percentaddition']);
          }
        //}
        
    }
}
