<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

//$this->title = $name;
?>
<div class="site-error" style="height: 350px;">

    <h1><!--?= Html::encode($this->title) ?--></h1>
    <div class="alert alert-danger" >
        <!--?= nl2br(Html::encode($message)) ?-->
       <p>
            Oops this is Embarrassing.....
        </p>
        <p>
            We encountered a technical error, while doing your requested operation. Please contact Site Administrator or try again later.
        </p>
    </div>

    

</div>
