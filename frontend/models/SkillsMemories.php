<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_memories".
 *
 * @property integer $memoid
 * @property integer $userid
 * @property string $title
 * @property string $note
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsMemories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_memories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'title', 'note'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['title', 'note'], 'string'],
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
            'memoid' => 'Memoid',
            'userid' => 'Userid',
            'title' => 'Title',
            'note' => 'Note',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
