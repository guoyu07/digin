<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "special_delivery_option".
 *
 * @property integer $id
 * @property string $delivery_limit
 * @property string $km_radius
 * @property integer $rest_all
 */
class SpecialDeliveryOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'special_delivery_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['delivery_limit', 'km_radius', 'rest_all'], 'required'],
            [['rest_all','min_order_val'], 'integer'],
            //[['delivery_limit', 'km_radius'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_limit' => '',
            'km_radius' => 'Km Radius',
            'rest_all' => 'Rest All',
        ];
    }
}
