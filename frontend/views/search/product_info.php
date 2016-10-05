<script type="text/javascript" src="./js/jquery.popup.js"></script>
<script type="text/javascript" src="./js/product.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.popup.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<?php

use yii\widgets\ActiveForm;

$rows = $data->getModels();
?>
<style>
	.show {display:block;}
</style>

<div class="container sectionWrap">
    <ul class="breadcrumb">
        <?php
        if (isset($output[0]['path']) && $output[0]['path'] != "") {
            $prid = $output[0]['prid'];
            $catpro = \backend\models\ProductCategories::find()->where(['prid' => $prid])->one();
            foreach ($catpro as $c) {
                
            }
            $i = 0;
            $path = explode('/', $output[0]['path']);
            $len = count($path);
            foreach ($path as $p) {
                if ($i == 0)
                    echo '<li><a href="">' . $p . '</a></li>';
                if ($i == 1)
                    echo '<li><a href="index.php?r=productdetail/productdetails&catid=' . $c . '">' . $p . '</a></li>';
                if ($i == $len - 1) {
                    echo '<li class="active">' . $p . '</li>';
                }
                $i++;
            }
        } else {
            echo '<li><a href="index.php">Home</a></li>
			<li class="active">Products</li>';
        }
        ?>     
        <button id="myBtn" class="sharepopup"><i class="fa fa-share-alt fasize" ></i>
            Share</button>
        <!---for social site sharing-->
        <div id="share-button" class="modal">  
            <div class="modal-content">
                <?php
                echo \ijackua\sharelinks\ShareLinks::widget(
                        [
                            'viewName' => 'main.php'   //custom view file for you links appearance
                ]);
                ?>  
            </div>
        </div>		
    </ul>

    <div class="row productGallery">
        <div class="col-xs-12">
            <h3 class="productHeading"><?php
                if (isset($output[0]['prodname'])) {
                    echo $output[0]['prodname'];
                } else {
                    echo "Product Name";
                }
                ?> 
            </h3>
        </div>
        <div class="row">
<?php $url = $output[0]['image']
?>

            <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left single-container">
                            <img class="img-responsive img1" src="<?= (isset($url) ? $url : "images/1.jpeg"); ?>" id="DataDisplay"/> 
                        </div>	
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="myCarousel" class="carousel vertical slide pull-left mr10">
                            <div class="pull-right row-fluid">
<?php
foreach ($output[1] as $op) {
    $url = $op['image'];
    echo ' 
								  <a href="#" style ="width:50px;" class="small-thumbnail"><img src="' . $url . '" alt="Image" data-display="' . (isset($url) ? $url : "images/1.jpeg") . '" style="max-width:100%; width:50px;"></a>&nbsp;&nbsp;&nbsp; 
							   ';
}
?>                                             
                            </div><!--/row-fluid-->
                        </div> 
                    </div> 
                </div>    <!--/item--> 
            </div>
