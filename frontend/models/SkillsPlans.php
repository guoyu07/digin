<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_plans".
 *
 * @property integer $planid
 * @property integer $userid
 * @property string $plantype
 * @property string $description
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsPlans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_plans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'plantype', 'description'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['description'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['plantype'], 'string', 'max' => 20],
            
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
            'planid' => 'Planid',
            'userid' => 'Userid',
            'plantype' => 'Plan type',
            'description' => 'Description',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
