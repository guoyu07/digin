<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "paymentype".
 *
 * @property integer $ptid
 * @property integer $type
 * @property string $description
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Paymentype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paymentype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'description', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['type', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['description'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ptid' => 'Ptid',
            'type' => 'Type',
            'description' => 'Description',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
