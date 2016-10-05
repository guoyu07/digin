<?php

/* @var $this \yii\web\View */
/* @var $content string */
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\web\Session;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">
<head>

<?php $qrystr= Yii::$app->request->getQueryString();
$qrystrarr = explode("&",$qrystr);
$qrystrarr = array_splice($qrystrarr,0,4);	 
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="832263076909446" /> 
<meta name="twitter:site" content="@DiginMarket" />
<meta name="twitter:card" content="summary" />


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78483149-1', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>




<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!-- ------------new code-------------- -->
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.offcanvas.min.css" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />

<link rel="stylesheet" type="text/css" href="./css/normalize.css" />
<link rel="stylesheet" type="text/css" href="./css/off_canvas_nav.css" />
<link rel="stylesheet" type="text/css" href="./css/offCanvas.css" />
<link rel="stylesheet" type="text/css" href="./css/custom.css" />
<link rel="stylesheet" href="./css/flexslider.css" type="text/css" media="screen" />

<script type="text/javascript" src="./js/bootstrap.offcanvas.js"></script>
<script type="text/javascript" src="./js/off_canvas_nav.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/script.js"></script>
<script type="text/javascript" src="./js/jquery.validate.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!--[if lt IE 9]>
    <script src="./js/html5shiv.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->

	
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

 $(function () {
    var sf_menu_sub = $('.cat-menu-sub');
    $('.lvl_1 span').on('click', function (e) {
        e.stopPropagation();

        childul = $(this).parent().closest('li').find('ul').first();
        childul.toggle();

    });
    $(document).on('click', function (e) {
        sf_menu_sub.hide();
       $(".touchbutton").addClass("fa fa-chevron-down");
    });
});
	
 (function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#email-form").validate({
               rules: {
				name: {
					required: true,
					minlength: 3
				},
				email: {
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
				email: {
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
	
 (function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#message-form1").validate({
               rules: {
				name: {
					required: true,
					minlength: 3
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

    $('#phone1').blur(function(e) {
        if (validatePhone('phone1') & isEmail('email')) {
            $('#spnPhoneStatus').html('Valid');
            $('#spnPhoneStatus').css('color', 'green');
        }
        else {
            $('#spnPhoneStatus').html('Invalid Phone no');
            $('#spnPhoneStatus').css('color', 'red');
        }
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
<script>
var geocoder;
var autocomplete;
var pos;
function initMap() {   
 geocoder = new google.maps.Geocoder;  
  
  // Try HTML5 geolocation.
  if (navigator.geolocation) {
 
    navigator.geolocation.getCurrentPosition(function(position) {
     
     pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

       if(pos['lat']=="" && pos['lng']=="") 
       {
          pos = {
            lat: 18.52043,
            lng: 73.85674
            };
       }     

     geocoder.geocode({'location': pos}, function(results, status) { 
     var cntry = '<?php if(isset($_GET['country'])) { echo $_GET['country']; } else { echo "India"; } ?>' 

      if(cntry){
         country  = cntry;
      }else{
      
       for(i=0;i<results.length;i++){
            
           if (jQuery.inArray("country",results[i].address_components[0].types)!='-1'){
             country=results[i].address_components[0].long_name;
           }
     }
    
      }  
     
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]) { 
     			
	 document.getElementById('googleaddress').value=results[1].formatted_address; 
      
         document.getElementById('mobaddress').value=results[1].formatted_address;       
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
   lat=pos['lat'];
   lng= pos['lng']; 
   document.getElementById('lat').value=lat;
   document.getElementById('lng').value=lng;
   address=results[1].formatted_address;   
   /***************ajax call has made to add lat, lng, addr in session*********************/
   var xhttp = new XMLHttpRequest();
   xhttp.open("GET","index.php?r=site/details&lat="+lat+"&lng="+lng+"&address="+address+"&country="+country,true);
   xhttp.send();
    });
   });
  }
      
    //set google address by entering any location   
    var inputaddr= document.getElementById('googleaddress'); 
    var mobaddr= document.getElementById('mobaddress');          
    autocomplete = new google.maps.places.Autocomplete(inputaddr);     
   
    autocomplete.addListener('place_changed', function() {    
    locateAddress();  
    var address=document.getElementById('googleaddress').value;   
	/************start************/
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        pos = {
        lat: results[0].geometry.location.lat(),
        lng: results[0].geometry.location.lng()
      };
      }
      lat=pos['lat'];
      lng= pos['lng'];      
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET","index.php?r=site/details&lat="+lat+"&lng="+lng+"&address="+address,true);
      xhttp.send();
    });//end
   
  }); 
  /***********Repeat***********/
      autocomplete = new google.maps.places.Autocomplete(mobaddr);   
    autocomplete.addListener('place_changed', function() {    
    locateAddress();      
    var address=document.getElementById('mobaddress').value;    
	/************start************/
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        pos = {
        lat: results[0].geometry.location.lat(),
        lng: results[0].geometry.location.lng()
      };
      }
      lat=pos['lat'];
      lng= pos['lng'];      
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET","index.php?r=site/details&lat="+lat+"&lng="+lng+"&address="+address,true);
      xhttp.send();
    });//end
   
  });
 }
  
  function locateAddress(){   
   
      var place = autocomplete.getPlace();
      if(place==null){
       var geocoder = new google.maps.Geocoder();
       var address = document.getElementById('googleaddress').value;      
      }
      else{ 
        if(document.getElementById('googleaddress').value!=null && document.getElementById('googleaddress').value!=''){
        if (!place.geometry) {
          window.alert("Place not found. Please check your address.");
          return;
        }     
        }
        else{
            window.alert("Please enter correct address.");
        }
    }
  }  


 

</script>
<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initMap&v=3.22" async defer></script>
<!-- ---------------------------------end---------------------------- -->

</head>
 <?php $this->beginBody() ?>
 <!--New Head**********--->
 <script>
	$(document).ready(function () {
	<?php $role='';
    $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
    foreach($userrole as $r)
    {
      $role=$r->name;
    
    }
	
	if($role=="Vendor"){ ?>
	$(".headhide").css("display","none");
	<?php }else{ ?>
	$(".headshow").css("display","none");
	<?php } ?>
	});
  </script>
  <div class="topLeftBg"></div>
<div class="topRightBg"></div>
<div class="container">

	<div class="content_animate slide content">
		
			<?php $role='';
			$userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
			foreach($userrole as $r)
			{
			  $role=$r->name;
			}
			if($role=="Vendor"){ ?>
	<header class="content_animate slide">
		   <div class="headshow" style="display:block;" > 
					<div class="container headWrap" style="overflow: visible !important;">
						<div id="headerbar" class="container-fluid">	
							<div class="mrl mobilehead hidden-lg hidden-md">
								<img src="../images/digin1.png" class="digwordmob">
								<img src="../images/diginword3.png" class="wordtextmob">
							</div>
							<button type="button" class="navbar-toggle offcanvas-toggle" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas-2"> <span class="sr-only">Toggle navigation</span> <span class="icon-dot"></span> <span class="icon-dot"></span> <span class="icon-dot"></span> </button>
							<nav class="navbar navbar-second navbar-second navbar-offcanvas navbar-offcanvas-right navbar-offcanvas-touch navbar-offcanvas-fade" role="navigation" id="js-bootstrap-offcanvas-2">						
								<div class="navbar-header small-nav headerlogo"> <a class="navbar-brand hidden-xs hidden-sm" href="index.php?r=vendor/vendorlayout"><img src="images/logo1.png" id="logo-image" class="imglogo1"></a> 
								    <button type="button" class="navbar-toggle offcanvas-toggle navtog" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas-2"> <span class="sr-only">Toggle navigation</span> <span class="icon-dot togicon"></span> <span class="icon-dot togicon"></span> <span class="icon-dot togicon"></span> </button>
									<div class="favimage">
										<div class="mobileHeader hidden-lg hidden-md"><img src="images/DiginSpade1.png">
										</div>
								   </div>
									</div>
									<div class="headerdiv1">
										<div class="venheader">
											<?php  if (!Yii::$app->user->isGuest) {
												$vendor = new frontend\models\Vendor();
												$getvenbusname = $vendor->getVidbusiness();
												?>
											<div class="venmidmenu">
												<div class="row">
													<span class="vename" title="Login user"><?php echo $getvenbusname ?></span>
												</div>
											</div>
											<?php } ?>
											<div class="aftermenu">
												<div class="row">
													 <div class="payname">
														<span class="">Last Payment  &nbsp;&nbsp; INR</span>
														<span class="">     </span>
													 </div>
												</div>
												<div class="row">
													<div class="payname">
														<span class="">Balance  &nbsp; </span>
														<span class="">0.00</span>
													 </div>
												</div>
										   </div> 
										
												 <?php  if (!Yii::$app->user->isGuest) {
													$vendor = new backend\models\Vendor();
													$getvid = $vendor->getVid();
												 ?>		
												<div class="rightmenu">												 
													<?php if(!Yii::$app->user->isGuest) {
													$usernm= Yii::$app->user->identity->username; ?>						
													<div class="dropdown drpwdth">	
														<a class="dropdown-toggle profile logbtn accbtn" type="button" data-toggle="dropdown" data-toggle="tooltip" title="user Account">My Accounts
													</a>
													   <ul class="dropdown-menu drpdwn">
														  <li><a class="wishListIcon droplog" href="#">Payment History</a></li>
														  <li><a class="wishListIcon droplog" href="index.php?r=vendor/update&id=<?php echo $getvid; ?>">Profile Details</a></li>
														  <li><a class="wishListIcon droplog" href="index.php?r=orderitem/index">Order History</a></li>
														  <li><a class="wishListIcon droplog" href="http://backend.digin.in/index.php?r=user/security/login" target="_blank">Tagged Products</a></li>
														  <li><a class="wishListIcon droplog" href="http://backend.digin.in/index.php?r=user/security/login" target="_blank">Add New Products</a></li>
														  <li><a class="wishListIcon droplog" href="#">Promotions</a></li>
														  <li><a class="wishListIcon droplog" href="index.php?r=site/createbadge">Find Us On Digin</a></li>
														  <li><a class="changePass droplog" href="index.php?r=vendor-currency-setting/create&id=<?php echo $getvid; ?>">Currency Setting </a></li>
<li><a class="changePass droplog" href="index.php?r=/orderitem/paymentrpt">Payment Report</a></li>
<li><a class="changePass droplog" href="index.php?r=/user/settings/account">Change Password</a></li>
														  <li><a class="wishListIcon droplog" href="index.php?r=login/logout">Logout(<?= Yii::$app->user->identity->username?>)</a></li>
														</ul>
													</div>	
													 <?php }?> 						  
												<?php }?>
											</div>
								</div>
							</nav>
					</div>
			</div>
	</header>
		<?php }else { ?>
		<header>
			<div class="headhide">  		
				<div class="container headWrap" style="overflow: visible !important;">
					<div id="headerbar" class="container-fluid">
						<div class="mobilehead hidden-lg hidden-md">
							<a href="index.php">
								<img src="../images/digin1.png" class="digwordmob">
								<img src="../images/diginword3.png" class="wordtextmob">
							</a>
							<?php if(!Yii::$app->user->isGuest){
								$usernm= Yii::$app->user->identity->username;  ?>
							<div class="nameusermob">
								<span class="usernm" title="Login user">Welcome To Digin</span>
							</div>
							<?php }?>
						</div>
						
						<div class="cartleHeader hidden-lg hidden-md"><div class="iconmobcart">
							<span class="cartitems">0</span> 
						</div> <a class="cartMobo" href="index.php?r=cart/displaycart"></a></div>
						<button type="button" class="navbar-toggle offcanvas-toggle hidden-lg hidden-md" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas-2"> <span class="sr-only">Toggle navigation</span> <span class="icon-dot"></span> <span class="icon-dot"></span> <span class="icon-dot"></span> </button>
							<nav class="navbar navbar-second navbar-second navbar-offcanvas navbar-offcanvas-right navbar-offcanvas-touch navbar-offcanvas-fade" role="navigation" id="js-bootstrap-offcanvas-2">
							<div class="navbar-header small-nav headerlogo"> <a class="navbar-brand hidden-xs hidden-sm" href="index.php"><img src="images/logo1.png" id="logo-image" class="imglogo1"></a> 
								<button type="button" class="navbar-toggle offcanvas-toggle navtog" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas-2"> <span class="sr-only">Toggle navigation</span> <span class="icon-dot togicon"></span> <span class="icon-dot togicon"></span> <span class="icon-dot togicon"></span> </button>
								<div class="favimage">
									<div class="mobileHeader hidden-lg hidden-md"><img src="images/DiginSpade1.png">
									</div>
							   </div>
							</div>	
							<div class="mobmenu">Menu</div>
							<div class="headerdiv">
								<div class="topheader">
									<div class="midmenu">
										<div class="menuimge">
											<a href="index.php"><img src="../images/digin1.png" class="digword"></a>
											<a href="index.php"><img src="../images/diginword3.png" class="wordtext"> </a>
										</div>
										
										<div class=""> <!--*****new*****-->
											<ul id="topMenu" class="nav navbar-nav secondaryMenus">
											 <li><a class="offerIcon icon1 login-window  login-window" href="#email-box" data-toggle="tooltip" title="Mail To Digin">Email </a>
											 <li><a class="offerIcon icon1 login-window  login-window" href="#message-box" data-toggle="tooltip" title="Mail To Digin">SMS</a>
											 </li>												
											 <li><a class="offerIcon icon1" href="#" data-toggle="tooltip" title="My Offers">Offers</a></li>
												 <li><a class="accountIcon icon1  profile" href="https://play.google.com/store/apps/details?id=com.sapeksh.digIn" target="_blank" data-toggle="tooltip" title="Download digin App">Download App</a></li>
												<?php if(Yii::$app->user->isGuest) {?>
													
												<li class="dropdown">	
													<a class="accountIcon icon1 dropdown-toggle profile logbtn" data-toggle="dropdown" data-toggle="tooltip" title="Login user">Login
													</a>
													<ul class="dropdown-menu logmenu1">
														<li><a href="index.php?r=login/login">As User</a></li>
														<li><a href="index.php?r=vendor/vendorlogin" >As Vendor</a></li>
<li><a href="http://backend.digin.in/index.php?r=user/security/login" target="_blank">As Franchisee</a></li>
													</ul>
												</li>
												<li class="dropdown">	
													<a class="accountIcon icon1 dropdown-toggle profile logbtn" data-toggle="dropdown" data-toggle="tooltip" title="Register Subscriber">Register
													</a>
													<ul class="dropdown-menu logmenu2">
													  <li><a href="index.php?r=registration/registeruser">As User</a></li>
													  <li><a href="index.php?r=vendor/create">As Vendor</a></li>
													  <li><a href="index.php?r=site/vendorplans">Vendor Packages</a></li>
													</ul>
												</li>
												<li class="accountIcon cartico icon1 profile logbtn" style="display: none;">Cart 
												  
													<div class="iconmobcart cartico carticon1">
														
													<a class="icodec" href="index.php?r=cart/displaycart" data-toggle="tooltip" title="Add to cart">
													<span class="cartitems newico">0</span>
														<img class="moblcart" src="../images/PawndooBlack1.png">
													</a>
													</div> 
												</li>
												

											<?php }?> 											
											   <?php if(!Yii::$app->user->isGuest) {?>
												<li><a class="offerIcon icon1" href="index.php?r=allforms/fetch" data-toggle="tooltip" title="Digin User Allinfo">iDigin</a></li>
												
												<li class="dropdown">	
													<a class="accountIcon icon1 dropdown-toggle profile logbtn" type="button" data-toggle="dropdown" data-toggle="tooltip" title="user Account">My Accounts
													</a>
													<ul class="dropdown-menu logmenu">
													  <li><a class="wishListIcon droplog" href="index.php?r=wishlist/showwishlist">Wishlist</a></li>
													  <li><a class="accountIcon droplog" href="index.php?r=myaccount/viewaddress">Account</a></li>
													  <li><a class="changePass droplog" href="index.php?r=/user/settings/account">Change Password</a></li>
													  <li><a class="accountIcon droplog" href="index.php?r=login/logout">Logout(<?= Yii::$app->user->identity->username?>)</a></li>
													</ul>
												</li>
											   <?php } ?> 
                                                                                                                                                              
										   </ul>
										</div>
									</div>
									<div class="rightlged1">
										<div class="iconcart">
											<?php if(!Yii::$app->user->isGuest) {
										  $items=  \backend\models\Cart::find()->where(['userid'=>Yii::$app->user->identity->id])->all();                     
											$count=sizeof($items);
											if(isset($count) && $count>1){ ?>
											<span class="cartitems"><?= $count?></span> 
											<?php } elseif(isset($count) && $count==1) {?>
											<span class="cartitems"><?= $count?></span>                                   
											<?php } else {?>
											<span class="cartitems">0</span> 
											<?php }  }
											else {?>
											<span class="cartitems">0</span> 
											<?php }  ?>
										</div>
										<a class="shoppingCart1" href="index.php?r=cart/displaycart" data-toggle="tooltip" title="Add to cart">
										<img src="../images/pawndoocart.png" id="shoppingkart"> 
										</a>
									</div>
									 
								</div> 
									
								<div class="hederbg">
									<span id="scrollbarfix" class="searchBtnWrap hidden-xs"> 
										<nav id="catdd" class="dropdown">
										   <?php      
											   $categorymenu=  new backend\models\Category();
											   echo $categorymenu->category_list();
											?>
										</nav>
										<!-- ------------new code------------- -->
										<?php $session = Yii::$app->session;?>
										   <form role="search" id="searchit" method="GET" class="" action="index.php">
											   <input type="hidden" name="r" value="search/searchallproducts" >
											   <input type="hidden" id="lat" name="currentlat" value="<?php echo $session['lat'] ?>">
											   <input type="hidden" id="lng" name="currentlng" value="<?php echo $session['lng'] ?>">      
											   <input type="text" id="type" name="search" placeholder="Search for Products, Services, Categories, Brands and Vendors" class="searchInput typesearch searchinp">											
												<!-- ------------end-------------- -->
												<button id="searchsubmit" type="submit" class="searchButton searchbtn" value="Search"><img src="../images/SearchLens.png" class="serchicn"></button>
											</form>
									</span>	
									<img id="locicon" src="images/loc.png" class="imgloc locatn" >
								</div>	
								<div style="display: none; z-index:99; position:absolute; margin-left:175px;" class="loc">
									<input id="googleaddress" name="searchaddr" value="<?php echo $session['addr'] ?>"  class="location hidden-xs" >
								</div>	
						</div>		
							
				</nav>
				<span class="mobsteicon" onclick="openNav()"><i class="icon-menu"></i></span>	 
				<!--span class="nav_toggle"><i class="icon-menu"></i></span-->
				<div id="mySidenav" class="sidenav">
					<div class="lftmenu">
						<div class="mobileHeader hidden-lg hidden-md"><a href="index.php"><img src="images/logo_mobo1.jpg"></a></div>
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-bars" aria-hidden="true"></i></a>
					</div>
					<span id="scrollbarfixmob" class="searchBtnWrap"> 
						<nav id="catdd" class="dropdown mobcat">
						   <?php      
							   $categorymenu=  new backend\models\Category();
							   echo $categorymenu->category_listmobile();
							?>
						</nav>
					<span>

				</div>
                 
			</div>
		</div>
		
	</div> 
	<script type="text/javascript" src="./js/search.js"></script>
</header>
	<form role="search" id="searchit" method="GET"  action="index.php" class="mt13">
		 <input type="hidden" name="r" value="search/searchallproducts" >
		 <input type="hidden" id="lat" name="currentlat" value="<?php echo Yii::$app->session['lat'] ?>">
		 <input type="hidden" id="lng" name="currentlng" value="<?php echo Yii::$app->session['lng'] ?>">   
		<div class="searchMobile" id="scrollmobfix">
			<div class="searcbox1"><input id="mobaddress" type="text" name="search" value="<?php echo  $session['addr'] ?>"  class="locationInput"></div>
			<div class="searcbox">
				<input type="text" id="type1"  name="search" placeholder="Products, Services, Catagories, Brands and Vendors" class="searchInput typesearch">
				<button type="submit" class="searchButton"><img src="../images/searchmob.png"></span> </button>
			</div> 
		</div>
	</form>

<?php } ?>
		<div class="container sectionWrap1">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<?= Alert::widget() ?>
			<?= $content ?>
		</div>
<section id="bottom">
  <div class="container bottom-pad">
    <div class="row">
      
        <div class="widget">
          <h3>About us</h3>
          <ul>
            <li><a href="index.php?r=site/aboutus">What is Digin ?</a></li>
            <li><a href="index.php?r=site/whydigin">Why Digin ?</a></li>
            <li><a href="#">Our Team</a></li>
          </ul>
        </div>
      
        <div class="widget">
          <h3>For vendors</h3>
          <ul>
              <li><a href="index.php?r=site/termscondven">Terms And Conditions</a></li>
              <li><a href="index.php?r=site/privacypolven">Privacy Policy</a></li>
              <li><a href="index.php?r=vendor/create">Registration</a></li>
              <li><a href="index.php?r=vendor/vendorlogin">Login</a></li>
          </ul>
        </div>
     
        <div class="widget">
          <h3>Careers</h3>
          <ul>
            <li><a href="#">Open Job</a></li>
            <li><a href="#">Contact HR</a></li>
            <li><a href="#">Why work with Digin</a></li>
          </ul>
        </div>
     
        <div class="widget">
          <h3>For Users</h3>
          <ul>
            <li><a href="index.php?r=site/termcondbuyr">Terms & Conditions</a></li>
            <li><a href="index.php?r=site/privacypolbuyr">Privacy Policy</a></li>
           
            <li><a href="index.php?r=site/orderpaymntpolicy">Order/Payment Policy</a></li>
            <li><a href="index.php?r=site/shippingpolicy">Delivery and Shipping Policy</a></li>
          </ul>
        </div>
      
        <div class="widget">
          <h3>Contact Us</h3>
          <ul>
            <li><a>105/1/1,Ground </br>Floor,Pavilion,Baner,</br>Pune,Maharastra,</br>India 411045</a></li>
            <li><a href="mailto:mail@digin.in" class="linedec">mail@digin.in</a></li>
          </ul> 
        </div>
      
    </div>
  </div>
</section>

	<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-xs-12 text-align">© 2015<a target="_blank" href="#" title="">Digin</a>. All Rights Reserved. </div>
      <div class="col-sm-6 col-xs-12 ">
        <ul class="">
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Faq</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </div>
<div class="row">
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> </div>
</div>
</footer>

	

</div>
<div id="email-box" class="login-popup">
			<div class="row">
				<div class="col-md-11 col-xs-11">
					<h2 class="pdLR">Send Email</h2>
				</div>
				<a href="#" class="close1"><i class="fa fa-times"></i></a>
			</div>
			
          <form method="post" class="signin" action="index.php?r=vendor/contactemail" id="email-form" novalidate="novalidate">
                <fieldset class="textbox">
					<div class="row">
						<input type="hidden" name="vid" value="<?php //echo $v['vid']; ?>">
						<input type="hidden" name="email" value="<?php// echo $v['email']; ?>">
						<input type="hidden" name="businessname" value="<?php //echo $v['businessname']; ?>">
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
								<div class="select-editable">
										<select onchange="this.nextElementSibling.value=this.value">
											<option class="drpfnt" value=""></option>
											<option class="drpfnt" value="Advertise on digin">Advertise on digin</option>
											<option class="drpfnt" value="Franchisee Registration">Franchisee Registration</option>
											<option class="drpfnt" value="Suggest a Vendor">Suggest a Vendor</option>
											<option class="drpfnt" value="Suggest a Product">Suggest a Product</option>
											<option class="drpfnt" value="Suggest a Service">Suggest a Service</option>
											<option class="drpfnt" value="Suggest a Category">Suggest a Category</option>
											<option class="drpfnt" value="Suggest a Brand">Suggest a Brand</option>
										</select>
										<input class="subdrpdwn" name="subject" value="" type="text">	
									</div>
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

<div id="message-box" class="login-popup">
			<div class="row">
				<div class="col-md-11 col-xs-11">
					<h2 class="pdLR">Send Message</h2>
				</div>
				<a href="#" class="close1"><i class="fa fa-times"></i></a>
			</div>
          <form method="post" class="signin" action="index.php?r=vendor/contactsms" id="message-form1" novalidate="novalidate" >
                <fieldset class="textbox">
					<div class="row">
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
								<input type="submit" name="submit" value="Submit" class="btn btnwdth">
							</div>
						</div>
					</div>
                </fieldset>
          </form>

		</div>
<?php $this->endBody() ?>
</html>

<?php $this->endPage() ?>

<script type="text/javascript" src="./js/moment.min.js"></script>
<script type="text/javascript" src="./js/daterangepicker.js"></script>

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
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initMap&key=AIzaSyD_qpzDaIVNke4z3Xem4YvX6Yt1eFbVULE" async defer></script> -->
