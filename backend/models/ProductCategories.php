<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_categories".
 *
 * @property integer $pcid
 * @property integer $prid
 * @property integer $catid
 */
class ProductCategories extends \yii\db\ActiveRecord
{
    public $prodcat=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prid', 'catid'], 'required'],
            [['prid', 'catid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pcid' => 'Pcid',
            'prid' => 'Prid',
            'catid' => 'Catid',
            //'prodcat' => 'Product Categories'
        ];
    }
}
