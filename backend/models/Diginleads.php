<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "diginleads".
 *
 * @property integer $id
 * @property integer $vid
 * @property string $leadType
 * @property string $leadName
 * @property string $leadEmail
 * @property string $leadPhone
 * @property string $crtdt
 */
class Diginleads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'diginleads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'leadType', 'leadName', 'leadEmail', 'leadPhone', 'crtdt'], 'required'],
            [['vid'], 'integer'],
            [['crtdt'], 'safe'],
            [['leadType'], 'string', 'max' => 4],
            [['leadName'], 'string', 'max' => 100],
            [['leadEmail'], 'string', 'max' => 200],
            [['leadPhone'], 'string', 'max' => 15],
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
            'leadType' => 'Lead Type',
            'leadName' => 'Contact Name',
            'leadEmail' => 'Contact Email',
            'leadPhone' => 'Contact No',
            'crtdt' => 'Date',
        ];
    }
   public function getVendername($vid)
    {
        $venname=  Vendor::find()->where(['vid'=>$vid])->one();
        return $venname['firstname'];
		
    }
}
