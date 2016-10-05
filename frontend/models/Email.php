<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property integer $emid
 * @property integer $leadid
 * @property string $name
 * @property string $phone no
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property string $crtdt
 * @property integer $crtby
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email';
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
            [['name'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 20],
            [['email', 'subject'], 'string', 'max' => 512],
            [['message'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emid' => 'Emid',
            'leadid' => 'Leadid',
            'name' => 'Name',
            'phone' => 'Phone No',
            'email' => 'Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
        ];
    }
}
