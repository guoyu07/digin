<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "digin_clicks".
 *
 * @property integer $id
 * @property integer $vid
 * @property string $clickdate
 */
class DiginClicks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'digin_clicks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'clickdate'], 'required'],
            [['vid'], 'integer'],
            [['clickdate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vid' => 'Vid',
            'clickdate' => 'Clickdate',
        ];
    }
}
