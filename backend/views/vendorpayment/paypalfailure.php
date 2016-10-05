<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$amount=$_GET['amt'];
$txnid=$_GET['cm'];
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/style.css" />
<div class="row wishOrderName" style="height: 400px;">
<div class="col-xs-12"> <div class="clearfix OrderList">
         <div class="wishDilvrName">
             Sorry, your payment of Rs. <?=$amount?> has been declined by PayPal. Your transaction id for this transaction is <?=$txnid?>. 
             You would receive an email by PayPal. 
         </div>                             
         </div>
</div>
</div>