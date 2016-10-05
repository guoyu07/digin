<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_idols".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $name
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsIdols extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_idols';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'name'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['name'], 'string', 'max' => 50],
            
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
            'id' => 'ID',
            'userid' => 'Userid',
            'name' => 'Name',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
