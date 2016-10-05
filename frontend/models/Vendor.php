<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Vendor".
 *
 * @property integer $vid
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $website
 * @property string $businessname
 * @property string $logo
 * @property integer $vendtor_type
 * @property string $phone1
 * @property string $phone2
 * @property string $aboutme
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $pin
 * @property double $lat
 * @property double $lng
 * @property string $googleaddr
 * @property integer $plan
 * @property string $subscriptionenddate
 * @property string $shift
 * @property integer $user_id
 * @property integer $payment
 * @property integer $delivery
 * @property integer $dppkgid
 * @property integer $Is_blocked
 * @property integer $Is_active
 * @property integer $isbyfranchisee
 * @property string $txnid
 * @property string $status
 * @property string $pwd
 * @property string $currencycode
 * @property string $payu_pal_id
 * @property string $paymentgateway
 * @property integer $clicks
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Vendor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'website', 'businessname', 'vendtor_type', 'phone1', 'phone2', 'aboutme', 'address1', 'address2', 'city', 'state', 'country', 'pin', 'lat', 'lng', 'googleaddr', 'plan', 'subscriptionenddate', 'shift', 'user_id', 'payment', 'delivery', 'dppkgid', 'Is_blocked', 'txnid', 'status', 'pwd', 'currencycode', 'payu_pal_id', 'paymentgateway', 'clicks', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['vendtor_type', 'pin', 'plan', 'user_id', 'payment', 'delivery', 'dppkgid', 'Is_blocked', 'Is_active', 'isbyfranchisee', 'clicks', 'crtby', 'updby'], 'integer'],
            [['aboutme', 'googleaddr'], 'string'],
            [['lat', 'lng'], 'number'],
            [['subscriptionenddate', 'crtdt', 'upddt'], 'safe'],
            [['firstname', 'lastname', 'logo', 'country'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['website', 'businessname'], 'string', 'max' => 200],
            [['phone1', 'phone2'], 'string', 'max' => 15],
            [['address1', 'address2', 'paymentgateway'], 'string', 'max' => 50],
            [['city', 'state', 'txnid', 'status', 'pwd', 'payu_pal_id'], 'string', 'max' => 30],
            [['shift'], 'string', 'max' => 2],
            [['currencycode'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vid' => 'Vid',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'website' => 'Website',
            'businessname' => 'Businessname',
            'logo' => 'Logo',
            'vendtor_type' => 'Vendtor Type',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'aboutme' => 'Aboutme',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'pin' => 'Pin',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'googleaddr' => 'Googleaddr',
            'plan' => 'Plan',
            'subscriptionenddate' => 'Subscriptionenddate',
            'shift' => 'Shift',
            'user_id' => 'User ID',
            'payment' => 'Payment',
            'delivery' => 'Delivery',
            'dppkgid' => 'Dppkgid',
            'Is_blocked' => 'Is Blocked',
            'Is_active' => 'Is Active',
            'isbyfranchisee' => 'Isbyfranchisee',
            'txnid' => 'Txnid',
            'status' => 'Status',
            'pwd' => 'Pwd',
            'currencycode' => 'Currencycode',
            'payu_pal_id' => 'Payu Pal ID',
            'paymentgateway' => 'Paymentgateway',
            'clicks' => 'Clicks',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
		/***************************getVendorClicks*******************************/
      
    public function getVendorClicks($vid)
    {
        $vpid = \backend\models\Vendor::find()->where(['user_id'=>$vid])->one();
        return $vpid['clicks'];
    }
    
    public function getVendorProductName($vid)
	{
		$vendorProduct = \backend\models\VendorProducts::find()->where(['vid'=>$vid])->all();
		foreach($vendorProduct as $vp)
		{
			$prodname = \backend\models\Product::findOne(['prid'=>$vp['prid']]);
			return $prodname['prodname'];
		}
	}
	
   public function getVendorImpression($vid)
    {
         $diginimps = 0;
         $vpid = \backend\models\Vendor::find()->where(['user_id'=>$vid])->one();
        $query2 = (new \yii\db\Query())  
                  ->select(['vp.vid','vp.vpid','vp.digin_impression'])
                  ->from('vendor_products vp')
                  ->where(['vp.vid'=>$vpid['vid']]);
        $vendorsimpesn=$query2->all();
        foreach ($vendorsimpesn as $vp){
            $diginimps = $diginimps +$vp['digin_impression'];
            
        }
        return $diginimps;
     }
     
       public function getTotalOrdersOfVendor($vid)
    {
       $vpid = \backend\models\Orders::find()->where(['userid'=>$vid])->all();
        $ordertotal = sizeof($vpid);
        return $ordertotal;
    }
    
     public function getVidbusiness()
  {
        $vendor = \backend\models\Vendor::find()->where(['user_id' =>Yii::$app->user->identity->id])->one();
        return $vendor['businessname'];
  }
}
