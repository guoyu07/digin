<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_sibblings".
 *
 * @property integer $sibid
 * @property integer $userid
 * @property string $firstname
 * @property string $lastname
 * @property string $link
 * @property string $relation
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsSibblings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_sibblings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'link', 'relation'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['link'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 30],
            [['relation'], 'string', 'max' => 20],
            
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
            'sibid' => 'Sibid',
            'userid' => 'Userid',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'link' => 'Link',
            'relation' => 'Relation',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
