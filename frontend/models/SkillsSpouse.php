<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_spouse".
 *
 * @property integer $spid
 * @property string $firstname
 * @property string $lastname
 * @property string $link
 * @property integer $userid
 * @property string $anniversary_date
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsSpouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_spouse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'anniversary_date'], 'required'],
            [['link'], 'string'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['anniversary_date', 'crtdt', 'upddt'], 'safe'],
            [['firstname', 'lastname', 'relation'], 'string', 'max' => 30],
            
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
            'spid' => 'Spid',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'link' => 'Link',
            'userid' => 'Userid',
            'anniversary_date' => 'Anniversary Date',
            'relation' => 'Relation',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
