<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bulkrates".
 *
 * @property integer $id
 * @property integer $pkgid
 * @property double $withincityrate
 * @property double $zonerate
 * @property double $metrorate
 * @property double $RoIArate
 * @property double $RoIBrate
 * @property double $spldestrate
 * @property double $minimumweight
 * @property double $weightmultiple
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Bulkrates extends \yii\db\ActiveRecord
{
    public $bulk=null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bulkrates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['pkgid', 'withincityrate', 'zonerate', 'metrorate', 'RoIArate', 'RoIBrate', 'spldestrate', 'minimumweight', 'weightmultiple'], 'required'],
            [['pkgid', 'crtby', 'updby'], 'integer'],
            [['withincityrate', 'zonerate', 'metrorate', 'RoIArate', 'RoIBrate', 'spldestrate', 'minimumweight', 'weightmultiple'], 'number'],
            [['crtdt', 'upddt'], 'safe'],
            
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
            'pkgid' => 'Pkgid',
            'withincityrate' => 'Bulk Within City rate',
            'zonerate' => 'Bulk Zone rate',
            'metrorate' => 'Bulk Metro rate',
            'RoIArate' => 'Bulk RoI-A rate',
            'RoIBrate' => 'Bulk RoI-B rate',
            'spldestrate' => 'Bulk Special destination rate',
            'minimumweight' => 'Bulk Minimum weight',
            'weightmultiple' => 'Bulk Weight multiple',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
