<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
//$salt="9A1hD1YQ2e";   //old
$salt="WoWSFxRLGG";   //new

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
      //  $retHashSeq = $salt.'|'.$status.'|||||||||'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
	
       if ($hash != $posted_hash) {   	        
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
          //echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          //echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
         // echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
           
		   }         
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