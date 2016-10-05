<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_cast".
 *
 * @property integer $castid
 * @property integer $userid
 * @property string $cast
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsCast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_cast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['cast'], 'required'],
            [['crtby', 'updby', 'Is_approved'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['cast'], 'string', 'max' => 30],
            
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
            'castid' => 'Castid',            
            'cast' => 'Cast',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'Is_approved' => 'Approved',
        ];
    }
   public function getIsAprvdskillcast($sid)
    {
         if($this->findOne($sid)!=null)
         {
             return $this->findOne($sid)->Is_approved;
             
         }
    }
}
