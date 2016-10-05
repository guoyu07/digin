<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "currency_conversion".
 *
 * @property integer $cid
 * @property string $from_currency
 * @property string $to_currency
 * @property double $ration
 * @property string $time
 */
class CurrencyConversion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency_conversion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_currency', 'to_currency', 'ration', 'time'], 'required'],
            [['ration'], 'number'],
            [['time'], 'safe'],
            [['from_currency', 'to_currency'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'from_currency' => 'From Currency',
            'to_currency' => 'To Currency',
            'ration' => 'Ration',
            'time' => 'Time',
        ];
    }
}
