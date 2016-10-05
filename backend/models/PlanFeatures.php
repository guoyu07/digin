<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plan_features".
 *
 * @property integer $id
 * @property integer $planid
 * @property integer $featureid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class PlanFeatures extends \yii\db\ActiveRecord
{
    public $feature=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_features';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['planid', 'featureid'], 'required'],
            [['planid', 'featureid', 'crtby', 'updby'], 'integer'],
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
            'planid' => 'Planid',
            'featureid' => 'Featureid',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'feature' => 'Features',
        ];
    }
    
    public function getFeature($vid, $frid)
    {        
        $feature=array();
        $plan=  Vendor::find()->select('plan')->where(['vid'=>$vid])->one();
        $planfeature=  PlanFeatures::find()->where(['planid'=>$plan['plan']])->all();
        foreach ($planfeature as $pf){           
            array_push($feature, $pf['featureid']);
        }
        if(in_array($frid, $feature)){
            return true;
        }else{
            return false;
        }
        
    }
    
}
