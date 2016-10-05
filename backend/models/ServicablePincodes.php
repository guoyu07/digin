<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "servicable_pincodes".
 *
 * @property integer $pinid
 * @property integer $dpid
 * @property integer $cityid
 * @property integer $pincode
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class ServicablePincodes extends \yii\db\ActiveRecord
{
    public $excelfile=null;
    public $state=null;
    public $pincodenew = array();
    public $pin = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicable_pincodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dpid', 'cityid', 'pincode'], 'required'],
            [['dpid', 'cityid', 'pincode', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt', 'excelfile','pincodenew','excelfile'], 'safe'],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
            ['updby', 'default', 'value' =>Yii::$app->user->identity->id],
            [['excelfile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pinid' => 'Pinid',
            'dpid' => 'Delivery Partner',
            'cityid' => 'City',
            'pincode' => 'Pincode',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'excelfile' => 'Upload File',
            'pincodenew'=> 'Selected Pincode',
        ];
    }
    
    public function getDeliverypartner()
    {
        return $this->hasOne(DeliveryPartner::className(), ['dpid' => 'dpid']);
    }
    
    public function getCities()
    {
        return $this->hasOne(\frontend\models\Cities::className(), ['id'=>'cityid']);
    }
    
    public function getPartner($id)
    {
        $dp=  DeliveryPartner::find()->where(['dpid'=>$id])->one();
        return $dp['name'];
    }
    
    public function getCity($id)
    {
        $city=  \frontend\models\Cities::find()->where(['id'=>$id])->one();
        return $city['name'];
    }
        
    public function getPincode($id)
    {
        $dp= ServicablePincodes::find()->where(['cityid'=>$id])->all(); 
        $pincodes=array();
        $pinlist='';
        foreach ($dp as $d){
        $pin= \backend\models\ServicablePincodes::find()->where(['pincode'=>$d['pincode']])->one();
        array_Push($pincodes, $pin['pincode']);
        }
        $pinlist=  implode(',', $pincodes);
        return $pinlist;
    }   
}
