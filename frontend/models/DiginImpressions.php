<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "digin_impressions".
 *
 * @property integer $id
 * @property integer $prid
 * @property string $impressiondate
 */
class DiginImpressions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'digin_impressions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prid', 'impressiondate'], 'required'],
            [['prid'], 'integer'],
            [['impressiondate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prid' => 'Prid',
            'impressiondate' => 'Impressiondate',
        ];
    }
}
