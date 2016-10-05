<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_skills".
 *
 * @property integer $usid
 * @property integer $userid
 * @property integer $skillid
 * @property string $description
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class UserSkills extends \yii\db\ActiveRecord
{
    public $skillarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'skillid', 'crtby', 'updby'], 'integer'],
            [['description'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            
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
            'usid' => 'Usid',
            'userid' => 'Userid',
            'skillid' => 'Skill',
            'description' => 'Description',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
      
}
