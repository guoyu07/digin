<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exportpin".
 *
 * @property integer $id
 * @property string $state
 * @property string $city
 * @property integer $pincode
 */
class Exportproduct extends \yii\base\Model
{
    public $vendor_id=null;
    public $product_name=null;
    public $product_price=null;
    public $vendor_product_id=null;
    /**
     * @inheritdoc
     */
   /* public static function tableName()
    {
        return 'exportpin';
    } */

    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'prodname', 'price','vpid'], 'required'],
            [['vid','price','vpid'], 'integer'],
            [['prodname'], 'string', 'max' => 100],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vid' => 'VID',
            'prodname' => 'Product Name',
            'price' => 'Price',
            
        ];
    }
}
