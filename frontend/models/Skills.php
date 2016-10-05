<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills".
 *
 * @property integer $sid
 * @property string $skill
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['skill'], 'required'],
            [['crtdt', 'upddt'], 'safe'],
            [['crtby', 'updby', 'Is_approved'], 'integer'],
            [['skill'], 'string', 'max' => 50],
            
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
            'sid' => 'Sid',
            'skill' => 'Skill',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'Is_approved' => 'Approved',
        ];
    }
   public function getIsAprvdskill($sid)
    {
         if($this->findOne($sid)!=null)
         {
             return $this->findOne($sid)->Is_approved;
             
         }
    }
}
