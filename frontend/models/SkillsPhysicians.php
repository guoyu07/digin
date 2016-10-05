<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_physicians".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $physician_name
 * @property string $speciality
 * @property string $phone
 * @property string $email
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsPhysicians extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_physicians';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'physician_name', 'speciality', 'phone', 'email'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['physician_name', 'speciality'], 'string', 'max' => 50],
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
            'id' => 'ID',
            'userid' => 'Userid',
            'physician_name' => 'Physician Name',
            'speciality' => 'Speciality',
            'phone' => 'Phone',
            'email' => 'Email',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
