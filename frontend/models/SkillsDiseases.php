<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_diseases".
 *
 * @property integer $disid
 * @property integer $userid
 * @property string $disease
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsDiseases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_diseases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'disease'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['disease'], 'string', 'max' => 100],
            
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
            'disid' => 'Disid',
            'userid' => 'Userid',
            'disease' => 'Disease',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
