<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_creations".
 *
 * @property integer $crid
 * @property integer $userid
 * @property string $title
 * @property string $note
 * @property string $image
 * @property string $youtoube_link
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsCreations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_creations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'title', 'note'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['title', 'note', 'youtoube_link'], 'string'],
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
            'crid' => 'Crid',
            'userid' => 'Userid',
            'title' => 'Title',
            'note' => 'Note',
            'image' => 'Image',
            'youtoube_link' => 'Youtoube Link',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