<?php $session = Yii::$app->session;
?>

            <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                        <div class="sorting hidden-xs">
                            <div class="dsrwdt"><a id="sort1" class="sortdistance"><span class="iconfont">Distance</span></a></div>
                            <div class="dsrwdt"><a id="sort2" class="sortprice"><span class="iconfont"> Price</span></a></div>
                            <div class="dsrwdt"><a id="sort3" class="sortrating"><span class="iconfont">Rating</span></a></div>
                        </div>
                        <div class="mobsorting hidden-lg hidden-md hidden-sm">
                            <div class="dsrwdt"><a id="mobsort1" class="sortdistance"><span class="iconfont"><img class="moblesorticon" src="images/Distance.png">
                                    </span></a></div>
                            <div class="dsrwdt"><a id="mobsort2" class="sortprice"><span class="iconfont"><img class="moblesorticon" src="images/money.png">
                                    </span></a></div>
                            <div class="dsrwdt"><a id="mobsort3" class="sortrating"><span class="iconfont"><img class="rateicon" src="images/ratings.png">
                                    </span></a></div>
                        </div>
                        <div class="fltricn facicon colwidth">		
                            <ul class="nav navbar-nav mr2">  
                                <li class="dropdown1">
                                        <?php $form = ActiveForm::begin(['id' => 'facilityform', 'method' => 'post',
                                                    'action' => ['search/searchproducts']]);
                                        ?>
                                        <h2 onclick="myFunction()" class="filterHead"><i class="fa fa-filter"></i></h2>
                                  <!--   <button onclick="myFunction()" class="filterHead"><i class="fa fa-filter"></i></button> -->
                                    <ul class="dropdown-menu facdrpdwn" id="myDropdown">
                                        <?php
                                        if (sizeof($output[3]) > 0) {
                                            foreach ($output[3] as $f) {

                                                echo '<div class="filterOption"><span><input type="checkbox" name="facility[]" class="fac" id="' . $f['facid'] . '"></span>' . $f['name'] . '</div>';
                                            }
                                            echo '<input type="hidden" name="prid" value="' . $output[0]['prid'] . '">'
                                            . '<div class="row  vendorBlock"><a class="cta facility" href="#" id="' . $output[0]['prid'] . '">OK</a> </div>';
                                        } else {
                                            echo '<div class="row  vendorBlock" style="font-size: 14px;"><b>No facilities to filter.</b></div>';
                                        }
                                        ?>          
                    <?php ActiveForm::end(); ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="scroll2"> 
                    <?php
                    $planfeature = new backend\models\PlanFeatures();
                    foreach ($rows as $v) {           //$rows new array of dataprovider
                        $result1 = $planfeature->getFeature($v['vid'], 1);
                        $result2 = $planfeature->getFeature($v['vid'], 2);
                        $result3 = $planfeature->getFeature($v['vid'], 3);
                        $rating = floatval($v['rating']);
                        $whole = floor($rating);
                        $fraction = $rating - $whole;

                        echo'
			 <div class="vendorBlock">
			  <div class="row">
			 <div class="thumbnail1">';
                        if ($result1 == 1)
                            echo '  <div class="row"><div class="col-md-7 col-sm-6 col-xs-12"><h2><a href="index.php?r=search/searchvendors&vid=' . $v['vid'] . '&frompage=1&vpid=' . $v['vpid'] . '&prid=' . $output[0]['prid'] . '" class="link">' . $v['businessname'] . '</a></h2></div>';
                        else {
                            echo '<h2>' . $v['businessname'] . '</h2>';
                        }

                        echo ' <div class="col-md-5 col-sm-6 col-xs-12"> <div class="vendorCost text-left">';
                        if ($result3 == 1) {
                            if ($v['wishlisttag'] == 1) {
                                echo '<a class="addtoFavorite wishlist"  id="' . $v['vid'] . '" href="#" style="color:#ff0000;">';
                            } else {
                                echo '<a class="addtoFavorite wishlist"  id="' . $v['vid'] . '" href="#">';
                            }
                        }
                        echo '<i class="fa fa-heart-o"></i></a>
						 ' .$v['currencycode'].' '. $v['price'] . '
					</div> </div></div>';

                        echo '<div class="ratings">
					 <div class="row">
					 <div class="col-md-7 col-sm-6 col-xs-12">';
                        for ($i = 0; $i < $whole; $i++) {
                            echo '<span class="glyphicon glyphicon-star "></span>';
                        }
                        if ($fraction >= 0.5) {
                            echo '<span class="glyphicon glyphicon-star half"></span>';
                        } else if ($v['rating'] == 0) {
                            echo '<span style="font-weight:bold; font-size:15px;">
							<span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>
							</span>';
                        }
                        echo '</div><div class="col-md-5 col-sm-6 col-xs-12"><span class="dist">' . $v['distance'] . ' km</span></div>';
                        echo '</div></div>';
                        //echo explode(" ",$v['price'])[1];
                       if ($result2 && $v['price'] != "0.00") {
                        
                            if ($v['delivery'] == 1) {
                                echo "<span class='d delivr' title='Digin Delivery'><b>D</b></span>";
                            }
                            if ($v['delivery'] == 2) {
                                echo "<span class='s delivr' title='Self Delivery' ><b >S</b></span>";
                            }
                            if ($v['delivery'] == 3) {
                                echo "<span class='glyphicon glyphicon-ban-circle n' title='No Delivery'></span>";
                            }

                            if ($v['can_book'] == 1) {
                                echo '<a href="#" class="cta buynow" id="' . $v['vpid'] . '">Book Now</a>';
                            } else {
                                echo '<a class="cta buy" href="#" id="' . $v['vpid'] . '">Add To Cart</a>';
                                echo '<a class="cta buynow" href="#" id="' . $v['vpid'] . '">Buy Now</a>';
                            }
                       }
                        echo '        		
				</div>
			</div>			
		</div>';
                    }
                    ?>                                  

                </div> </div>
        </div>
    </div> 
    <div class="col-xs-12">
        <?php if (!Yii::$app->user->isGuest) { ?>
            <div class="row"><b>Delivery to pincode: </b><span id="userpin"><?= isset($output[0]['pin']) ? $output[0]['pin'] : 0 ?></span>&nbsp;<a href="#" class="edit" title="Change Pincode" style="color: red;"><span class='glyphicon glyphicon-edit'></span></a></div> 
        <?php } else { ?>
            <div class="row"><b>Delivery to pincode: </b><span id="userpin"><?= isset($output[0]['pin']) ? $output[0]['pin'] : 411001 ?></span>&nbsp;<a href="#" class="edit" title="Change Pincode" style="color: red;"><span class='glyphicon glyphicon-edit'></span></a></div>
        <?php } ?>
