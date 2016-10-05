<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_hobbies".
 *
 * @property integer $uhbid
 * @property integer $userid
 * @property integer $hobbyid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class UserHobbies extends \yii\db\ActiveRecord
{
    public $hobbyarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_hobbies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'hobbyid'], 'required'],
            [['userid', 'hobbyid', 'crtby', 'updby'], 'integer'],
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
            'uhbid' => 'Uhbid',
            'userid' => 'Userid',
            'hobbyid' => 'Hobbyid',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
