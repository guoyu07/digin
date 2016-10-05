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
class Exportpin extends \yii\base\Model
{
    public $state=null;
    public $city=null;
    public $pincode=null;
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
            [['state', 'city', 'pincode'], 'required'],
            [['pincode'], 'integer'],
            [['state'], 'string', 'max' => 50],
            [['city'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state' => 'State',
            'city' => 'City',
            'pincode' => 'Pincode',
        ];
    }
}
