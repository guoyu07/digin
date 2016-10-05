<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_images".
 *
 * @property integer $primgid
 * @property integer $prid
 * @property string $image
 * @property integer $ismain
 */
class ProductImages extends \yii\db\ActiveRecord
{
     public $images=array();  
     public $primaryimage=null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['prid', 'image', 'ismain'], 'required'],
            [['prid', 'image'], 'required'],
            [['prid', 'ismain'], 'integer'],
            //[['image'], 'string', 'max' => 30],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg',  'maxFiles' => 0],
            [['primaryimage'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'primgid' => 'Primgid',
            'prid' => 'Prid',
            'image' => 'Image',
            'ismain' => 'Ismain',            
        ];
    }
}
