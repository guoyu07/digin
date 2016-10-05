<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "smssetting".
 *
 * @property integer $SMSid
 * @property string $SMSUserNm
 * @property string $SMSPassword
 * @property boolean $SMSActive
 * @property string $SMSSenderID
 * @property string $SMSIP
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Smssetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smssetting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SMSUserNm', 'SMSPassword', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['SMSActive'], 'boolean'],
            [['crtdt', 'upddt'], 'safe'],
            [['crtby', 'updby'], 'integer'],
            [['SMSUserNm', 'SMSPassword', 'SMSSenderID', 'SMSIP'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SMSid' => 'Smsid',
            'SMSUserNm' => 'Smsuser Nm',
            'SMSPassword' => 'Smspassword',
            'SMSActive' => 'Smsactive',
            'SMSSenderID' => 'Smssender ID',
            'SMSIP' => 'Smsip',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
    
    public function getUrl($orderid, $phone)
    {
        $smsdata= Smssetting::find()->one();        
        $unm=$smsdata['SMSUserNm'];
        $pass=$smsdata['SMSPassword'];
        $senderid=$smsdata['SMSSenderID'];
        //$msg="Your order is received successfully. We will deliver it very soon. Your order id is ".$orderid.". Thank you.";    
        $msg="We have received your order. Your order id is ".$orderid.". We have sent order details to vendor. Thank you.";    
       
        //$userdata=\dektrium\user\models\User::find()->select('phone')->where(['id'=>\Yii::$app->user->identity->id])->one();
        //$mobno=$userdata['phone'];
        
        $url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$unm."&pass=".$pass."&senderid=".$senderid."&dest_mobileno=".$phone."&message=".$msg."&response=Y";
        return urlencode($url);
    }
    
     public function getUrlWithPhone($pwd, $phn)
    {
        $smsdata= Smssetting::find()->one();        
        $unm=$smsdata['SMSUserNm'];
        $pass=$smsdata['SMSPassword'];
        $senderid=$smsdata['SMSSenderID'];
        $msg="Your password is changed. Please login with ".$pwd." this password.";                   
        
        $url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$unm."&pass=".$pass."&senderid=".$senderid."&dest_mobileno=".$phn."&message=".$msg."&response=Y";
        return rawurlencode($url);
        //return $url;
    }

/***********************lead sms on vendor info page**********************************/
  public function getUrlWithPhone1($message,$businessname,$phn,$name,$phn1)
    {
        $smsdata= Smssetting::find()->one();        
        $unm=$smsdata['SMSUserNm'];
        $pass=$smsdata['SMSPassword'];
        $senderid=$smsdata['SMSSenderID'];    	   
        //$msg= "Hii, ".$message ." , Enquirer Name is:".$name ." , Enquirer Phone No: ".$phn1 ." "; 
        $msg = "DGENQ-".$businessname." l ".$message." l From:".$name ." l ".$phn1 ." ";
		$url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$unm."&pass=".$pass."&senderid=".$senderid."&dest_mobileno=".$phn."&message=".$msg."&response=Y";
        return rawurlencode($url);
        //return $url;
    }

    public function sendMessage($url)
    {
        $ch = curl_init();                    // initiate curl
       
        $url1=  rawurldecode($url);         
        $url2=  str_replace(' ','%20', $url1);
        curl_setopt($ch, CURLOPT_URL,  $url2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format

        $output = curl_exec ($ch); 
        //echo $output; 
    }

   
	/*********************** sms on index page**********************************/
  public function getUrlWithSms($message,$phn,$name)
    {
        $smsdata= Smssetting::find()->one();        
        $unm=$smsdata['SMSUserNm'];
        $pass=$smsdata['SMSPassword'];
        $senderid=$smsdata['SMSSenderID']; 

		//$sms = explode(',' , $phn);
		$smsno = "8408883838, 8408883837";
		
		//array_push($sms, $smsno);		
        	    
        $msg = "DGENQ-".$message." l From:".$name ." l ".$phn ." "; 
		$url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$unm."&pass=".$pass."&senderid=".$senderid."&dest_mobileno=".$smsno."&message=".$msg."&response=Y";
        return rawurlencode($url);
    }

}
