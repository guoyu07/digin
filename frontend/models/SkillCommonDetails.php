<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skill_common_details".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $birthdate
 * @property integer $birthplaceid
 * @property integer $religionid
 * @property integer $faithid
 * @property integer $castid
 * @property string $sex
 * @property string $marrital_status
 * @property integer $landline
 * @property string $blog
 * @property integer $annual_income
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillCommonDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skill_common_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'birthdate', 'religionid', 'faithid', 'castid', 'sex', 'marrital_status' ], 'required'],
            [['userid', 'religionid', 'faithid', 'castid', 'annual_income', 'crtby', 'updby'], 'integer'],
            [['birthdate', 'landline', 'crtdt', 'upddt'], 'safe'],
            [['blog'], 'string'],
            [['sex', 'marrital_status'], 'string', 'max' => 10],
            
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
            'birthdate' => 'Birthdate',
            'birthplaceid' => 'Birthplaceid',
            'religionid' => 'Religion',
            'faithid' => 'Faith',
            'castid' => 'Cast',
            'sex' => 'Sex',
            'marrital_status' => 'Marital Status',
            'landline' => 'Landline',
            'blog' => 'Blog',
            'annual_income' => 'Annual Income',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
