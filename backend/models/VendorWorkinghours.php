<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_workinghours".
 *
 * @property integer $vwid
 * @property integer $vid
 * @property string $day
 * @property string $shift
 * @property integer $timefrom
 * @property integer $timeto
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class VendorWorkinghours extends \yii\db\ActiveRecord
{
    public $timetoevening='';
    public $timefromevening='';
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor_workinghours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['vid', 'day', 'shift', 'timefrom', 'timeto', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [[ 'shift', 'timefrom', 'timeto'], 'required'],
            [[ 'shift', 'timefrom', 'timeto','timefromevening', 'timetoevening'], 'string'],
            [['vid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['day'], 'integer', 'max' => 10],
            [['isdayoff'], 'integer', 'max' => 2],
            [['shift'], 'string', 'max' => 2],
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1'],
            ['updby', 'default', 'value' => isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id:'1']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vwid' => 'Vwid',
            'vid' => 'Vid',
            'isdayoff'=>'',
            'day' =>' ',
            'shift' => 'Shift',
            'timefrom' => '',
            'timeto' => '',
            'timefromevening' => '',
            'timetoevening' => '',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'wkday' =>'',
            'fromshift1' =>'',
            'toshift1' =>'',
            'fromshift2' =>'',
            'toshift2' =>''
        ];
    }
}
