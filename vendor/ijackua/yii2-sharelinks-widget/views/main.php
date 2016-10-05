<?php
use ijackua\sharelinks\ShareLinks;
use \yii\helpers\Html;

/**
 * @var yii\base\View $this
 */

?>

<div class="socialShareBlock" style="vertical-align: top;">
    <?= 
    Html::a('<img  src="images/social/facebook.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_FACEBOOK, null, false),
            ['title' => 'Share to Facebook']) ?>
    <?=
    Html::a('<img  src="images/social/twitter.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_TWITTER, null, false),
            ['title' => 'Share to Twitter']) ?>
    <?=
    Html::a('<img  src="images/social/linkedin.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_LINKEDIN, null, false),
            ['title' => 'Share to LinkedIn']) ?>
    <?=
    Html::a('<img  src="images/social/google_plus.png" style="width:32px;height: 32px;"></img>', $this->context->shareUrl(ShareLinks::SOCIAL_GPLUS, null, false),
            ['title' => 'Share to Google Plus']) ?>
    
   
   
</div>


