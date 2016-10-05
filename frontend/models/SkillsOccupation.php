<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_occupation".
 *
 * @property integer $ocid
 * @property integer $userid
 * @property string $occupationtype
 * @property string $company
 * @property string $designation
 * @property integer $tenure
 * @property string $fromdate
 * @property string $todate
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsOccupation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_occupation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'occupationtype', 'company', 'designation', 'tenure', 'fromdate', 'todate'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['description','fromdate', 'todate', 'crtdt', 'upddt'], 'safe'],
            [['occupationtype', 'designation'], 'string', 'max' => 30],
            [['company'], 'string', 'max' => 50],
            
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
            'ocid' => 'Ocid',
            'userid' => 'Userid',
            'occupationtype' => 'Occupation type',
            'company' => 'Company',
            'designation' => 'Designation',
            'tenure' => 'Tenure',
            'fromdate' => 'From date',
            'todate' => 'To date',
            'description' => 'Description',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
