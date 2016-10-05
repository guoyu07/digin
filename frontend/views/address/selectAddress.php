<?php use yii\widgets\ActiveForm;?>
    <!--div class="searchMobile">
      <div>
        <input type="text" placeholder="Select Location " class="locationInput">
      </div>
      <div>
        <input type="text" placeholder="Search" class="searchInput">
        <button type="submit" class="searchButton">GO </button>
      </div>
    </div-->
    <div class="container sectionWrap">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Address</a></li>
        <li class="active"><?= $address[0]['name'];?></li>
      </ul>
      
      <!--h2 class="sectionHeading"><i class="fa fa-tag"></i><span>My Offer</span></h2-->
       
      <div class="container myAccount">

      <div class="row">
     <?php //var_dump($address); 
     if(array_key_exists('address1', $address[0])){
        foreach ($address as $ad){
    echo     '<div class="col-sm-6">
        <div class="addressBlock">
			 	
			<p class="deliveryAddress">
                        <b><h2><input type="radio" name="address" class="selectaddr" id='.$ad['adrid'].'>'.$ad['name'].'</h2></b>                                    
                '.$ad['address1'].' <br/>
                '.$ad['address2'].' <br/>
                '.$ad['city'].', '.$ad['state'].', '.$ad['country'].',<span id="pin_'.$ad['adrid'].'">'.$ad['pin'].'</span><br/>
                '.$ad['phone'].'<br/>
                '.$ad['email'].'
                </p>	
		</div>
        </div>';
        }
     }
     ?>
         <!--div class="col-sm-6">
        <div class="addressBlock">
			<h2><input type="radio">Office Address</h2>
            <br>			
			<p class="deliveryAddress">
                            <b>Customer Name:</b>
                             
          
            Schonhauser Allee 167c <br/>
                10435 Berlin <br/>
                Germany <br/>
               Telephone:<br/>
                E-mail: moin@gmail.com>
                </p>	
		</div>
        </div>
        <div class="col-sm-6">
        <div class="addressBlock">
			<h2><input type="radio">Home Address</h2>
            <hr>			
			<p class="deliveryAddress">
            <b>Customer Name</b>
            Schonhauser Allee 167c <br/>
                10435 Berlin <br/>
                Germany <br/>
                Telephone: +49 30 47373795 <br/>
                E-mail: moin@gmail.com
                </p>	
		</div>
     
        </div-->
   
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
                                    'action' => ['address/addaddress']]); ?>

                  <div class="row">                  
                  <div class="col-xs-12">
                  <label>Name</label>
                  <input type="text" id="nm" name="username" placeholder="Name">
                  </div>
                  
                  <div class="col-sm-6 col-xs-12">
                  <label>Address1</label>
<!--                  <textarea placeholder="Address1" id="addr1"></textarea>-->
                  <input type="text" id="addr1" name="address1" placeholder="Address1">
                  </div>  
                      
                  <div class="col-sm-6 col-xs-12">
                  <label>Address2</label>
<!--                  <textarea placeholder="Address2" id="addr2"></textarea>-->
                  <input type="text" id="addr2" name="address2" placeholder="Address1">
                  </div>  
                  
                  <div class="col-sm-4 col-xs-12">
                  <label>City</label>
                  <input type="text" id="city" name="city" placeholder="City">
                  </div>
                      
                  <div class="col-sm-4 col-xs-12">
                  <label>State</label>
                  <input type="text" id="state" name="state" placeholder="State">
                  </div>                                        
                      
                  <div class="col-sm-4 col-xs-12">
                  <label>Country</label>
                  <input type="text" id="count" name="country" placeholder="Country">
                  </div>
                  
                  <div class="col-sm-4 col-xs-12">
                  <label>Pincode</label>
                  <input type="text" id="pin" name="pin" placeholder="Pincode" required>
                  </div>
                  
                  <div class="col-sm-4 col-xs-12">
                  <label>Mobile</label>
                  <input type="text" id="mob" name="phone" placeholder="Mobile Number">
                  </div>
                      
                  <div class="col-sm-4 col-xs-12">
                  <label>Email</label>
                  <input type="email" id="mail" name="email" placeholder="Email Address">
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
<?php $form = ActiveForm::begin(['id'=>'orderform','method' => 'post',
                                    'action' => ['orders/addorders']]); ?>
