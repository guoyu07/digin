<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_facilities".
 *
 * @property integer $cfid
 * @property integer $catid
 * @property integer $facid
 */
class CategoryFacilities extends \yii\db\ActiveRecord
{
    public $facidarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_facilities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catid', 'facid'], 'required'],           
            [['catid','facid'], 'integer'],           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cfid' => 'Cfid',
            'catid' => 'Catid',
            'facid' => 'Facility',
        ];
    }

    
}

