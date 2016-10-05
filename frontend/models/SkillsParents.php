<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_parents".
 *
 * @property integer $parentid
 * @property integer $userid
 * @property string $fathername
 * @property string $mothername
 * @property string $father_firstname
 * @property string $father_lastname
 * @property string $mother_firstname
 * @property string $mother_lastname
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsParents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['father_firstname', 'father_lastname', 'mother_firstname', 'mother_lastname'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['link1', 'link2', 'crtdt', 'upddt'], 'safe'],
            [['father_firstname', 'father_lastname', 'mother_firstname', 'mother_lastname'], 'string', 'max' => 30],
            
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
            'parentid' => 'Parentid',
            'userid' => 'Userid',            
            'father_firstname' => 'Firstname',
            'father_lastname' => 'Lastname',
            'mother_firstname' => 'Firstname',
            'mother_lastname' => 'Lastname',
            'link1' => 'Link',
            'link2' => 'Link',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
