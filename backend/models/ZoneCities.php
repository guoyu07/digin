<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "zone_cities".
 *
 * @property integer $id
 * @property integer $zid
 * @property integer $cityid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class ZoneCities extends \yii\db\ActiveRecord
{
    public $state=null;   
    public $excelfile=null;
    public $cityarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zone_cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zid', 'cityid'], 'required'],
            [['zid', 'cityid', 'crtby', 'updby', 'dpid'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['excelfile'], 'file', 'skipOnEmpty' => true],
            
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
            'id' => 'ID',
            'zid' => 'Zone',
            'dpid' => 'Delivery Partener',
            'cityid' => 'City',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'excelfile' => 'Upload File',
        ];
    }
    
    public function getZone()
    {        
        return $this->hasOne(Zone::className(), ['zid' => 'zid']);
    } 
    public function getDeliverypartner()
    {
        return $this->hasOne(DeliveryPartner::className(), ['dpid' => 'dpid']);
    }
   
    public function getCities()
    {
        return $this->hasMany(\frontend\models\Cities::className(), ['id'=>'cityid']);
    }
    
    public function getPartner($id)
    {
        $dp=  DeliveryPartner::find()->where(['dpid'=>$id])->one();
        return $dp['name'];
    }
    
    public function getZonename($id)
    {
        $zone=  Zone::find()->where(['zid'=>$id])->one();
        return $zone['name'];
    }

    public function getCity($id)
    {
        $dp= ZoneCities::find()->where(['zid'=>$id])->all(); 
        $cities=array();
        $citylist='';
        foreach ($dp as $d){
        $city=  \frontend\models\Cities::find()->where(['id'=>$d['cityid']])->one();
        array_Push($cities, $city['name']);
        }
        $citylist=  implode(',', $cities);
        return $citylist;
    } 
    
    public function isinZone($pin1,$pin2)
    {
        $venpin=  Pincode::find()->where(['pincode'=>$pin1])->one();       
        $buyerpin=  Pincode::find()->where(['pincode'=>$pin2])->one();
        $zone1=  ZoneCities::find()->where(['cityid'=>$venpin['cityid']])->one();
        $zone2=  ZoneCities::find()->where(['cityid'=>$buyerpin['cityid']])->one();
        //$zone2['zid']=234;      //..to check
        if($zone1['zid']==$zone2['zid'])
        {
            return 'Zone';
        }
        else{
            return false;
        }        
    }
    public function isinZonebycity($city,$pin2)
    {            
         //$vencity=  \frontend\models\Cities::find()->where(['name'=>$city])->one(); 
         $cityname="%".$city."%"; 
         $vencity=  \frontend\models\Cities::find()->where('name LIKE :query')
                                                   ->addParams([':query'=>$cityname])->one();       
         $buyerpin=  Pincode::find()->where(['pincode'=>$pin2])->one();
         $zone1=  ZoneCities::find()->where(['cityid'=>$vencity['id']])->one();
         $zone2=  ZoneCities::find()->where(['cityid'=>$buyerpin['cityid']])->one();
         //$zone2['zid']=234;      //..to check
         if($zone1['zid']==$zone2['zid'])
        {
            return 'Zone';
        }
        else{
            return false;
        }        
    }
}
