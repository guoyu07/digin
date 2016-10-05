<?php /*var_dump($myaccount); 
  if(array_key_exists('address1', $myaccount[0]))
          echo "exist...";*/
use yii\widgets\ActiveForm;?>
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
        <!--li><a href="#">Products</a></li-->
        <li class="active">Account</li>
      </ul>
      
      <!--h2 class="sectionHeading"><i class="fa fa-tag"></i><span>My Offer</span></h2-->
      <div class="container myAccount">
        <div class="row">
          <div class="col-xs-12">
            <h2><?php echo $myaccount['name'] ; ?></h2>
            <p><b>Email&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;<a href="mailto:<?= $myaccount['email']; ?>" class="link"><?= $myaccount['email']; ?></a></p>
            <p><b>Phone&nbsp;:</b>&nbsp;&nbsp;<a href="tel:<?= $myaccount['phone']; ?>" class="link"><?= $myaccount['phone']; ?></a></p>
            <!--p><b>Email&nbsp;:</b>&nbsp;&nbsp;&nbsp;< ?php echo $myaccount[0]['email']; ?></p-->
            <!--p><b>Phone&nbsp;:</b>&nbsp;&nbsp;&nbsp;+< ?php echo $myaccount[0]['phone']; ?></p-->
           
          </div>
        </div>
        <div class="myAccountTab">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#sectionA">Address</a></li>
            <li><a data-toggle="tab" href="#sectionB">My Order</a></li>
          </ul>
          <div class="tab-content">
            <div id="sectionA" class="tab-pane fade in active">
                
              <div class="row">
                  <?php //var_dump($address);                                      
        //if(array_key_exists('address1', $myaccount)){
          //if(array_key_exists('address1', $address[0])){
        if(isset($address) && $address!=""){
        foreach ($address as $accnt){
    echo     '<div class="col-sm-6">
        <div class="addressBlock">
       <p class="deliveryAddress">
			<h2><input type="radio" class="selectaddr" id='.$accnt['adrid'].'>'.$accnt['name'].' </h2>
                                               
                '.$accnt['address1'].' <br/>
                '.$accnt['address2'].' <br/>
                '.$accnt['city'].', '.$accnt['state'].', '.$accnt['country'].', '.$accnt['pin'].'<br/>
                '.$accnt['phone'].'<br/>
                '.$accnt['email'].'
                </p>	
		</div>
        </div>';
        }
        } 
     ?>
               
                  
                <!--div class="col-xs-12">
                  <div id="accordion-first" class="clearfix">
                    <div class="accordion" id="accordion2">
                      <div class="accordion-group">
                        <div class="accordion-headingRed"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"><i class="fa fa-plus-square"></i> <em class="icon-fixed-width fa fa-plus pull-right"></em>Add New Address </a> </div>
                        <div style="height: 0px;" id="collapseOne" class="accordion-body collapse addressForm">
                          <div class="accordion-inner">
                           <form id="address" method="POST">
                              <div class="row">
                               <div class="col-xs-12">
                                 <label>Name</label>
                                   <input type="text" id="nm" placeholder="Name">
                                 </div>
                                  
                                <div class="col-xs-12">
                                    <label>Address</label>
                                     <textarea placeholder="Address" id="addr"></textarea>
                                 </div>
                                                                  
                                 <div class="col-sm-6 col-xs-12">
                                    <label>State</label>
                                     <input type="text" id="state" placeholder="State">
                                </div>
                                
                                <div class="col-sm-6 col-xs-12">
                                     <label>City</label>
                                     <input type="text" id="city" placeholder="City">
                                </div>
                                
                                <div class="col-sm-4 col-xs-12">
                                    <label>Pin Code</label>
                                    <input type="text" id="pin" placeholder="Pincode">
                                </div>
                                
                               <div class="col-sm-4 col-xs-12">
                                    <label>Mobile</label>
                                     <input type="text" id="mob" placeholder="Mobile Number">
                              </div>
                  
                             <div class="col-sm-4 col-xs-12">
                                    <label>Email</label>
                                     <input type="email" id="mail" placeholder="Email Address">
                              </div>
                                
                               <div class="col-xs-12">
                                 <div class="section-footer">
                                 <button class="btn btn-danger" id="save" type="button">Save</button>
                                 <button data-dismiss="modal" class="btn btn-default" type="button">Clear</button>
                                </div>
                              </div>
                                
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end accordion --> 
<!--                  </div>
                </div>-->


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
                                    'action' => ['myaccount/addaddress']]); ?>

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
            </div>
