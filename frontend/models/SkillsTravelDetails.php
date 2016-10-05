<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_travel_details".
 *
 * @property integer $trid
 * @property integer $userid
 * @property string $place
 * @property string $year
 * @property string $description
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsTravelDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_travel_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'place', 'year', 'description'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['year', 'crtdt', 'upddt'], 'safe'],
            [['description'], 'string'],
            [['place'], 'string', 'max' => 30],
            
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
            'trid' => 'Trid',
            'userid' => 'Userid',
            'place' => 'Place',
            'year' => 'Year',
            'description' => 'Description',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
