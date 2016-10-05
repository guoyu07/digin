<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendorreceivablepaytype".
 *
 * @property integer $vrid
 * @property integer $vid
 * @property integer $ptypeid
 */
class VendorReceivablePayType extends \yii\db\ActiveRecord
{
    //public $ptypeidarray=array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendorreceivablepaytype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'ptypeid','chq_date'], 'required'],
            [['vid', 'ptypeid'], 'integer'],
            [['chq_no'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vrid' => 'Vrid',
            'vid' => 'Vid',
            'ptypeid' => 'Payment Type',
            'chq_no'=> 'Cheque No',
            'chq_date' => 'Cheque Date',

            //'ptypeidarray' => 'Payment Type'
        ];
    }
}
