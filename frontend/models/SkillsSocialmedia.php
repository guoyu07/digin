<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_socialmedia".
 *
 * @property integer $smid
 * @property integer $userid
 * @property string $socialmedia_site
 * @property string $link
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsSocialmedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_socialmedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'socialmedia_site', 'link'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['link'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['socialmedia_site'], 'string', 'max' => 100],
            
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
            'smid' => 'Smid',
            'userid' => 'Userid',
            'socialmedia_site' => 'Socialmedia Site',
            'link' => 'Link',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
