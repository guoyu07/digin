<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "roia".
 *
 * @property integer $id
 * @property integer $dpid
 * @property integer $cityid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class RoiA extends \yii\db\ActiveRecord
{
     public $state=null;
     public $cityarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dpid', 'cityid'], 'required'],
            [['dpid', 'cityid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            
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
            'dpid' => 'Delivery Partener',
            'cityid' => 'City',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
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
        
    public function getCity($id)
    {
        $dp= RoiA::find()->where(['dpid'=>$id])->all(); 
        $cities=array();
        $citylist='';
        foreach ($dp as $d){
        $city=  \frontend\models\Cities::find()->where(['id'=>$d['cityid']])->one();
        array_Push($cities, $city['name']);
        }
        $citylist=  implode(',', $cities);
        return $citylist;
    }
    
    public function isinRoiA($pin1,$pin2)
    {
        //return "pin1...".$pin1."pin2....".$pin2;
        $venpin=  Pincode::find()->where(['pincode'=>$pin1])->one();       
        $buyerpin=  Pincode::find()->where(['pincode'=>$pin2])->one();
        $roia1= RoiA::find()->where(['cityid'=>$venpin['cityid']])->one();
        $roia2= RoiA::find()->where(['cityid'=>$buyerpin['cityid']])->one();
        //$roia1=''; $roia2='';             //..to check
        //if($roia1!="" || $roia2!="")      ///..old
        if($roia1!="")
        {
            return 'RoI-A';
        }
        else{
            return false;
        } 
        //return $venpin['cityid']."...Zone".$buyerpin['cityid'];
    }
    public function isinRoiAbycity($city,$pin2)
    {
         //return "<br>City...".$city."pin....".$pin2;        
         //$vencity=  \frontend\models\Cities::find()->where(['name'=>$city])->one(); 
         $cityname="%".$city."%"; 
         $vencity=  \frontend\models\Cities::find()->where('name LIKE :query')
                                                   ->addParams([':query'=>$cityname])->one();       
         $buyerpin=  Pincode::find()->where(['pincode'=>$pin2])->one();
         $roia1= RoiA::find()->where(['cityid'=>$vencity['id']])->one();
         $roia2= RoiA::find()->where(['cityid'=>$buyerpin['cityid']])->one();
         //$roia1=''; $roia2='';         //..to check
         //if($roia1!="" || $roia2!="") //..old
         if($roia1!="")
        {
            return 'RoI-A';
        }
        else{
            return false;
        }        
    }
}
