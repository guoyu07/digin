<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "other_currency_rates".
 *
 * @property integer $ocid
 * @property integer $vpid
 * @property integer $country
 * @property string $currency
 * @property integer $rate
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class OtherCurrencyRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'other_currency_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vpid', 'country', 'currency'], 'required'],
            [['vpid', 'country','crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['currency'], 'string', 'max' => 250],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1'],
            ['updby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1']
      
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ocid' => 'Ocid',
            'vpid' => 'Vpid',
            'country' => 'Country',
            'currency' => 'Currency',
            'rate' => 'Rate',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
