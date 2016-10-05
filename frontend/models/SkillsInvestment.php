<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_investment".
 *
 * @property integer $invid
 * @property integer $userid
 * @property string $investment_type
 * @property double $valuation
 * @property string $description
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsInvestment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_investment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'investment_type', 'valuation', 'description'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['valuation'], 'number'],
            [['description'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['investment_type'], 'string', 'max' => 30],
            
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
            'invid' => 'Invid',
            'userid' => 'Userid',
            'investment_type' => 'Investment Type',
            'valuation' => 'Valuation',
            'description' => 'Description',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
