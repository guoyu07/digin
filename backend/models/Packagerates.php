<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "packagerates".
 *
 * @property integer $rid
 * @property integer $pkgid
 * @property double $withincityrate
 * @property double $zonerate
 * @property double $metrorate
 * @property double $RoI-Arate
 * @property double $RoI-Brate
 * @property double $spldestrate
 * @property double $weightmultiple
 * @property double $addwithincityrate
 * @property double $addzonerate
 * @property double $addmetrorate
 * @property double $addRoI-Arate
 * @property double $addRoI-Brate
 * @property double $addspldestrate
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Packagerates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packagerates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkgid', 'withincityrate', 'zonerate', 'metrorate', 'RoIArate', 'RoIBrate', 'spldestrate', 'addweightmultiple', 'addwithincityrate', 'addzonerate', 'addmetrorate', 'addRoIArate', 'addRoIBrate', 'addspldestrate', 'initialweight'], 'required'],
            [['pkgid', 'crtby', 'updby'], 'integer'],
            [['withincityrate', 'zonerate', 'metrorate', 'RoIArate', 'RoIBrate', 'spldestrate', 'addweightmultiple', 'addwithincityrate', 'addzonerate', 'addmetrorate', 'addRoIArate', 'addRoIBrate', 'addspldestrate', 'initialweight'], 'number'],
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
            'rid' => 'Rid',
            'pkgid' => 'Pkgid',
            'initialweight' =>' Initial weight',
            'withincityrate' => 'Within City rate',
            'zonerate' => 'Zone rate',
            'metrorate' => 'Metro rate',
            'RoIArate' => 'RoI-A rate',
            'RoIBrate' => 'RoI-B rate',
            'spldestrate' => 'Special destination rate',
            'addweightmultiple' => 'Additional Weight multiple',
            'addwithincityrate' => 'Additional within city rate',
            'addzonerate' => 'Additional zone rate',
            'addmetrorate' => 'Additional metro rate',
            'addRoIArate' => 'Additional RoI-A rate',
            'addRoIBrate' => 'Additional RoI-B rate',
            'addspldestrate' => 'Additional Special destination rate',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
