<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_faith".
 *
 * @property integer $faithid
 * @property integer $userid
 * @property string $faith
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsFaith extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_faith';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['faith'], 'required'],
            [['crtby', 'updby', 'Is_approved'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['faith'], 'string', 'max' => 50],
            
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
            'faithid' => 'Faithid',            
            'faith' => 'Faith',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'Is_approved' => 'Approved',
        ];
    }
     public function getIsAprvdskillfaith($faithid)
    {
         if($this->findOne($faithid)!=null)
         {
             return $this->findOne($faithid)->Is_approved;
             
         }
    }
}
