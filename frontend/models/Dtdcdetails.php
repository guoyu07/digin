<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dtdcdetails".
 *
 * @property integer $id
 * @property integer $oritemid
 * @property string $AWBno
 * @property string $status
 * @property string $reason
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Dtdcdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dtdcdetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oritemid', 'AWBno', 'status', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['oritemid', 'crtby', 'updby'], 'integer'],
            [['reason'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['AWBno', 'status'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oritemid' => 'Oritemid',
            'AWBno' => 'Awbno',
            'status' => 'Status',
            'reason' => 'Reason',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
