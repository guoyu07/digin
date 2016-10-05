<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_religion".
 *
 * @property integer $regid
 * @property string $religion_name
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsReligion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_religion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['religion_name'], 'required'],
            [['crtdt', 'upddt'], 'safe'],
            [['crtby', 'updby', 'Is_approved'], 'integer'],
            [['religion_name'], 'string', 'max' => 30],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :'1'],
            ['updby', 'default', 'value' =>isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :'1']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'regid' => 'Regid',
            'religion_name' => 'Religion Name',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'Is_approved' => 'Approved',
        ];
    }
    
     public function getIsAprvdskillreg($regid)
    {
         if($this->findOne($regid)!=null)
         {
             return $this->findOne($regid)->Is_approved;
             
         }
    }
}
