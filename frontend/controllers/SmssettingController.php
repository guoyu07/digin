<?php

namespace frontend\controllers;


class SmssettingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

  /*  public function actionMessage()
    {               
        $smsdata= \frontend\models\Smssetting::find()->one();        
        $unm=$smsdata['SMSUserNm'];
        $pass=$smsdata['SMSPassword'];
        $senderid=$smsdata['SMSSenderID'];
        $msg="Your order is received successfully. We will deliver it very soon. Thank you.";
        
       
        $userdata=\dektrium\user\models\User::find()->select('phone')->where(['id'=>\Yii::$app->user->identity->id])->one();
        $mobno=$userdata['phone'];
        
        $url="http://www.smsjust.com/blank/sms/user/urlsms.php?username=".$unm."&pass=".$pass."&senderid=".$senderid."&dest_mobileno=".$mobno."&message=".$msg."&response=Y";
        echo urlencode($url);
        
    } */
}
