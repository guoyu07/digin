<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand_name".
 *
 * @property integer $id
 * @property string $brand_name
 * @property integer $crtby
 * @property string $crtdt
 * @property integer $updby
 * @property string $upddt
 */
class BrandName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_name'], 'required'],
            [['crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['brand_name'], 'string', 'max' => 225],
            
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
            'id' => 'ID',
            'brand_name' => 'Brand Name',
            'crtby' => 'Crtby',
            'crtdt' => 'Crtdt',
            'updby' => 'Updby',
            'upddt' => 'Upddt',
        ];
    }
}
