<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "units".
 *
 * @property integer $unitid
 * @property string $unitname
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'units';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unitname'], 'required'],
            [['unitname'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unitid' => 'Unitid',
            'unitname' => 'Unitname',
        ];
    }
}
