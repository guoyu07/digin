<script type="text/javascript" src="./js/jquery.popup.js"></script>
<script type="text/javascript" src="./js/product.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.popup.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript">
	
 (function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
               rules: {
				name: {
					required: true,
					minlength: 3
				},
				email1: {
					required: true,
					email: true
				},
				message: {
					required: true,
				},
				phone1: {
					required: true,
                                        minlength: 10
				},
				agree: {
					required: true,
				},

			},
              messages: {
				message: {
					required: "Please enter your message",
				},
				name: {
					required: "Please enter your name",
					minlength: "Your name must be at least 3 characters long"
				},
				phone1: {
					required: "Please enter your phone no",
                                        minlength: "Your name must be at least 10 numbers"
				},
				email1: {
					required: "Please enter your email address",
					email:  "Please enter a valid email address"
				},

			},
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

$(document).ready(function() {
    $('#phone1').blur(function(e) {
        if (validatePhone('phone1')) {
            $('#spnPhoneStatus').html('Valid');
            $('#spnPhoneStatus').css('color', 'green');
        }
        else {
            $('#spnPhoneStatus').html('Invalid Phone no');
            $('#spnPhoneStatus').css('color', 'red');
        }
    });
	
	
});


function validatePhone(phone1) {
    var a = document.getElementById(phone1).value;
    var filter = /^[0-9-+]+$/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}
</script>	

<?php 
use yii\widgets\ActiveForm;
use yii\web\Session;

?>
<?php 

      
if(isset($vendor) && $vendor!=NULL){
$query = (new \yii\db\Query())   
               ->select(['vid','avg(answer) as average'])
               ->from('userreview')
               ->where(['vid'=>$vendor[0]['vid']]);
              $review=$query->all();   
              ///echo json_encode($review);
}
//var_dump($productresult);
$planfeature= new backend\models\PlanFeatures();
$result1=$planfeature->getFeature($vendor[0]['vid'], 7);   //address
$result2=$planfeature->getFeature($vendor[0]['vid'], 5);   //email
$result3=$planfeature->getFeature($vendor[0]['vid'], 4);   //phone
$result4=$planfeature->getFeature($vendor[0]['vid'], 8);   //website
$result5=$planfeature->getFeature($vendor[0]['vid'], 6);   //map
$result6=$planfeature->getFeature($vendor[0]['vid'], 9);   //my offer
$result7=$planfeature->getFeature($vendor[0]['vid'], 10);  //my product
?>
 <?php $session = Yii::$app->session;?>
<?php if(isset($vendor) && $vendor!=NULL){
     foreach ($vendor as $v)
     {
 ?>
    <div class="container sectionWrap">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="">Vendor</a></li>
        <li class="active"><?= $v['businessname']; ?></li>
      </ul>
      <div class="row">     
        <div class="col-sm-4 col-md-3 col-xs-12">
			<div class="thumbnail boxshwd"><img alt=" " src="<?php echo $v['Logo']; ?>" /></div>
        </div>
        <div class="col-sm-4 col-md-4 col-xs-12">
            <div><b class="shareimg"><?php echo " ".$v['businessname'];  ?></b>
				<span id="myBtn"><img class="img-responsive img2" src="images/share.png"/> </span>
			</div>
			
				 <!---for social site sharing-->
				<div id="share-button" class="modal">  
					<div class="modal-content mr30">
						 <?php echo \ijackua\sharelinks\ShareLinks::widget(
							[
									'viewName' => 'main.php'   //custom view file for you links appearance
							]);
						?>  
					</div>
				 </div>	
				 
			 <div>
				<p class="ratings">
						 <?php
					 //echo $rvs['average'];
						$ratng = floatval($review[0]['average']);
						//echo $rating;
						$whle = floor($ratng);  //1
						$fract = $ratng - $whle;
						//echo $fract;
						for($i=0; $i <  $whle; $i++)
						{
						  echo '<span class="glyphicon glyphicon-star "></span>'  ;
						}
						if ($fract >= 0.5)
						{
						   echo '<span class="glyphicon glyphicon-star half"></span>'  ;
						} else if($review[0]['average']==0){
							echo '<span style="font-weight:bold; font-size:15px;"><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span></span>'  ;
						}
				 ?></p>
			 </div>
                <?php if($result1==1) { ?>
                   <div class="addrnav"><b class="shareimg">Address:-</b><span><a href="https://maps.google.com/?saddr=<?php echo $session['lat'] ?>,<?php echo $session['lng'] ?>&daddr=<?php echo  $v['lat']; ?>,<?php echo $v['lng']; ?>" class="btnsize" target="_blank"><img class="img-responsive img2" src="images/navigation.png"/></a> </span><p class="vendadr"><?php echo $v['Address'];?></p></div>
                <?php } if($result2==1) { if($v['email']!=''){?>
                   <div class="glyphicon glyphicon-envelope">&nbsp;<a href="mailto:<?php echo $v['email'] ?>" ><?php echo $v['email'] ?></a></div><br>
                <?php }} if($result3==1) {if($v['phone']!='') {?>   
                   <div class="glyphicon glyphicon-earphone">&nbsp;<a href="tel:<?php echo $v['phone'] ?>" ><?php echo $v['phone']; ?></a>
				   </div><br>
                <?php }} if($result4==1) {
				if($v['website']!='') {			
					?>  
                <div class="glyphicon glyphicon-globe">&nbsp;<a href="<?php echo $v['website'];  ?>" target="_blank"><?php echo $v['website'];  ?></a></div>
				<?php } } ?>  
        </div>
			
          
         <div class="col-sm-4 col-md-2 col-xs-12">
			 <div class="row">
				<div class="button popbtn">
					<i class="fa fa-mobile btnsize1"></i>
					<a href="#login-box1" class="login-window btnsize">&nbsp; Send SMS</a>
				    
				</div>
			</div>
			<div class="row">
				<div class="button popbtn pd10">
				 <i class="fa fa-envelope-o btnemail"></i>
					<a href="#login-box" class="login-window btnsize">&nbsp; Send Email</a>
				</div> 
			</div>	
        </div>
         <?php } ?>
         
           


        <div class="col-sm-4 col-md-3 col-xs-12 hidden-xs hidden-sm smallAdsVendorInfo">
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.jpg"></a></div>
        </div>

	    </div>
		
		

     <?php if($result6==1) {?>   
      <h2 class="sectionHeading mT10"><i class="fa fa-tag"></i><span>My Offer</span></h2>
     <?php }  if($result7==1) {?>
      <h2 class="sectionHeading mT10"><i class="fa fa-tag"></i><span>My Products</span></h2>
      <?php echo '<div class="row text-center productList mT10">';
      if(isset($productresult) && $productresult!=NULL){
      foreach($productresult as $p)
       {
        
          if($p['weightunit']==0){
              $wghtnm = '';
          }else{
              $unitb = backend\models\Wgtunits::findone(['wgt_id'=>$p['weightunit']]);
              $wghtnm = $unitb['wgt_name'];
          }
		  if($p['weight']==0){
              $wght = '';
          }else{
              $wght = $p['weight'];
          } 
		  
		  if($p['price']==0){
              $prodprce = '';
          }else{
              $prodprce = $p['price'];
			 
          } 

         if($p['price'] != 0){
             $currecycode = $p['currencycode'];
          }else{
              $currecycode = '';
          }
		
			
		if(strlen($p['prodname'])>=45)
		  {
			  $productname=$p['prodname'];
			 $productname=substr($productname,0,45) . '...';
		  }
		  else
		  {
			$productname=$p['prodname'];
		  }
	   
		  if($p['weight']!=0){
					 $prcslc= '/';
				 }
				 else{
					  $prcslc= '';
				 }
			

          echo ' <div class="col-sm-4 col-md-3 col-xs-12" style="height:300px;">
                <div class="thumbnail"><a href="index.php?r=search/searchproducts&prid='.$p['prid'].'" class="link"><img alt="" src="'.$p['image'].'" style="height:211px;"></a></div>
                 <p class="mb5">'.$productname.'</p>
				<span class="fntwt">  '.$currecycode.'</span><span class="fntwt"> ' .$prodprce.'</span><span class="fntslc">'. $prcslc .'</span><span class="fntwt">'. $wght.' </span><span class="fntwt">'.$wghtnm.'</span>
               </div>';          
        }
         echo '</div>';
      }  else {
          echo ' <div class="row wishProductList" ><div class="row cartList"><b>No Products Available</b></div></div>';          
      }
     }  ?>

      <?php 
          if(isset($userreview)){
          foreach ($userreview as $rvs){
         ?>
      <h2 class="lineHeader"><span>Review</span></h2>
		<div class="reviewBlock">
			  
			<h2>Customer Name:<?php echo $rvs['username']; ?></h2>
			
			 <p class="ratings"> :
				 <?php
			 $rating = floatval($rvs['average']);
			 $whole = floor($rating);      // 1
			 $fraction = $rating - $whole;
			 for($i=0; $i <  $whole; $i++)
			 {
			   echo '<span class="glyphicon glyphicon-star "></span>'  ;
			 }
			 if ($fraction >= 0.5)
			 {
				  echo '<span class="glyphicon glyphicon-star half"></span>'  ;
			 } else if($rvs['average']==0){
				 echo '<span style="font-weight:bold; font-size:15px;"><b>None</b></span>'  ;
			 }
			 ?> Ratings </p>
			  <p><?=$rvs['comments']?></p>
         
		</div>
      <?php  }}   ?>
      <a class="cta" href="index.php?r=userreview/showreview&vid=<?=$vendor[0]['vid']?>">Post Review</a> 
	
	</div>             
      <?php  } else {   ?>
    <div class="container sectionWrap">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li class="active">Vendor</li>        
      </ul>
              
      <div class="item active"> <img src="images/search_not_found.png" style="margin-left:260px;">
               <div class="errormsg">
                  <a href="index.php" class="continueforShop" style="background: #f44336;">Go To Home Page </a></div>
      </div>
    </div>  
	<?php } ?>
	
<!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.22"></script-->
  
        <div id="login-box" class="login-popup">
			<div class="row">
				<div class="col-md-11 col-xs-11">
					<h2 class="pdLR">Send Email</h2>
				</div>
				<a href="#" class="close1"><i class="fa fa-times"></i></a>
			</div>
			
          <form method="post" class="signin" action="index.php?r=vendor/emailpopup" id="register-form1" novalidate="novalidate">
                <fieldset class="textbox">
					<div class="row">
						<input type="hidden" name="vid" value="<?php echo $v['vid']; ?>">
						<input type="hidden" name="email" value="<?php echo $v['email']; ?>">
						<input type="hidden" name="businessname" value="<?php echo $v['businessname']; ?>">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="poplabel">
								<span>Name</span>
								<input name="name" value="" id="name" type="text" >
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="poplabel">
								<span>Phone NO</span>
								<input name="phone" value="" id="phone" type="text" >
								<span id="spnPhoneStatus1"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="poplabel">
								<span>Email</span>
								<input name="email1" value="" id="email1" type="email" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="poplabel">
								<span>Subject</span>
								<input name="subject" value="Customer Contact" type="text" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="poplabel">
								<span>Message</span>
								<textarea name="message" value="" type="text" id="message" class="popwidth" ></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<input type="submit" name="submit" value="Send" class="btn btnwdth">
							</div>
						</div>
					</div>
                </fieldset>
          </form>
		</div>
		
		<div id="login-box1" class="login-popup">
			<div class="row">
				<div class="col-md-11 col-xs-11">
					<h2 class="pdLR">Send Message</h2>
				</div>
				<a href="#" class="close1"><i class="fa fa-times"></i></a>
			</div>
          <form method="post" class="signin" action="index.php?r=vendor/messagepopup" id="register-form" novalidate="novalidate" >
                <fieldset class="textbox">
					<div class="row">
						<input type="hidden" name="vid" value="<?php echo $v['vid']; ?>">
						<input type="hidden" name="phone" value="<?php echo $v['phone']; ?>">
                                                <input type="hidden" name="businessname" value="<?php echo $v['businessname'];?>">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="poplabel">
								<span>Name</span>
								<input name="name" id="name" value="" type="text">
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="poplabel">
								<span>Phone NO</span>
								<input name="phone1" id="phone1" value="" type="text">
								<span id="spnPhoneStatus"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="poplabel">
								<span>Message</span>
								<textarea name="message" id="message" value="" type="text" class="popwidth"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<input type="submit" name="submit" value="submit" class="btn btnwdth">
							</div>
						</div>
					</div>
                </fieldset>
          </form>

		</div>
		

<script>

$('a.login-window').click(function() {
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(100);
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close1, #mask').on('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});

var pos_sess;
lat=parseFloat(document.getElementById('lat').value);
lng=parseFloat(document.getElementById('lng').value);
pos_sess={
    lat:lat,
    lng:lng
}
//alert("pos..."+pos['lat']);
function displayMap() {
  
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: pos_sess    
  });
  directionsDisplay.setMap(map);

 // var onChangeHandler = function() {
 <?php // To check 'navigation' feature is there or not for this vendor
 if($result5==1) {?> 
    calculateAndDisplayRoute(directionsService, directionsDisplay);
 <?php } ?>   
  //};
  //document.getElementById('str').addEventListener('change', onChangeHandler);
  //document.getElementById('end').addEventListener('change', onChangeHandler);
 }

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    
    var deststr=document.getElementById('latlngven').value;    
    var destin=deststr.split(",");
    var destlatlng = {lat:parseFloat(destin[0]), lng:parseFloat(destin[1])};
  directionsService.route({ 
    origin: pos_sess ,
    destination: destlatlng,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {   
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    } else {        
      //window.alert('Directions request failed due to ' + status);
      
      var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: destlatlng    
       });
      var marker = new google.maps.Marker({
            position: destlatlng,
            map: map,           
      });     
    }
  });
}

</script>
<script type="text/javascript">

	
 (function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form1").validate({
               rules: {
				name: {
					required: true,
					minlength: 3
				},
				email1: {
					required: true,
					email: true
				},
				message: {
					required: true,
				},
				phone: {
					required: true,
                                        minlength: 10
				},
				agree: {
					required: true,
				},

			},
              messages: {
				message: {
					required: "Please enter your message",
				},
				name: {
					required: "Please enter your name",
					minlength: "Your name must be at least 3 characters long"
				},
				phone: {
					required: "Please enter your phone no",
                                        minlength: "Your name must be at least 10 numbers long"
				},
				email1: {
					required: "Please enter your email address",
					email:  "Please enter a valid email address"
				},

			},
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

$(document).ready(function() {
    $('#phone').blur(function(e) {
        if (validatePhone('phone')) {
            $('#spnPhoneStatus1').html('Valid');
            $('#spnPhoneStatus1').css('color', 'green');
        }
        else {
            $('#spnPhoneStatus1').html('Invalid Phone no');
            $('#spnPhoneStatus1').css('color', 'red');
        }
    });
});


function validatePhone(phone) {
    var a = document.getElementById(phone).value;
    var filter = /^[0-9-+]+$/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}
</script>	