<!--            <div id="sectionB" class="tab-pane fade">
              <div class="row cartList">
                <div class="col-sm-2 text-center"> <img src="images/tv.jpg" alt="" class="img-responsive moboSingle"> </div>
                <div class="col-sm-3">
                  <h4>Sony Bravia i-587</h4>
                  <h4 class="sellerName"><span>Sold By: </span>Vendor Name</h4>
                </div>
                <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
                  <p class="label">Price</p>
                  <p class="value">Rs. 1500</p>
                </div>
                <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
                  <p class="label">Quantity</p>
                  <p class="value"><a href="#"><i class="fa fa-minus"></i></a> 01 <a href="#"><i class="fa fa-plus"></i></a></p>
                </div>
                <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue totalCost">
                  <p class="label">Total</p>
                  <p class="value">Rs. 1500</p>
                </div>
              </div>
              <div class="row cartList">
                <div class="col-sm-2 text-center"> <img src="images/fridge.jpg" alt="" class="img-responsive moboSingle"> </div>
                <div class="col-sm-3">
                  <h4>Whirlpool 205 Cls 3s 190 </h4>
                  <h4 class="sellerName"><span>Sold By: </span>Vendor Name</h4>
                </div>
                <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
                  <p class="label">Price</p>
                  <p class="value">Rs. 1500</p>
                </div>
                <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue">
                  <p class="label">Quantity</p>
                  <p class="value"><a href="#"><i class="fa fa-minus"></i></a> 01 <a href="#"><i class="fa fa-plus"></i></a></p>
                </div>
                <div class="col-xs-4 col-sm-2 col-sm-push-1 productValue totalCost">
                  <p class="label">Total</p>
                  <p class="value">Rs. 1500</p>
                </div>
              </div>
              <div class="row finalCost">
                <div class="col-xs-6">Total Payment</div>
                <div class="col-xs-6 text-right">Rs. 3000</div>
                <div class="col-xs-12 section-footer"><a class="sellerAddressButton" href="#">Seller Delivery Address</a></div>
              </div>
            </div>-->
   <?php if(isset($orderdetail)){
     
       
    ?>           
<div id="sectionB" class="tab-pane fade" style="margin-left: 120px;">
  <table width="700" border="1">
  <tr>
    <td width="187" height="45"><div align="center"><strong>Order No.</strong></div></td>
    <td width="217"><div align="center"><strong>Date</strong></div></td>
    <td width="152"><div align="center"><strong>Total</strong></div></td>
    <td width="116"><div align="center"><strong>Status</strong></div></td>
  </tr>
   <?php foreach ($orderdetail as $o){ ?>
  <tr>
       <td><div align="center"><?php echo '<a href="index.php?r=myaccount/orderdetail&orid='.$o['orid'].'&orderno='.$o['displayid'].'" class="link">'.$o['displayid'].'</a>' ?></td>
    
        <td><div align="center"><?php echo $o['crtdt']; ?></div></td>
        <td><div align="center"><?php echo $o['grosstotal']; ?></div></td>
        <td><div align="center"><?php echo $o['status']; ?></div></td>
    
  </tr>
  <?php } ?>      
</table>
     
              </div>
   <?php } ?>

          </div>
        </div>
      </div>
    </div>
<!--a class="cta" href="#">Post Review</a-->

   <script type="text/javascript">
    $(document).ready(function(){
        $("#save").click(function(){                  
            $("#addrform").submit();
        });
             
        $("#clear").click(function(){                  
            $("#addrform").trigger("reset"); 
        }); 
        
        
     /*   $("#save").click(function(){
            
            //alert("Hi...we R in..jv..");
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
             $url='index.php?r=myaccount/addaddress&userid='+"< ?php echo \Yii::$app->user->identity->id;?>"+'&name='+name+'&email='+email+'&phone='+mob+'&addr1='+addr1+'&addr2='+addr2+'&city='+city+'&state='+state+'&pin='+pin;
             location.href=$url;
        }); */
    });
    
   </script>
    
    
<script>
    $(document).ready( function() {
		$('#myCarousel').carousel({
		interval:   40000
		});
		
		var clickEvent = false;
		$('#myCarousel').on('click', '.nav a', function() {
			clickEvent = true;
			$('.nav li').removeClass('active');
			$(this).parent().addClass('active');		
		}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.nav').children().length -1;
			var current = $('.nav li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.nav li').first().addClass('active');	
			}
		}
		clickEvent = false;
		});
    });
    </script> 
<script>
	offCanvasNav({
		target_nav: '.dropdown',
		nav_next_btn: '<i class="icon-right"></i>'
	});
</script>
