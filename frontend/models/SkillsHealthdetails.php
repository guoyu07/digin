<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_healthdetails".
 *
 * @property integer $hid
 * @property integer $userid
 * @property string $bloodgroup
 * @property double $height
 * @property double $weight
 * @property string $medication
 * @property string $diseases
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsHealthdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_healthdetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'bloodgroup', 'height', 'weight', 'medication'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['height', 'weight'], 'number'],            
            [['crtdt', 'upddt'], 'safe'],
            [['bloodgroup'], 'string', 'max' => 10],
            [['medication'], 'string', 'max' => 50],
            
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
            'hid' => 'Hid',
            'userid' => 'Userid',
            'bloodgroup' => 'Bloodgroup',
            'height' => 'Height',
            'weight' => 'Weight',
            'medication' => 'Medication',            
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
