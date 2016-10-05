    <div class="container sectionWrap">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Vendor</a></li>
        <li class="active">JUST CAKES </li>
      </ul>
        
     <!--?= \imanilchaudhari\socialshare\ShareButton::widget([
        'style'=>'horizontal',
        'networks' => ['facebook','googleplus','linkedin','twitter'],
        //'data_via'=>'imanilchaudhari', //twitter username (for twitter only, if exists else leave empty)
    ]);  ?-->  
     <!--div class="socialShareBlock">
        < ?=
        Html::a('<i class="icon-facebook-squared"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_FACEBOOK),
            ['title' => 'Share to Facebook']) ?>
        < ?=
        Html::a('<i class="icon-twitter-squared"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_TWITTER),
            ['title' => 'Share to Twitter']) ?>
        < ?=
        Html::a('<i class="icon-linkedin-squared"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_LINKEDIN),
            ['title' => 'Share to LinkedIn']) ?>
        < ?=
        Html::a('<i class="icon-gplus-squared"></i>', $this->context->shareUrl(ShareLinks::SOCIAL_GPLUS),
            ['title' => 'Share to Google Plus']) ?>
        
</div-->
     <?php  /* \ijackua\sharelinks\ShareLinks::widget(
        [
            'vendor_info' => Yii::$app->request->baseUrl.'/../views/search/vendor_info.php'   //custom view file for you links appearance
        ]);*/
     //echo Yii::$app->request->baseUrl; ?>
     
     <!--?=\imanilchaudhari\rrssb\ShareBar::widget([
        'title' => 'Title Content', // i.e. $model->title
        'media' => 'image.jpg', // Media Content
        'networks' => [
            //'Email',
            'Facebook',
            //'Github',
            'GooglePlus',
            //'Hackernews',
            'LinkedIn',
            //'Pinterest',
            //'Pocket',
            //'Reddit',
            //'Tumblr',
            'Twitter',
            //'Vk',
            //'Youtube'  
        ]
    ]); 
    ?-->
     <div class="row">
     <div id="fb-root"></div>	
    <script>
      window.fbAsyncInit = function() {
            FB.init({
              appId      : '114874615562032',
              xfbml      : true,
              version    : 'v2.5'
            });
          };
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<!-- Your share button code -->
	<div class="fb-share-button" 
		data-href="" 
		data-layout="button">
	</div>
        
       
      <div class="row">
        <div class="col-sm-4 col-md-3">
            <div class="thumbnail"><img alt=" " src="http://<?=$_SERVER["SERVER_NAME"]?>/advanced/images/vendorlogo/116/avatar613_086a4fc71063e563a931dccee6df7a9a.jpg" /></div>
        </div>
        <div class="col-sm-4 col-md-3">
        
            <div><b>JUST CAKES</b>
                
        <p class="ratings">
                 <?php            
                    echo '<span style="font-weight:bold; font-size:15px;"><b>None</b></span>';                
         ?></p>
			
			
        </div>
           <b>Address:-</b>Punit Yash Arcade, Shop No. 22, Near Kothrud Bus Stand,Pune,Maharashtra,411038
                   <b>Email:-</b> justcakespune@gmail.com           
        </div>
        
           <!--div class="col-sm-4 col-md-3"> <img src="images/google-map.png" class="img-responsive"> </div-->
           
          
          
          <div id="map" class="col-sm-4 col-md-3" style="height:165px;"> <?php //echo "Map..".$v['lat']; ?>   
        </div>
         <?php
          echo  "<input id='latlngven' type='hidden' value=18.5074119568,73.8076477051>";
            
             //var_dump($vendor);
           ?>
        
        <div class="col-sm-3 col-md-3 hidden-xs hidden-sm smallAdsVendorInfo">
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner1.jpg"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
            <div><a href="#"><img class="img-responsive" alt="" src="images/banner2.png"></a></div>
          </div>
        
       <!-- <div class="col-sm-3 hidden-xs">
          <div><img class="img-responsive" alt="" src="images/banner1.jpg"></div><br>

           <div><img class="img-responsive" alt="" src="images/banner2.png"></div>
        </div>-->
        
        
        <!--div class="col-xs-12 hidden-lg hidden-md hidden-sm">
          <div class="vendorDetails"> <a href="#"><span class="vendIcon"><i class="fa fa-map-marker"></i></span></a><span class="addressMobo">Address Line One Here, address line second here</span> </div>
        </div-->
       
      </div>
      <h2 class="sectionHeading"><i class="fa fa-tag"></i><span>My Offer</span></h2>
      <h2 class="sectionHeading"><i class="fa fa-tag"></i><span>My Products</span></h2>
      <?php echo '<div class="row text-center productList">';      
     
          echo ' <div class="col-sm-3 col-xs-6" style="height:261px;">
                <div class="thumbnail"><a href="index.php?r=search/searchproducts&prid=695" class="link"><img alt="" src="http://'.$_SERVER["SERVER_NAME"].'/advanced/images/productimages/695/cakes1.png" <p>Cake</p>
               </div>';      
        
         echo '</div>';
      
       ; ?>            
      
     
      <!--div class="reviewBlock">
        <h2>Customer Name</h2>
        <p class="ratings"> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star "></span> <span class="glyphicon glyphicon-star "></span> <span class="glyphicon glyphicon-star "></span> <span class="glyphicon glyphicon-star "></span> Ratings </p>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
      </div-->
      <a class="cta" href="index.php?r=userreview/showreview&vid=116">Post Review</a> </div>             
      <?php  //} else {   ?>
   

<script>
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
    calculateAndDisplayRoute(directionsService, directionsDisplay);
    
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
      window.alert('Directions request failed due to ' + status);
    }
  });
}
google.maps.event.addDomListener(window, 'load', displayMap);

</script>



