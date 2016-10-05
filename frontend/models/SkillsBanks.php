<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_banks".
 *
 * @property integer $bid
 * @property integer $userid
 * @property string $bankname
 * @property string $branchname
 * @property integer $account_no
 * @property string $IFSC_no
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsBanks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_banks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'bankname', 'branchname', 'account_no', 'IFSC_no'], 'required'],
            [['userid', 'account_no', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['bankname'], 'string', 'max' => 100],
            [['branchname'], 'string', 'max' => 50],
            [['IFSC_no'], 'string', 'max' => 11],
            
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
            'bid' => 'Bid',
            'userid' => 'Userid',
            'bankname' => 'Bank name',
            'branchname' => 'Branch name',
            'account_no' => 'Account Number',
            'IFSC_no' => 'IFSC Number',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