<?php
$form = ActiveForm::begin(['id' => 'pincodeform', 'method' => 'post',
            'action' => ['search/searchproducts']]);
echo '<input type="hidden" name="prid" value="' . $output[0]['prid'] . '">';
?>                      
        <div class="updatepin" style="display: none; margin-bottom: 20px;">Enter pincode:<input type="text" name="pin" value="">             <input type="submit" class="btn btn-danger changepin" value="Update"></div>
                    <?php ActiveForm::end(); ?>
    </div> 

    <div class="row productInfo">
        <div class="col-xs-12">
            <div class="prodbox">
                <span class="proddesc">Description</span>
                <div class="accordion-inner">
<?php echo (isset($output[0]['description']) ? $output[0]['description'] : "None"); ?> 	 
                </div>
            </div>
        </div>
    </div>

</div>
<?php
/* * ********** get url of current page and explode it************* */
$qrystr = Yii::$app->request->getQueryString();
$qrystrarr = explode("&", $qrystr);

$qrystrarr1 = array_splice($qrystrarr, 0, 4);
if (isset($qrystrarr1[2])) {

    $sortstr = explode("=", $qrystrarr1[2]);

    $sortstrdata = $sortstr[1];
}
?>


<script type="text/javascript">
    $(document).ready(function() {
        /****************icon for asc and desc for sorting***************/
        sortstrng = '<?php if (isset($qrystrarr1[2])) {
    echo $sortstrdata;
} ?>';
        url = '<?php
$prid = $output[0]['prid'];
$bsurl = "index.php?r=search/searchproducts&prid=$prid";
echo $bsurl;
?>'

<?php if (!isset($sortstrdata)) { ?>
            $("#sort1").addClass("glyphicon glyphicon-chevron-up up updist");
            $("#mobsort1").addClass("glyphicon glyphicon-chevron-up up updist");
<?php } else { ?>
            $("#sort1").removeClass("glyphicon glyphicon-chevron-up up updist");
            $("#mobsort1").removeClass("glyphicon glyphicon-chevron-up up updist");
<?php } ?>


        $(".sortdistance").on('click', function(e) {
            window.location = url + '&sort=-distance';
            e.preventDefault();
        });

        if (sortstrng == '-distance') {
            $("#sort1").addClass("glyphicon glyphicon-chevron-down down downdist");
            $("#mobsort1").addClass("glyphicon glyphicon-chevron-down down downdist");
            $(".downdist").on('click', function() {
                window.location = url + '&sort=+distance';
            });
        }
        else if (sortstrng == '+distance') {
            $("#sort1").addClass("glyphicon glyphicon-chevron-up up updist");
            $("#mobsort1").addClass("glyphicon glyphicon-chevron-up up updist");
            $(".updist").on('click', function() {
                window.location = url + '&sort=-distance';
            });
        }

        $(".sortprice").on('click', function(e) {
            window.location = url + '&sort=-price';
            e.preventDefault();
            $("#sort1").removeClass("glyphicon glyphicon-chevron-up up updist");
            $("#mobsort1").addClass("glyphicon glyphicon-chevron-up up updist");
        });

        if (sortstrng == '-price') {
            $("#sort2").addClass("glyphicon glyphicon-chevron-down down downprice");
            $("#mobsort2").addClass("glyphicon glyphicon-chevron-down down downprice");
            $(".downprice").on('click', function() {
                window.location = url + '&sort=price';
            });
        }
        else if (sortstrng == 'price') {
            $("#sort2").addClass("glyphicon glyphicon-chevron-up up upprice");
            $("#mobsort2").addClass("glyphicon glyphicon-chevron-up up upprice");
            $(".upprice").on('click', function() {
                window.location = url + '&sort=-price';
            });
        }

        $(".sortrating").on('click', function(e) {
            window.location = url + '&sort=-rating';
            e.preventDefault();
        });


        if (sortstrng == '-rating') {
            $("#sort3").addClass("glyphicon glyphicon-chevron-down down downrate");
            $("#mobsort3").addClass("glyphicon glyphicon-chevron-down down downrate");
            $(".downrate").on('click', function() {
                window.location = url + '&sort=+rating';
            });
        }
        else if (sortstrng == '+rating') {
            $("#sort3").addClass("glyphicon glyphicon-chevron-up up uprate");
            $("#mobsort3").addClass("glyphicon glyphicon-chevron-up up uprate");
            $(".uprate").on('click', function() {
                window.location = url + '&sort=-rating';

            });
        }


    });

