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

$(document).ready(function() {

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

                if (pos['lat'] == "" && pos['lng'] == "")
                {
                    pos = {
                        lat: 18.52043,
                        lng: 73.85674
                    };
                }

                geocoder.geocode({'location': pos}, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[1]) {

                            document.getElementById('googleaddress').value = results[1].formatted_address;

                            document.getElementById('mobaddress').value = results[1].formatted_address;
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                    lat = pos['lat'];
                    lng = pos['lng'];
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                    address = results[1].formatted_address;
                    /***************ajax call has made to add lat, lng, addr in session*********************/
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("GET", "index.php?r=site/details&lat=" + lat + "&lng=" + lng + "&address=" + address, true);
                    xhttp.send();
                });
            });
        }

        //set google address by entering any location   
        var inputaddr = document.getElementById('googleaddress');
        var mobaddr = document.getElementById('mobaddress');
        autocomplete = new google.maps.places.Autocomplete(inputaddr);

        autocomplete.addListener('place_changed', function() {
            locateAddress();
            var address = document.getElementById('googleaddress').value;
            /************start************/
            geocoder.geocode({'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    pos = {
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng()
                    };
                }
                lat = pos['lat'];
                lng = pos['lng'];
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET", "index.php?r=site/details&lat=" + lat + "&lng=" + lng + "&address=" + address, true);
                xhttp.send();
            });//end

        });
        /***********Repeat***********/
        autocomplete = new google.maps.places.Autocomplete(mobaddr);
        autocomplete.addListener('place_changed', function() {
            locateAddress();
            var address = document.getElementById('mobaddress').value;
            /************start************/
            geocoder.geocode({'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    pos = {
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng()
                    };
                }
                lat = pos['lat'];
                lng = pos['lng'];
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET", "index.php?r=site/details&lat=" + lat + "&lng=" + lng + "&address=" + address, true);
                xhttp.send();
            });//end

        });
    }

    function locateAddress() {

        var place = autocomplete.getPlace();
        if (place == null) {
            var geocoder = new google.maps.Geocoder();
            var address = document.getElementById('googleaddress').value;
        }
        else {
            if (document.getElementById('googleaddress').value != null && document.getElementById('googleaddress').value != '') {
                if (!place.geometry) {
                    window.alert("Place not found. Please check your address.");
                    return;
                }
            }
            else {
                window.alert("Please enter correct address.");
            }
        }
    }

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    $(function() {
        // $("#touchico").addClass("fa fa-chevron-down");
        var sf_menu_sub = $('.cat-menu-sub');
        $('.lvl_1 span').on('click', function(e) {
            e.stopPropagation();
            //sf_menu_sub.toggle();
            childul = $(this).parent().closest('li').find('ul').first();
            childul.toggle();
            $(this).children('.touchbutton').toggleClass("fa fa-chevron-up");
            //$(".touchbutton").addClass("fa fa-chevron-up");
            // $(".touchbutton").removeClass("fa fa-chevron-down");
        });
        $(document).on('click', function(e) {
            sf_menu_sub.hide();
            $(".touchbutton").addClass("fa fa-chevron-down");
        });
    });


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
            'margin-top': -popMargTop,
            'margin-left': -popMargLeft
        });
        return false;
    });

    // When clicking on the button close or the mask layer the popup closed
    $('a.close1, #mask').on('click', function() {
        $('#mask , .login-popup').fadeOut(300, function() {
            $('#mask').remove();
        });
        return false;
    });

});

