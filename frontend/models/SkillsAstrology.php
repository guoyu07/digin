<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_astrology".
 *
 * @property integer $astid
 * @property integer $userid
 * @property string $image
 * @property string $text
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsAstrology extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_astrology';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'text'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['text'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            //[['image'], 'string', 'max' => 100],
            [['image'], 'file', 'skipOnEmpty' => true],
            
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
            'astid' => 'Astid',
            'userid' => 'Userid',
            'image' => 'Image',
            'text' => 'Text',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
