<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];

$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];

//$salt="9A1hD1YQ2e";    //old 
$salt = "WoWSFxRLGG";    //new
$udf1=$_POST["udf1"];
$udf2=$_POST["udf2"];


If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq =   $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         
                
  }
	else {	  

        //$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
        $retHashSeq = $salt.'|'.$status.'|||||||||'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
           
    }

   $hash = hash("sha512", $retHashSeq);
                 
    if ($hash != $posted_hash) { ?>
	       
         <div class="row" style="height: 400px;">
           <div class="col-xs-12"> 
             <div class="clearfix OrderList">
               <div class="wishDilvrName">
            <p>It seems you have canceled your transaction to continue shopping <a href=http://digin.in/advanced/frontend/web/index.php>click here.</a></p>
              </div>                             
           </div>
       </div>
   </div>  

     <?php       
         
            }
	   else {

         //echo "<h3>Your order status is ". $status .".</h3>";
         //echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
          
	//    } 
?>
<div class="row wishOrderName" style="height: 400px;">
<div class="col-xs-12"> <div class="clearfix OrderList">
         <div class="wishDilvrName">
              Your payment of Rs. <?=$amount?> has been declined by PayUMoney or you have canceled the transaction. Reference number for this transaction is <?=$txnid?>. 
             You may try making the payment by clicking the link below.
         </div>                             
         </div>

<p><b><a href=https://digin.in/index.php> Try Again</a></b></p>
</div>
    
</div>
           <?php } ?>
<!--Please enter your website homepagge URL -->
<!--<p><a href=http://localhost/testing/success_failure/PayUMoney_form.php> Try Again</a></p>-->
