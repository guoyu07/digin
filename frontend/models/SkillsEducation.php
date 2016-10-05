<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_education".
 *
 * @property integer $eid
 * @property integer $userid
 * @property string $qualification
 * @property string $institute
 * @property string $year
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'qualification', 'institute', 'year'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['institute'], 'string'],
            [['year', 'crtdt', 'upddt'], 'safe'],
            [['qualification'], 'string', 'max' => 30],
            
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
            'eid' => 'Eid',
            'userid' => 'Userid',
            'qualification' => 'Qualification',
            'institute' => 'Institute',
            'year' => 'Year',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
