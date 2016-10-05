<?php
use ijackua\sharelinks\ShareLinks;
use \yii\helpers\Html;

/**
 * @var yii\base\View $this
 */

?>

<?php 
   $url=Yii::$app->getRequest()->getAbsoluteUrl(); 
   $vid=  explode("=", $url);
   //echo $vid[2];
   $vendor=  \backend\models\Vendor::find()->where(['vid'=>$vid[2]])->one();
   //echo $vendor['lat'].", ".$vendor['lng']; 
   $shareurl="http://maps.google.com/maps?q=".$vendor['lat'].",".$vendor['lng']."&ll=".$vendor['lat'].",".$vendor['lng']."1&z=17";
   //echo $shareurl;   ?>

<div class="socialShareBlock" style="vertical-align: top;">
    <?= 
    Html::a('<img  src="../../../../advanced/images/social/facebook.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_FACEBOOK, $shareurl, true),
            ['title' => 'Share map to Facebook']) ?>
    <?=
    Html::a('<img  src="../../../../advanced/images/social/twitter.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_TWITTER, $shareurl, true),
            ['title' => 'Share map to Twitter']) ?>
    <?=
    Html::a('<img  src="../../../../advanced/images/social/linkedin.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_LINKEDIN, $shareurl, true),
            ['title' => 'Share map to LinkedIn']) ?>
    <?=
    Html::a('<img  src="../../../../advanced/images/social/google_plus.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_GPLUS, $shareurl, true),
            ['title' => 'Share map to Google Plus']) ?>
       
   
</div>


