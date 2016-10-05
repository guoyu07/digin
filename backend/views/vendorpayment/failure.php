<?php
if(isset($data) && $data!="" && sizeof($data)>0){   ?>
    <h3><b> Sorry, your payment of <?=$data['currcode']."&nbsp;".$data['amt']?> has been declined by PayPal. Your transaction id for this transaction is <?=$data['txnid']?>. 
        You would receive an email by PayPal. </b></h3>
<?php }
else{
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

         //echo "<h3>Your order status is ". $status .".</h3>";
         //echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
          
	//    } 
?>
        <h3><b>Sorry, your payment of Rs. <?=$amount?> has been declined by PayUMoney. Your transaction id for this transaction is <?=$txnid?>. You would receive an email by PayUmoney.   </b></h3>
         
<?php }  }?>


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