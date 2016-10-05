/* ===========================================================
 * script.js v1.0
 * ===========================================================
 * Copyright 2015 Shivam Pandya - Tutorial Drive.
 * https://www.github.com/tutorialdrive
 *
 * Bootstrap Vertical Image Showcase v1.0
 * Create an Vertical Thumbnail Carousel For Twitter Bootstrap v3.0.3
 *
 * 
 * License: MIT License
 * http://opensource.org/licenses/MIT
 *
 * ========================================================== */

$(document).ready(function () {
 /* $('#myCarousel').carousel({
    interval: false
            //interval: 2000
  });*/
  $('.small-thumbnail img').click(function () {
    $('#DataDisplay').attr("src", $(this).attr("data-display"));
  });
 
 
$(document).on("scroll", function(e) {
  //alert(  $(document).scrollTop() );
  if ( $(document).scrollTop() > 30) {
    $("#scrollbarfix").addClass('searchonscroll');
    $("#googleaddress").addClass('googleaddonscroll');
    $("#topMenu").addClass('scroll');
    $("#headerbar").addClass('container-scroll');
     
    
    //$("#headerbar").css('position','fixed');
   // $("#catdd").addClass('catonscroll') ;
    $("#locicon").addClass('catonscroll') ;
    $("#searchsubmit").addClass('submitonscroll');
    $(".appDownloadIcon").removeClass('appDownloadIcon');
    $(".offerIcon").removeClass('offerIcon');
    $(".accountIcon").removeClass('accountIcon');
    $(".icon").addClass('icononscroll');
    $("#shoppingkart").addClass('shoppingkart');
    $("#logo-image").addClass('logo-image');
    $("#logo-text").addClass('logo-text');

  } else {
  
    $("#topMenu").removeClass('scroll');
    $("#headerbar").removeClass('container-scroll');
   // $("#catdd").removeClass('catonscroll') ;
    $("#locicon").removeClass('catonscroll') ;
    $("#searchsubmit").removeClass('submitonscroll');
    $(".appDownloadIcon").addClass('appDownloadIcon');
    $(".offerIcon").addClass('offerIcon');
    $(".accountIcon").addClass('accountIcon');
    $(".icon").removeClass('icononscroll');
    $("#googleaddress").removeClass('googleaddonscroll');
    $("#scrollbarfix").removeClass('searchonscroll');
    $("#shoppingkart").removeClass('shoppingkart');
    $("#logo-image").removeClass('logo-image');
    $("#logo-text").removeClass('logo-text');
  }
  
});


$(document).on("scroll", function(e) {
  //alert(  $(document).scrollTop() );
  if ($(document).scrollTop() > 1) {
      
    $("#scrollmobfix").css('position','fixed');
    $("#scrollmobfix").css('z-index','10');
    $("#scrollmobfix").css('width','100%');
  //  $("#scrollmobfix").css('margin-top','-42px');
    //$("#scrollmobfix").css('border-top','3px solid red');
    //$("#scrollmobfix").css('border-bottom','3px solid red'); 

   
  } else {
  
   $("#scrollmobfix").removeAttr('style');
  }
  
});

});

/*$(document).on('click','#venchart', function(e){
     var date=$('input[name="daterange"]').val();
   // alert(date);
    $.ajax({
        type:"POST",
           url:"index.php?r=vendor/vendorchartcal",           
           data:{Date:date}, 
           success:  function(result) { 	
//                var div = document.getElementById("venchart");
//			if (div.style.display !== "none") {
//				div.style.display = "none";
//			}
//			else {
//				div.style.display = "block";
//			}
		
            }
    });
	
});
*/
