<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sms".
 *
 * @property integer $smsid
 * @property integer $leadid
 * @property string $name
 * @property string $phone no
 * @property string $message
 * @property string $crtdt
 * @property integer $crtby
 */
class Sms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leadid', 'name', 'phone', 'message', 'crtdt', 'crtby'], 'required'],
            [['leadid', 'crtby'], 'integer'],
            [['crtdt'], 'safe'],
            [['name', 'message'], 'string', 'max' => 512],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'smsid' => 'Smsid',
            'leadid' => 'Leadid',
            'name' => 'Name',
            'phone' => 'Phone No',
            'message' => 'Message',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
        ];
    }
}
