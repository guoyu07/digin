<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "country_currency".
 *
 * @property integer $id
 * @property integer $country_id
 * @property integer $curn_id
 */
class CountryCurrency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $excelfile=null;
    public static function tableName()
    {
        return 'country_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['country_id', 'curn_id'], 'required'],
            [['country_id', 'currency_id'], 'integer'],
            [['excelfile'], 'safe'],
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
            'country_id' => 'Country ID',
            'currency_id' => 'Curn ID',
            'excelfile' => 'Upload File',
        ];
    }
}
