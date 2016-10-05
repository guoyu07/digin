<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_passport".
 *
 * @property integer $pid
 * @property integer $userid
 * @property string $nationality
 * @property integer $passport_no
 * @property string $issuedate
 * @property string $expirydate
 * @property string $scancopy
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsPassport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_passport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'nationality', 'passport_no', 'issuedate', 'expirydate'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['issuedate', 'expirydate', 'crtdt', 'upddt'], 'safe'],
            [['nationality'], 'string', 'max' => 30],            
            [['scancopy'], 'file', 'skipOnEmpty' => true],
            
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
            'pid' => 'Pid',
            'userid' => 'Userid',
            'nationality' => 'Nationality',
            'passport_no' => 'Passport No',
            'issuedate' => 'Issue date',
            'expirydate' => 'Expiry date',
            'scancopy' => 'Scan copy',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
