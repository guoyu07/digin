<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_vehicles".
 *
 * @property integer $vcid
 * @property integer $userid
 * @property string $vehicle_type
 * @property string $make
 * @property string $year
 * @property integer $registration_no
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsVehicles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_vehicles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'vehicle_type', 'make', 'year', 'registration_no'], 'required'],
            [['userid', 'registration_no', 'crtby', 'updby'], 'integer'],
            [['year', 'crtdt', 'upddt'], 'safe'],
            [['vehicle_type', 'make'], 'string', 'max' => 30],
            
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
            'vcid' => 'Vcid',
            'userid' => 'Userid',
            'vehicle_type' => 'Vehicle Type',
            'make' => 'Make',
            'year' => 'Year',
            'registration_no' => 'Registration No',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
