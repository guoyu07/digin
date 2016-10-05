<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_hobbies".
 *
 * @property integer $hbid
 * @property string $hobby
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsHobbies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_hobbies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['hobby'], 'required'],
            [['crtdt', 'upddt'], 'safe'],
            [['crtby', 'updby', 'Is_approved'], 'integer'],
            [['hobby'], 'string', 'max' => 50],
            
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
            'hbid' => 'Hbid',
            'hobby' => 'Hobby',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
             'Is_approved' => 'Approved',
        ];
    }
   public function getIsAprvdskillhobbie($hbid)
    {
         if($this->findOne($hbid)!=null)
         {
             return $this->findOne($hbid)->Is_approved;
             
         }
    }
}