</script>

<script>
    $(document).ready(function() {

        $(document).on('click', ' .wishlist', function(e) {
            var id = $(this).attr('id');
<?php if (Yii::$app->user->isGuest) {
    ?>
                location.href = 'index.php?r=login/login';
<?php } else { ?>
                var vid = id;
                var type = 2;

                $.ajax({
                    type: "GET",
                    url: "index.php?r=wishlist/addtowishlist",
                    data: {
                        type: type,
                        vpid: vid,
                    },
                    success: function(result) {
                        if (result == 1) {
                            $('#' + id).css('color', '#ff0000');
                            alert("Your product is added in Wishlist.");
                        }
                        else {
                            alert("There might be some error occured.");
                        }
                    }
                });
<?php } ?>
        });

        /************************To add items in cart***********************************/
        $(document).on('click', ' .buy', function(e) {
            //alert($(this).attr('id'));  
            var vpid = $(this).attr('id');
<?php if (!Yii::$app->user->isGuest) {
    ?>
                location.href = 'index.php?r=cart/addandshowcart&userid=' +<?= Yii::$app->user->identity->id ?> + '&vpid=' + vpid + '&quantity=1';
<?php } else { ?>
                location.href = 'index.php?r=login/login';
<?php } ?>
        });

        /***************************To buy items immediately OR for Buy now*************************************************/
        $(document).on('click', ' .buynow', function(e) {
            var vpid = $(this).attr('id');
<?php if (!Yii::$app->user->isGuest) {
    ?>
                location.href = 'index.php?r=cart/buynow&vpid=' + vpid;
<?php } else { ?>
                location.href = 'index.php?r=login/login';
<?php } ?>
        });

        id = '';
<?php if (isset($output[4]) && $output[4] != "") {
    foreach ($output[4] as $f) {
        ?>
                id = '<?= $f ?>';
                $("#" + id).prop('checked', true);
    <?php }
} ?>

        /************************For filter of vendor facility***********************************************/
        var facdata = [];
        var input = '';
        $(".fac").change(function() {
            if ($(this).is(':checked')) {
                $("input[name='facility[]']:checked").each(function(index, element) {
                    if (jQuery.inArray($(this).attr('id'), facdata) == -1) {
                        facdata.push($(this).attr('id'));
                    }
                });
                $.each(facdata, function(index, value) {
                    input = '<input type="hidden" name="facid[]" class="fachidden" id="fac_' + value + '"  value="' + value + '">';
                    if (!$("#fac_" + value).length) {
                        $("#facilityform").append(input);
                    }
                });
            }
            else {
                $("#fac_" + $(this).attr('id')).remove();
            }

        });


        $(".facility").click(function() {
            $("#facilityform").submit();
        });

        $(".edit").click(function() {
            $(".updatepin").toggle();
        });

        $(".changepin").click(function() {
            var pin = $("input[name='pin']").val();
            $("#userpin").html(pin);
            $(".updatepin").css("display", "none");
            $("#pincodeform").submit();
        });

        $(".d").tooltip();
        $(".s").tooltip();
        $(".n").tooltip();
        $(".edit").tooltip();
    });

   /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}


</script>