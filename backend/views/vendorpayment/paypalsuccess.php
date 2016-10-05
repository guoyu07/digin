<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$txnid=$_GET['cm'];
?>

<h3><b>Thank You for choosing Digin. You are now registered as Vendor. You would receive an email & SMS with login details on your registered email and mobile number. Your Transaction ID for this transaction is <?= $txnid?>.</b></h3>

<script type="text/javascript">   
function Redirect() 
{   
   <?php if(Yii::$app->user->isGuest) {?>
    window.location="http://<?=$_SERVER['SERVER_NAME'] ?>/index.php";
   <?php }else { ?>
    window.location="http://<?=$_SERVER['SERVER_NAME'] ?>/index.php";
    <?php } ?>  
} 
//You will be redirected to a new page in 5 seconds 
setTimeout('Redirect()', 10000);   
</script>