<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dppackage".
 *
 * @property integer $id
 * @property integer $dpid
 * @property string $packagename
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Dppackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dppackage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dpid', 'packagename'], 'required'],
            [['dpid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['packagename'], 'string', 'max' => 100],
            
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
            'dpid' => 'Delivery Partner',
            'packagename' => 'Package name',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
    
    public function getPartner($id)
    {
        $dp=  DeliveryPartner::find()->where(['dpid'=>$id])->one();
        return $dp['name'];
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getDeliverypartner()
    {
        return $this->hasOne(DeliveryPartner::className(), ['dpid' => 'dpid']);
    }
}
