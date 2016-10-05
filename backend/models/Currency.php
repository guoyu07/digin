<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $currency_name
 * @property integer $currency_code
 * @property string $currency_sign
 * @property string $currency_hexsymbol
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $excelfile=null;
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['currency_name', 'currency_code', 'currency_sign', 'currency_hexsymbol'], 'required'],
            //[['currency_code'], 'integer'],
             [['excelfile'], 'safe'],
            [['currency_name', 'currency_sign', 'currency_hexsymbol','currency_code'], 'string', 'max' => 100],
             [['excelfile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_name' => 'Currency Name',
            'currency_code' => 'Currency Code',
            'currency_sign' => 'Currency Sign',
            'currency_hexsymbol' => 'Currency Hexsymbol',
            'excelfile' => 'Upload File',
        ];
    }
}