<?php ActiveForm::end(); ?>
</div>
          
      <?php $userid=Yii::$app->user->identity->id;
         $query1 = (new \yii\db\Query())                           
                ->select(['(c.quantity*vp.price) as total'])
                ->from('vendor v')
                ->join('inner join', 'vendor_products vp', 'vp.vid=v.vid')                                
                ->join('inner join', 'cart c', 'c.vpid=vp.vpid')                   
                ->where(['c.userid'=>$userid]);                 
        $product=$query1->all();        
        $total=0;
        if($product!=""){
            foreach ($product as $p){
                $total+=$p['total'];
         }         
        }
        ?>
          <input type="hidden" id="pinhidden" value="">    
          
      <div class="row finalCost">
      <div class="col-xs-6">Total Payment</div> <div class="col-xs-6 text-right">Rs. <?= $total;?></div>
      <div class="col-xs-6">Shipping Total</div> <div class="col-xs-6 text-right shiptotal">Rs. 0 </div>
      <div class="col-xs-6">Grosstotal</div> <div class="col-xs-6 text-right grosstotal">Rs. 0 </div>
      
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
<?php  $servicetax = \Yii::$app->params['tax']; ?>
<script type="text/javascript">
    $(document).ready(function(){
        /*$("#save").click(function(){
            var name=$("#nm").val();
            var address=$("#addr").val();
            var state=$("#state").val();
            var city=$("#city").val();
            var pin=$("#pin").val();
            var mob=$("#mob").val();
            var email=$("#mail").val();
            var addr=address.split(",");
            $i='';
            var addr1='';
            var addr2='';
            $.each(addr,function(i,v){  
                $i++;
               //alert(addr1[i]);
               if($i==(addr.length)) {
                   //alert(addr[i]);
                   addr2=addr[i];
               }
               else{
                  //alert(addr[i]); 
                  if(i==0)
                      addr1=addr[i];
                  else
                    addr1+=', '+addr[i];
               }
               
            });
            //alert(addr1+"........"+addr2);                   
            //alert(addr1.length);
            $url='index.php?r=address/addaddress&userid='+"< ?php echo \Yii::$app->user->identity->id;?>"+'&name='+name+'&email='+email+'&phone='+mob+'&addr1='+addr1+'&addr2='+addr2+'&city='+city+'&state='+state+'&pin='+pin;
            //$("#address").attr('action',$url);
            //alert($("#address").attr('action'));
            //$("#address").submit();
            location.href=$url;
        
        });*/
        
        $("#save").click(function(){                  
            $("#addrform").submit();
        });
             
        $("#clear").click(function(){                  
            $("#addrform").trigger("reset"); 
        });     
     
      var addrid='';
      $(".selectaddr").change(function(){
          //alert($(this).attr('id'));
          addrid=$(this).attr('id');         
          //alert($("#pin_"+addrid).text());
          
          $("#pinhidden").val($("#pin_"+addrid).text());
//          if($("#pin_"+addrid).text()=="" || $("#pin_"+addrid).text()==0){
//              alert("Please enter your pincode before calculating shipment.");
//          }
              getshipping();      
      });
      
/******************************************************************
 * 
 * Below code is used for calculating Shipping. When user's pincode is not available, He will enter pincode & then proceed further for calculating shipment
 */   
//      $("#pincode").on('input',function(){
//          $("#pinhidden").val($("#pincode").val());
//      });
           
      
//      $("#ship").click(function(){ 
//          getshipping();                         
//      });
/******************************************************************/    
      var shippingdata='';
      function getshipping(){
          $.ajax({                        
                type:"GET",
                url:"index.php?r=cart/shipmenttotal", 
                data:{pincode:$("#pinhidden").val(),                      
                  },
                success:  function(result) { 
                   //alert(result);
                   shippingdata=jQuery.parseJSON(result);
                   if(shippingdata!="" && shippingdata!=null)
                   {
                       $("#pay").removeClass("btn btn-danger disabled");
                       
                   var st=0; var gt=0; var total=0;
                   $.each(shippingdata,function(index, value) { 
                       var shipping=Math.round(value['shipping']*<?=$servicetax?>/100)+value['shipping'];
                       //st=st+value['shipping'];
                       //total=value['itemtotal']+value['shipping'];
                       st=st+shipping;
                       total=value['itemtotal']+shipping;
                       gt=gt+total;
                       
                   });                  
                   $(".shiptotal").html("Rs."+st);
                   $(".grosstotal").html("Rs."+gt);
                   }
                   $("#pinhidden").val('');                                                  
               }
         }); 
      }
    
      $("#pay").click(function(){                
                if($('input[type="radio"]').is(":checked"))
                {   
                      var ref='<?php echo uniqid();?>';  
                      //alert($("#orderform").attr('action'));                      
                      var input='';
                      $.each(shippingdata,function(index, value) {                             
                         input= input +'<input type="hidden" name="shipping[]" value="'+value['vpid']+'_'+value['shipping']+'">';                        
                          //alert(input);                         
                      });
                      input=input+'<input type="hidden" name="adrid" value="'+addrid+'"> <input type="hidden" name="ref" value="'+ref+'">';
                      $('#orderform').append(input); 
                      $("#orderform").submit();                                            
                  }
                  else{
                       alert("At least one address should be selected");
                  }
                            
       });      
      
    });
</script>