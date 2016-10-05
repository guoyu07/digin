<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_facilities".
 *
 * @property integer $vfid
 * @property integer $vid
 * @property integer $facid
 */
class VendorFacilities extends \yii\db\ActiveRecord
{
    public $facidarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor_facilities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'facid'], 'required'],
            [['vid', 'facid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vfid' => 'Vfid',
            'vid' => 'Vid',
            //'facid' => 'Facid',
            'facid' => 'Facility',
        ];
    }
}
