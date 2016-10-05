<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pincode".
 *
 * @property integer $pnid
 * @property integer $city_id
 * @property integer $pincode
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Pincode extends \yii\db\ActiveRecord
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
        return 'pincode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityid'], 'required'],
            [['cityid', 'pincode', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt','excelfile','pincodenew','excelfile'], 'safe'],
            
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
            'pnid' => 'Pnid',
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
     
  public function getCity($id)
    {
        $city=  \frontend\models\Cities::find()->where(['id'=>$id])->one();
        return $city['name'];
    }  
    
  public function getPincode($id)
    {
        $dp= Pincode::find()->where(['cityid'=>$id])->all(); 
        $pincodes=array();
        $pinlist='';
        foreach ($dp as $d){
        $pin= \backend\models\Pincode::find()->where(['pincode'=>$d['pincode']])->one();
        array_Push($pincodes, $pin['pincode']);
        }
        $pinlist=  implode(',', $pincodes);
        return $pinlist;
    }    
}
