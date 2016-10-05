<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_leads".
 *
 * @property integer $vlid
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $website
 * @property string $businessname
 * @property integer $vendor_type
 * @property string $phone1
 * @property string $phone2
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property integer $pin
 * @property integer $plan
 * @property integer $crtby
 * @property integer $updby
 * @property string $conversion_date
 */
class Vendorleads extends \yii\db\ActiveRecord
{
    public $excelfile=null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor_leads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
       return [
            [['crtby', 'updby'], 'required'],
           // [['vendor_type', 'pin', 'crtby', 'updby','frid','Is_convert'], 'integer'],
            [['pin', 'crtby', 'updby','frid','Is_convert','Is_converted_by'], 'integer'],
            [['conversion_date','excelfile'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['website', 'businessname'], 'string', 'max' => 200],
            [['phone1', 'phone2'], 'string', 'max' => 15],
           
            [['city', 'state'], 'string', 'max' => 30],
            [['excelfile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'vlid' => 'Vlid',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'website' => 'Website',
            'businessname' => 'Businessname',
            'vendor_type' => 'Vendor Type',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'pin' => 'Pin',            
            'crtby' => 'Crtby',
            'updby' => 'Updby',
            'conversion_date' => 'Conversion Date',
            'excelfile' => 'Upload File',
            'Is_convert'=> 'Convert',
            
        ];
    }

  public function getFranchisee()
        {
            return $this->hasOne(Franchisee::className(), ['frid' => 'frid']);
        }
   
   public function getFranchexecutive()
        {
         $frnchiseeid = \backend\models\FranchiseeUser::find()->where(['userid'=> \Yii::$app->user->identity->id])->one();
  $alluser = \backend\models\FranchiseeUser::find()->where(['frid'=> $frnchiseeid['frid']])
                                                  ->andWhere(['!=','userid', \Yii::$app->user->identity->id])
                                                  ->all();
  $alluserarr = array();
  foreach ($alluser as $allusr){
      array_push($alluserarr, $allusr['userid']); 
  }
  $alluserstring = implode(',', $alluserarr);
   foreach ($alluser as $allusr){
  $frnchnm = \backend\models\UserDetail::find()->where(['user_id'=> $allusr['userid']])
                                                      ->andWhere(['role'=>'Franchisee Executive'])
                                                      ->one();
  return $frnchnm['firstname']." ".$frnchnm['lastname'];
      }

   }
        
 
}
