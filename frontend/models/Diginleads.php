<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "diginleads".
 *
 * @property integer $id
 * @property integer $vid
 * @property integer $leadType
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
            [['vid', 'leadName', 'leadEmail', 'leadPhone', 'crtdt'], 'required'],
            [['vid', 'leadType'], 'string'],
            [['crtdt'], 'safe'],
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
            'leadName' => 'Lead Name',
            'leadEmail' => 'Lead Email',
            'leadPhone' => 'Lead Phone',
            'crtdt' => 'Crtdt',
        ];
    }
	
		
 public function getVendername($vid)
    {
        $venname=  Vendor::find()->where(['vid'=>$vid])->one();
        return $venname['firstname'];
		
    }
    
 public function getSmsCount($vid)
    {
         $vid = Diginleads::find()->where(['leadType'=>'sms'])
                                ->andWhere(['vid'=>$vid])
                                 ->all();
        $cntsms = sizeof($vid);
        //var_dump($vid);
        return $cntsms;
    }
  
  public function getEmailCount($vid)
    {
        $vid = Diginleads::find()->where(['leadType'=>'email'])
                                ->andWhere(['vid'=>$vid])
                                 ->all();
        $cntemail = sizeof($vid);
        //var_dump($vid);
        return $cntemail;
    }
    
    public function getTotalLead($vid)
    {
       $vpid = \backend\models\Vendor::find()->where(['user_id'=>$vid])->one();
        $vid = Diginleads::find()->Where(['vid'=>$vpid['vid']])->all();
        $cnttotal = sizeof($vid);
       // var_dump($cnttotal);
        return $cnttotal;
    }
    
   

}
