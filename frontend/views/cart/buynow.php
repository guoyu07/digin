<style>
.loadingDiv
{
    top:20%;
     left:40% ;
     position:absolute;
     z-index: 100;
        
}
.load {
  width: 200px;
  height: 200px;  
  background:url(http://www.cuisson.co.uk/templates/cuisson/supersize/slideshow/img/progress.BAK-FOURTH.gif) no-repeat center center; 
}


</style>
<script type="text/javascript" src="./js/sha512.js"></script>

    <!--div class="searchMobile">
      <div>
        <input type="text" placeholder="Select Location " class="locationInput">
      </div>
      <div>
        <input type="text" placeholder="Search" class="searchInput">
        <button type="submit" class="searchButton">GO </button>
      </div>
    </div-->
    <div class="loadingDiv" id="loading">       
 
      <img class="load"></div>
    
    <div class="container sectionWrap">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li class="active">Shopping Cart</li>
        <!--li class="active">Offers</li-->
      </ul>
        
  <?php   //var_dump($delivery);  
        //var_dump($cart);
    //echo $delivery[0][453]; echo $delivery[1][4566];
    //echo "Address size:...".sizeof($address);
  foreach ($cart as $c){      
       echo '<div class="row cartList" id="cartitem_'.$c['vpid'].'">
          <div class="col-sm-2 text-center"> <img class="img-responsive moboSingle" alt="" src='.$c['Image'].'> </div>
          <div class="col-sm-3">
          <h4>'.$c['prodname'].'</h4>
          <h4 class="sellerName"><span>By:<a href="index.php?r=search/searchvendors&vid='.$c['vid'].'" class="link">'.$c['businessname'].'</span></h4></a>
              
        </div>
                      
        <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
          <p class="label">Price</p>
          <p class="value">Rs.<span id="price_'.$c['vpid'].'">'.$c['price'].'</span></p>
        </div>
        <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
          <p class="label">Quantity</p>
          <p class="value"><i class="fa fa-minus remove" id="cartm_'.$c['vpid'].'" style="cursor:pointer;"></i><span id="dis_'.$c['vpid'].'">'.$_SESSION['buynow'][$c['vpid']].'</span><i class="fa fa-plus add" id="cartp_'.$c['vpid'].'" style="cursor:pointer;"></i></p>              
        </div>
        <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue totalCost">
          <p class="label">Total</p>
          <p class="value" >Rs.<span id="total_'.$c['vpid'].'">'.$_SESSION['buynow'][$c['vpid']]*$c['price'].'</span></p>             
          </div>            
          <a href="#" class="cta delete" id="remove_'.$c['vpid'].'">Remove</a>';         
    /*   if(sizeof($address)>0)
       {                                  
             $deliverable=$delivery[0][$c['vpid']];
             
            if($deliverable==0) {
                echo '<b><div id="chkdelivery_'.$c['vpid'].'"  class="delvr" style="margin-top: 50px; margin-right: 60px; color: red;">Selected vendor does not deliver this product to the selected shipping address.</div></b>';
            }
            if($delivery[1][$c['vpid']]==2){
                echo '<b><div id="chkdelivery_'.$c['vpid'].'" class="delvr" style="margin-top: 50px; margin-right: 60px; color: red;">Selected vendor does not deliver this product. You need to pick up the product from vendor.</div></b>';
            }
       }
       else{
           if($delivery[1][$c['vpid']]==2){
                echo '<b><div id="chkdelivery_'.$c['vpid'].'" class="delvr" style="margin-top: 50px; margin-right: 60px; color: red;">Selected vendor does not deliver this product. You need to pick up the product from vendor.</div></b>';
            }
       }      */
       echo '<b><div id="chkdelivery_'.$c['vpid'].'" style="margin-top: 50px; margin-right: 60px; color: red;"></div></b>';
      
       echo '<div class="col-xs-4 col-sm-2 col-sm-push-1 productValue ship" style="margin-top: 10px; margin-left: 415px;"><p class="label">Shipping </p>
             Rs.<span id="shipping_'.$c['vpid'].'"></span></div>  </div> ';      
           // $totalpymnt = $totalpymnt + $c['total']; 
     
         }
         echo '<b><div class="blank" style="color:red;"></div></b>';
    ?>
        
 <div class="row finalCost">
        <div class="col-xs-6">Total Payment</div>
        <div class="col-xs-6 text-right">Rs.<span id="grandtotal"></span></div>
        <div class="col-xs-12 section-footer"><a href="index.php" class="continueforShop">Continue to Shopping </a>
<!--            <a href="index.php?r=address/viewaddress&userid=< ?php echo Yii::$app->user->identity->id;?>" class="sellerAddressButton">Choose Address & Shipping Details</a></div>-->
      </div>
    </div>
        
<script type="text/javascript">
 $(document).ready(function(){ 
    
    var shippingdata='';
    var saveshipping='';
    request='B';
      function getshipping(){
          $.ajax({                        
                type:"GET",
                url:"index.php?r=cart/shipmenttotal", 
                data:{pincode:$("#pinhidden").val(),
                    type:request
                   },
                success:  function(result) { 
                   //alert(result);
                   shippingdata=jQuery.parseJSON(result);
                   
                   if(shippingdata[0]!="" && shippingdata[0]!=null)                   
                   {
                       <?php if(sizeof($address)>0){?>
                       $("#pay").removeClass("btn btn-danger disabled");
                       <?php }?>
                   var st=0; var gt=0; var total=0;  var vpid=0;
                   $.each(shippingdata[0],function(index, value) {
                     vpid=value['vpid']; 
                     saveshipping=shippingdata[0];
                       $("#shipping_"+value['vpid']).html(value['shipping']);
                       st=st+value['shipping'];
                       total=value['itemtotal']+value['shipping'];
                       gt=gt+total;
                       //alert(st);
                       if(value['shipping']!=0){
                           //alert("delivered..."+value['vpid']);
                           $("#chkdelivery_"+value['vpid']).html("");
                           //alert(shippingdata[1][vpid]);
                       }
                       else{
                           //alert(shippingdata[1][vpid]);
                           if(shippingdata[1][vpid]==0)
                           {
                               $("#chkdelivery_"+value['vpid']).html("Selected vendor does not deliver this product to the selected shipping address.");
                           }
                           if(shippingdata[2][vpid]==2)
                           { 
                               $("#chkdelivery_"+value['vpid']).html("Selected vendor does not deliver this product. You need to pick up the product from vendor.");
                           }
                       }                                          
                   });                  
                   $(".shiptotal").html("Rs."+st);
                   $(".grosstotal").html("Rs."+gt);
                   }
                   //$("#pinhidden").val('');                                                  
               }
         }); 
      }
    
  calculatTotal = function ()
  {
      $('#grandtotal').text('0.00');
      $('#total').text('0.00');
    $('.cartList').each(function(){
       var theids= this.id.split('_');
       var itemtotal = parseFloat(parseInt($('#dis_'+theids[1]).text())*parseFloat($('#price_'+theids[1]).text()));
      $('#total_'+theids[1]).text(itemtotal);
      $('#grandtotal').text(parseFloat($('#grandtotal').text())+itemtotal);
      $('#total').text(parseFloat($('#total').text())+itemtotal);
        });        
  }
   calculatTotal();
 $('#loading').hide();
  $(document)
  .ajaxStart(function () {
      //alert('calling');
     $('#loading').show();
  })
  .ajaxStop(function () {
       //alert('calling');
     $('#loading').hide();
  });   
        
        
     <?php if(sizeof($address) == 0){ ?>
         //alert("No address...");
         $(".blank").html("Please enter at least one address for calculating shipping.");  
     <?php }?>
    
   $(document).on("click",".fa",function(){
   var id_=$(this).attr('id').split("_");
   var quant=0;
   if($(this).hasClass('fa-minus'))
    {        
         quant=parseInt($('#dis_'+id_[1]).text())-1;
    }
    else
    {
        quant=parseInt($('#dis_'+id_[1]).text())+1;            
    }      
   
      $.ajax({
           type:"GET",
           url:"index.php?r=cart/changequantity",          
           data:{vpid:id_[1],
                 quantity:quant},
           success:  function(result) {
                
                if($(this).hasClass('fa-minus'))
                    {
                        if(parseInt($('#dis_'+id_[1]).text())!=0)
                         $('#dis_'+id_[1]).text(quant);
                     }
                    else
                    {
                        $('#dis_'+id_[1]).text(quant);
                    }            
                   calculatTotal();         
                  getshipping();  
            },
             error:function(){
                 alert('There has been a error. Please try again later.');
             },
       }); 
       
    });
    
    
     id='';
      <?php if(isset($address) && $address!=""){
      foreach ($address as $ad){ ?>
           id='<?= $ad['adrid']?>';
           pinhidden='<?= $ad['pin']?>';
           $("#"+id).prop('checked',true);
           $("#pinhidden").val(pinhidden);
         //  return false;
      <?php 
           break;
      } } ?> 
          
        $("#save").click(function(){                  
            $("#addrform").submit();
        });
             
        $("#clear").click(function(){                  
            $("#addrform").trigger("reset"); 
        });     
     
     $(document)
    .ajaxStart(function () {        
       $('#loading').show();
    })
    .ajaxStop(function () {         
       $('#loading').hide();
    });
  
     getshipping();
     
    
      var addrid=id;
       //alert("before...."+addrid);
      $(".selectaddr").change(function(){
          //alert($(this).attr('id'));
          addrid=$(this).attr('id');
          //alert("after..."+addrid);
          //alert($("#pin_"+addrid).text());
          
          $("#pinhidden").val($("#pin_"+addrid).text());
//          if($("#pin_"+addrid).text()=="" || $("#pin_"+addrid).text()==0){
//              alert("Please enter your pincode before calculating shipment.");
//          }
              getshipping();      
      });
      
      
      $(".delete").click(function(){
          var vpid=$(this).attr('id').split("_");
          $.ajax({
           type:"GET",
           url:"index.php?r=cart/removeitem",          
           data:{vpid:vpid[1]},
           success:  function(result) {
                    if(result==1)
                    {                      
                         $('#cartitem_'+vpid[1]).remove();
                         calculatTotal();         
                         getshipping(); 
                    }
                    else
                    {
                        alert("This item could not be removed due to some error.");
                    }                          
            },
             error:function(){
                 alert('There has been a error. Please try again later.');
             },
        });
      });
/******************************************************************
 * 
 * Below code is used for calculating Shipping. When user's pincode is not available, He will enter pincode & then proceed further for calculating shipment
 */   
//      $("#pincode").on('input',function(){
//          $("#pinhidden").val($("#pincode").val());
//      });
           
      
//      $("#ship").click(function(){ 
//         getshipping();                         
//      });
/******************************************************************/    
      
           
    
      $("#pay").click(function(){                
                if($('input[type="radio"]').is(":checked"))
                {   
                      var ref='<?php echo uniqid();?>';  
                      //alert($("#orderform").attr('action'));                      
                      var input='';
                      var sessionshipping=[];
                      $.each(saveshipping,function(index, value) {                             
                         //input= input +'<input type="hidden" name="shipping[]" value="'+value['vpid']+'_'+value['shipping']+'">';                        
                          //alert(input);  
                         sessionshipping.push(value['vpid']+'_'+value['shipping']);
                      });
                      //input=input+'<input type="hidden" name="adrid" value="'+addrid+'"> <input type="hidden" name="ref" value="'+ref+'">';
                      //$('#orderform').append(input); 
                      
                      // location.href="index.php?r=orders/makepayment";
                      //$("#orderform").submit(); 
                      
                         $.ajax({
                        type:"GET",
                        url:"index.php?r=cart/addshippingtosession",          
                        data:{ shipping:sessionshipping,                             
                          },
                        success:  function(result) {
                            //alert(result);
                            console.log("Shipping result: "+result);
                            // var data=jQuery.parseJSON(result);                            
                         },
                          error:function(){
                              alert('There has been a error. Please try again later.');
                          },
                      });                  
                      
                     $("input[name='udf1']").val(addrid);
                     $("input[name='udf2']").val('B');
                 
                    
                    var prodinfo = [];
                    $("input[name='productdetail[]']").each(function() {                      
                        prodinfo.push({                           
                            prodname: $(this).val()
                        });
                    });
                    var jsonString = JSON.stringify(prodinfo);  
                    //alert(jsonString);
                    //console.log(jsonString);
                    //console.log(prodinfo);
                      $("input[name='productinfo']").val(jsonString);
                 //     $("input[name='productinfo']").val("Choclate");
                      $("input[name='amount']").val($(".grosstotal").html().split(".")[1]);
                      $("#name").val($("#nm_"+addrid).text());
                      $("#email").val($("#mail_"+addrid).text());
                      $("#phn").val($("#mob_"+addrid).text());
                  //    $('#payform').attr('action','https://test.payu.in/_payment');      //old url
                      $('#payform').attr('action','https://secure.payu.in/_payment');      //new url
                      
                      //hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
                      var key=$("input[name='key']").val();
                      var txnid=$("input[name='txnid']").val();
                      var amount=$("input[name='amount']").val();
                      var productinfo=jsonString;
               //       var productinfo="Choclate";
                      var firstname=$("input[name='firstname']").val();
                      var email=$("input[name='email']").val();
                  
                 //     var salt="9A1hD1YQ2e";   //old salt
                      var salt="WoWSFxRLGG";   //new salt

                      var udf1=$("input[name='udf1']").val();
                      var udf2=$("input[name='udf2']").val();
                                            
               //       var hashstring=key+'|'+txnid+'|'+amount+'|'+productinfo+'|'+firstname+'|'+email+'|'+'|'+'|'+'|'+'|'+'|'+'|'+'|'+'|'+'|'+  '|'+ salt;
                      var hashstring=key+'|'+txnid+'|'+amount+'|'+productinfo+'|'+firstname+'|'+email+'|'+udf1+'|'+udf2+'|'+'|'+'|'+'|'+'|'+'|'+'|'+'|'+'|' +salt;
                      console.log(hashstring);
                      //Hash generation...                                                                            
                      var hash=sha512(hashstring);
                     //console.log(hash);
                     $("input[name='hash']").val(hash);
                     
                     //Creating order before submitting payUmoney form
                     $.ajax({
                        type:"GET",
                        url:"index.php?r=orders/createorder",          
                        data:{txnid:txnid,
                            udf1:udf1,
                            udf2:udf2,
                          },
                        success:  function(result) {
                            //alert(result);
                            console.log("Order result: "+result);
                            // var data=jQuery.parseJSON(result); 
                            $("input[name='_csrf']").remove();
           /******************Submit PayUmoney Form**************************/
                           $('#payform').submit();
                         },
                          error:function(){
                              alert('There has been a error. Please try again later.');
                          },
                      });  
                  }
                  else{
                       alert("At least one address should be selected");
                  }
                            
       });      
         
});
  
  
</script>
      
      
    

 <?php /**************************************************************************************************************************************************************************************************/ ?>
    
    
 <?php use yii\widgets\ActiveForm;?>
    <div class="container sectionWrap">
<!--      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Address</a></li>
        <li class="active">< ?= $address[0]['name'];?></li>
      </ul>-->
      
      <!--h2 class="sectionHeading"><i class="fa fa-tag"></i><span>My Offer</span></h2-->
       
      <div class="container myAccount">

      <div class="row">
     <?php //var_dump($address); 
     //if(array_key_exists('address1', $address[0]))
        if(sizeof($address)>0){
        foreach ($address as $ad){
    echo     '<div class="col-sm-6">
        <div class="addressBlock">
			 	
			<p class="deliveryAddress">
                        <b><h2><input type="radio" name="address" class="selectaddr" id='.$ad['adrid'].'><span id="nm_'.$ad['adrid'].'">'.$ad['name'].'</span></h2></b>                                    
                '.$ad['address1'].' <br/>
                '.$ad['address2'].' <br/>
                '.$ad['city'].', '.$ad['state'].', '.$ad['country'].',<span id="pin_'.$ad['adrid'].'">'.$ad['pin'].'</span><br/>
                <span id="mob_'.$ad['adrid'].'">'.$ad['phone'].'</span><br/>
                <span id="mail_'.$ad['adrid'].'">'.$ad['email'].'</span>                 
                </p>	
		</div>
        </div>';
        }
     }
     ?>         
   
          <div class="col-xs-12">
          <div id="accordion-first" class="clearfix">
            <div class="accordion" id="accordion2">
              <div class="accordion-group">
                <div class="accordion-headingRed">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"><i class="fa fa-plus-square"></i>
 <em class="icon-fixed-width fa fa-plus pull-right"></em>Add New Address </a> </div>
                <div style="height: 0px;" id="collapseOne" class="accordion-body collapse addressForm">
                  <div class="accordion-inner"> 
                      <div class="address-form">
<?php  $form = ActiveForm::begin(['id'=>'addrform','method' => 'post',
                                    'action' => ['cart/addressforbuynow']]); ?>

                  <div class="row">                  
                  <div class="col-xs-12">
                  <label>Name</label>
                  <input type="text" id="nm" name="username" placeholder="Name" required>
                  </div>
                  
                  <div class="col-sm-6 col-xs-12">
                  <label>Address1</label>
<!--                  <textarea placeholder="Address1" id="addr1"></textarea>-->
                  <input type="text" id="addr1" name="address1" placeholder="Address1" required>
                  </div>  
                      
                  <div class="col-sm-6 col-xs-12">
                  <label>Address2</label>
<!--                  <textarea placeholder="Address2" id="addr2"></textarea>-->
                  <input type="text" id="addr2" name="address2" placeholder="Address2">
                  </div>  
                  
                  <div class="col-sm-4 col-xs-12">
                  <label>City</label>
                  <input type="text" id="city" name="city" placeholder="City" required>
                  </div>
                      
                  <div class="col-sm-4 col-xs-12">
                  <label>State</label>
                  <input type="text" id="state" name="state" placeholder="State" required>
                  </div>                                        
                      
                  <div class="col-sm-4 col-xs-12">
                  <label>Country</label>
                  <input type="text" id="count" name="country" placeholder="Country" required>
                  </div>
                  
                  <div class="col-sm-4 col-xs-12">
                  <label>Pincode</label>
                  <input type="text" id="pin" name="pin" placeholder="Pincode" required>
                  </div>
                  
                  <div class="col-sm-4 col-xs-12">
                  <label>Mobile</label>
                  <input type="text" id="mob" name="phone" placeholder="Mobile Number" required>
                  </div>
                      
                  <div class="col-sm-4 col-xs-12">
                  <label>Email</label>
                  <input type="email" id="mail" name="mail" placeholder="Email Address" required>
                  </div>
                  
                  <div class="col-xs-7">
                  <div class="section-footer">
<!--                      <button class="btn btn-danger" id="save" type="submit">Save</button>                     -->
                       <input type="submit" name="submit" id="save" value="Save" class="btn btn-danger" style="width: 60px;">
                       <input type="button" data-dismiss="modal" id="clear" class="btn btn-default" value="Clear" style="width: 60px;">
<!--                       <button data-dismiss="modal" class="btn btn-default" type="button">Clear</button>-->
                  </div>
                  </div>                        

                  </div>   

               <?php ActiveForm::end(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end accordion --> 
          </div>
        </div>
        
       
      </div>
                
 
<div class="order-form">
<?php /* $form = ActiveForm::begin(['id'=>'orderform','method' => 'post',
                                    'action' => ['orders/addorders']]);*/ ?>
<!--    <input type="hidden" name="shoppingtype" value="B">   -->
<?php //ActiveForm::end(); ?>
</div>
          
      
          <input type="hidden" id="pinhidden" value="">    
          
      <div class="row finalCost">
<!--      <div class="col-xs-6">Total Payment</div> <div class="col-xs-6 text-right total">Rs. < ?= $total;?></div>-->
      <div class="col-xs-6">Total Payment</div> <div class="col-xs-6 text-right">Rs.<span id="total"></span></div>
      <div class="col-xs-6">Shipping Total</div> <div class="col-xs-6 text-right shiptotal">Rs.0 </div>
      <div class="col-xs-6">Grosstotal</div> <div class="col-xs-6 text-right grosstotal">Rs.0 </div>
      
<!--       <div class="col-sm-4 col-xs-12"><br><label>Pincode</label>
            <input type="text" id="pincode" placeholder="Enter a pincode">
       </div>       -->
       <!--div class="col-xs-12 section-footer"><a href="" class="continueforShop">Calculate Shipment</a></div-->
       <div class="col-xs-12 section-footer">
<!--           <span class="continueforShop" id="ship" style="cursor: pointer;">Calculate Shipment</span>-->
<!--           <span class="sellerAddressButton disabled" id="pay" style="cursor: pointer;">Proceed To Pay</span>-->
            <a href="#" class="sellerAddressButton btn btn-danger disabled" id="pay">Proceed To Pay</a>
       </div>
      </div>
      </div>
    </div>


<?php /*******************Payment Form ***********************************/?>
<div class="payumoney-form">
<?php $form = ActiveForm::begin(['id'=>'payform','method' => 'post']); ?>
<?php   //$MERCHANT_KEY = "9HwJ5t";
       // $MERCHANT_KEY = "bO2l7rc5";      //old key
         $MERCHANT_KEY = "ZWmKzvzY";   //new key
        //$SALT = "2JIfn3ez";
        $SALT = "9A1hD1YQ2e";
      //  $SALT = "WoWSFxRLGG";
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        
?>
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
<!--      <input type="hidden" name="hash" value="< ?php echo $hash ?>"/>-->
      <input type="hidden" name="hash" value=""/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
<!--      <input type="hidden" name="shoppingtype" value="C">  -->
<?php  foreach ($cart as $c){
         echo '<input type="hidden" name="productdetail[]" value="'.$c['prodname'].'"/>';  
        } ?>
      <input type="hidden" name="amount" value=""/>       
      <input type="hidden" name="firstname" id="name" value="" />
      <input type="hidden" name="email" id="email" value="" />
      <input type="hidden" name="phone" id="phn" value="" />
      <input type="hidden" name="productinfo" value=""/>

      <input type="hidden" name="surl" value="https://digin.in/index.php?r=orders/addorders" size="64" />
      <input type="hidden" name="furl" value="https://digin.in/index.php?r=orders/paymentfailure" size="64" />
<!--     <input type="hidden" name="surl" value="https://www.google.co.in/" size="64" />
      <input type="hidden" name="furl" value="https://in.yahoo.com/" size="64" />-->
      <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
      
     
      <input type="hidden" name="lastname" id="lastname" value="" />         
      <input type="hidden" name="curl" value="" />
      <input type="hidden" name="address1" value=""/>
      <input type="hidden" name="address2" value=""/>
      <input type="hidden" name="city" value=""/>
      <input type="hidden" name="state" value=""/>
      <input type="hidden" name="country" value=""/>
      <input type="hidden" name="zipcode" value=""/>
      <input type="hidden" name="udf1" value=""/>
      <input type="hidden" name="udf2" value=""/>
      <input type="hidden" name="udf3" value=""/>
      <input type="hidden" name="udf4" value=""/>
      <input type="hidden" name="udf5" value=""/>
      <input type="hidden" name="pg" value="" />
<?php ActiveForm::end(); ?>
</div>
    
    
    

          
    
      