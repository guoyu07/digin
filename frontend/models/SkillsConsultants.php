<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_consultants".
 *
 * @property integer $cid
 * @property integer $userid
 * @property string $consultant_type
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsConsultants extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_consultants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'consultant_type', 'name', 'phone'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['consultant_type'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 150],
            
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
            'cid' => 'Cid',
            'userid' => 'Userid',
            'consultant_type' => 'Consultant Type',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
