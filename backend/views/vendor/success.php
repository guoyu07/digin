<h3><b>Thank You for choosing Digin. You are now registered as Vendor. You would receive an email & SMS with login details on your registered email and mobile number. </b></h3>

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