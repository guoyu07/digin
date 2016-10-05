<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_philosophy".
 *
 * @property integer $phid
 * @property integer $userid
 * @property string $philosophytext
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsPhilosophy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_philosophy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'philosophytext'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['philosophytext'], 'string'],
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
            'phid' => 'Phid',
            'userid' => 'Userid',
            'philosophytext' => 'Philosophy text',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
