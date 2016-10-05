<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_currency_setting".
 *
 * @property integer $id
 * @property integer $vid
 * @property string $base_currency
 * @property integer $country
 * @property string $currency
 * @property integer $currency_rate
 * @property double $percentaddition
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class VendorCurrencySetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor_currency_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'base_currency', 'country', 'currency', 'currency_rate', 'percentaddition'], 'required'],
            [['vid','crtby', 'updby'], 'integer'],
            [['percentaddition','currency_rate'], 'number'],
            [['crtdt', 'upddt'], 'safe'],
            [['base_currency', 'currency'], 'string', 'max' => 250],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1'],
            ['updby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1']
      
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vid' => 'Vid',
            'base_currency' => 'Base Currency',
            'country' => 'Country',
            'currency' => 'Currency',
            'currency_rate' => 'Currency Rate',
            'percentaddition' => '%Addition',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
    
   public function getCode($id)
    {
        $currid= CountryCurrency::find()->where(['country_id'=>$id])->all();
        $curcode = Currency::findOne(['id'=>$currid['currency_id']]);
        //var_dump($city);
        return $curcode['currency_id'];
    } 
    public function getVendorname($vid)
    {
        $vennm = Vendor::find()->where(['vid'=>$vid])->one();
        return $vennm['firstname'].$vennm['lastname'];
    }
    
    public function getCountryname($cid)
    {
        $cunnam = \frontend\models\Countries::find()->where(['id'=>$cid])->one();
        return $cunnam['name'];
    }
    
    /*******$country,$currency,$currate,$peradd******/
    public function applyCurrencySetting($country,$currency,$currate,$peradd){
        $vid = Vendor::find()->where(['user_id'=>  \yii::$app->user->identity->id])->one();
        $vendorproducts = VendorProducts::findAll(['vid'=>$vid['vid']]);
        
        //create new othercurrates records as per rate calculation.. 
        foreach ($vendorproducts as $vp){
           $rate = ($vp['price']/$currate)+($vp['price']/($currate)*$peradd/100);
           $search = OtherCurrencyRates::find()->where(['vpid'=>$vp['vpid'],'currency'=>$currency])->one();
           
           $modelothercurrate = new OtherCurrencyRates();
           if(sizeof($search)>0){
           $search->country = $country;
           $search->currency = $currency;
           $search->vpid = $vp['vpid'];
           $search->rate = $rate;
           $search->update();
            }else{
           $modelothercurrate = new OtherCurrencyRates();
           $modelothercurrate->country = $country;
           $modelothercurrate->currency = $currency;
           $modelothercurrate->vpid = $vp['vpid'];
           $modelothercurrate->rate = $rate;
            }
           $succs = $modelothercurrate->save();
         }
//         var_dump($modelothercurrate->getErrors());
//        
    }
}
