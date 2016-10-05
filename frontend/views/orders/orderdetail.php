<!--    <div class="searchMobile">
      <div>
        <input type="text" placeholder="Select Location " class="locationInput">
      </div>
      <div>
        <input type="text" placeholder="Search" class="searchInput">
        <button type="submit" class="searchButton">GO </button>
      </div>
    </div>-->

<div class="container sectionWrap">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <!--li><a href="#">Orders</a></li-->
        <li class="active">Orders</li>
      </ul>
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
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

       // $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        $retHashSeq = $salt.'|'.$status.'|||||||||'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
          //echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          //echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          //echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
            
?>
 
         <div class="row wishOrderName">
             <div class="col-xs-12"> <div class="clearfix OrderList">
                <div class="wishOrderName">
                    <h2>Order No. : &nbsp;  &nbsp;  &nbsp;</h2></div> 
                     <div class="wishDilvrName" style="margin-left: 170px;"><?php echo $orderdetails[0][0]['displayid'] ; ?></div>
                           
          </div>
          </div>
          
          <div class="col-xs-12"> <div class="clearfix OrderList">
          <div class="wishOrderName">
           <h2>Delivery Address : </h2>
           <p> <div class="wishDilvrName" style="margin-left: 170px;">
              <?php echo $orderdetails[1][0]['name']; ?><br>
              <?php echo $orderdetails[1][0]['address1']; ?>,<br>
              <?php echo $orderdetails[1][0]['address2']; ?>,
              <?php echo $orderdetails[1][0]['city']; ?>,<br>
              <?php echo $orderdetails[1][0]['state']; ?><br>
              <?php echo "<b>PIN:</b>&nbsp;&nbsp;".$orderdetails[1][0]['pin']; ?><br>
              <b>phone:</b>   <?php echo $orderdetails[1][0]['phone']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Email:</b>   <?php echo $orderdetails[1][0]['email']; ?> <br>
            
             </div>
          </div>
          </div>
          </div>
          
          <div class="col-xs-12"> <div class="clearfix OrderList">
          <div class="wishOrderName">
            <h2>Order Details :</h2>
            </div><br>
             <div class="wishOrderName" style="margin-left: 170px;">
                 <table class="table1 table border">
                     <tr>
                       <th class="special">Sr No.</th>
                       <!--th class="th1 special">Product Image</th-->
                          <th class="special">Product Name</th>		
                          <th class="special">Quantity</th>
                          <th class="special">Price</th>
                          <th class="special">Subtotal</th>
                          <th class="special">Shipping</th>
                        </tr>
                        
                        <?php 
                        $sr = 0;
                        $total = 0;
                        foreach ($orderdetails[2] as $ord){
                           $sr = $sr +  1; 
                        ?>
                     <tr>
                          <td class="td1"><?php echo $sr; ?></td>
                          <!--td class="td1"><div><?php// echo '<img src="'.$ord['Image'].'" style="max-width:100%; width:40px;">'; ?></div></td-->
                          <td class="td1"><?php echo $ord["prodname"];  echo "<br>- <b>By</b> ".$ord["businessname"]; ?></td>		
                          <td class="td1"> <?php echo $ord["quantity"]; ?></td>
                          <td class="td1"> <?php echo $ord["rate"]; 
                          $total = $total + $ord["producttotal"]?></td>
                          <td class="td1"> <?php echo $ord["producttotal"]; ?> </td>
                          <td class="td1"> <?php echo $ord["shipping"]; ?> </td>
                         </tr>
                        
                        <?php } ?> 
                        
                 </table>
            </div>
      </div>
          </div>
          
          <div class="col-xs-12">          
            <div class="row orderList">
<!--          <div class="col-xs-4 col-sm-2 col-sm-push-1 orderValue totalOrderCost">
          <p class="label">Total</p>
          <p class="value"><?php //echo $total; ?></p>
          </div>-->
          <div class="col-xs-4 col-sm-2 col-sm-push-1 orderValue totalOrderCost">
          <p class="label">Shipping Total</p>
          <p class="value"><?php echo $orderdetails[0][0]['shipment']; ?></p>
           </div>
          <div class="col-xs-4 col-sm-2 col-sm-push-1 orderValue totalOrderCost">
          <p class="label">Gross Total</p>
          <p class="value"><?php echo $orderdetails[0][0]['grosstotal']; ?></p>
           </div>
           </div>
          </div>
          
                 
                
      </div>
<?php }  ?>
    </div>
   