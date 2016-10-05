<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $adrid
 * @property integer $userid
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $pin
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address1', 'address2', 'city', 'state', 'country', 'pin','email','phone'], 'required'],
            [['pin', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['address1', 'address2'], 'string', 'max' => 50],
            [['city', 'state', 'country'], 'string', 'max' => 30],
            [['email', 'phone'], 'string'],

            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
            ['updby', 'default', 'value' =>Yii::$app->user->identity->id]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adrid' => 'Adrid',
            'userid' => 'Userid',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'pin' => 'Pin',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
