<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wgtunits".
 *
 * @property integer $wgt_id
 * @property string $wgt_name
 */
class Wgtunits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wgtunits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wgt_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wgt_id' => 'Wgt ID',
            'wgt_name' => 'Wgt Name',
        ];
    }
}
