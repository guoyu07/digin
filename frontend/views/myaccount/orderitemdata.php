
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li class="active">Order Item Information</li>
             </ul>
        <?php $orderno = $_GET['orderno'] ?>
        <div class="col-sm-4" style="font-size: 14px;"><?php echo '<h4>Order No:-'.' '.$orderno.'</h4>' ;?></div> <br>
  <?php   
  
  foreach ($orderinteminfo as $o){      
      //echo json_encode($o['prid']);
       echo '<br><div class="row"></div>
          <div class="col-sm-2 text-center"><a href="index.php?r=search/searchproducts&prid='.$o['prid'].'"><img class="img-responsive moboSingle" alt="" src='.$o['Image'].'></a></div>
          <div class="col-sm-3">
          <h4><a href="index.php?r=search/searchproducts&prid='.$o['prid'].'">'.$o['prodname'].'</a></h4>
          </div>
        <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
          <p class="label">Price</p>
          <p class="value"><span id="price_'.$o['vpid'].'">'.$o['rate'].'</span></p>
        </div>
        <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
          <p class="label">Quantity</p>
          <p class="value">'.$o['quantity'].'</i></p>              
        </div>
        <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue totalCost">
          <p class="label">Total</p>
          <p class="value"><span id="total_'.$o['vpid'].'">'.$o['producttotal'].'</span></p>             
          </div>
          <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue ship" style="margin-top: 10px; margin-left: 415px;"><p class="label">Shipping </p>
             '.$o['shipment'].'</div>  ';        
  }?>
      
        <div style="margin-left: 900px;">
       
        <div class="col-xs-12 section-footer"><a href="index.php?r=myaccount/viewaddress" class="continueforShop">Back</a>
<!--            <a href="index.php?r=address/viewaddress&userid=< ?php echo Yii::$app->user->identity->id;?>" class="sellerAddressButton">Choose Address & Shipping Details</a></div>-->
        </div>
       </div>
 </div>     
  


    
    
    

          
    
      