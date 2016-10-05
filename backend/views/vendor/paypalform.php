<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
  <head>
  <script type="text/javascript">
   
    function submitPayuForm() {
 
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">

      <h2><b>Redirecting to Payment Gateway....</b></h2>
        
      
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"  name="payuForm">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="sachin@digin.in">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>">
<input type="hidden" name="currency_code" value="<?php echo (empty($posted['currcode'])) ? '' : $posted['currcode']?>">
<input type="hidden" name="paymentaction" value="sale">
<input type="hidden" name="custom" value="<?php echo (empty($posted['txnid'])) ? '' : $posted['txnid']?>">
<input type="hidden" name="return" value="http://digin.in/advanced/backend/web/index.php?r=vendorpayment/paymentsuccessforpaypal" />      
<!--input type="hidden" name="cancel_return" value="http://digin.in/advanced/backend/web/index.php?r=vendorpayment/paymentfailureforpaypal" /-->
<input type="hidden" name="cancel_return" value="http://digin.in/advanced/backend/web/index.php?r=vendorpayment/paymentfailure&txnid=<?=$posted['txnid']?>" />
<!--<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">-->
<!--input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online."-->
<!--img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1"-->
</form>

  </body>
  </html>