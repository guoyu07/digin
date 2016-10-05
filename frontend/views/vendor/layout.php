<script type="text/javascript" src="./js/jquery.drawPieChart.js"></script>
<link rel="stylesheet" type="text/css" href="./css/daterangepicker.css" />
<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dektrium\user\widgets\Connect;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use backend\models\GoogleSponseredAds;
use frontend\models\Diginleads;
use yii\helpers\BaseHtml;
use yii\jui\DatePicker;
use kartik\daterange\DateRangePicker;

//use backend\models\VendorSearch;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */
?>
<script type="text/javascript">
    $(".answer").hide();
    $(".coupon_question").click(function() {
        if ($(this).is(":checked")) {
            $(".answer").show();
        } else {
            $(".answer").hide();
        }
    });
</script>
<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker();
    });

  
$(document).ready(function() {
<?php if (isset($layoutpage)) { ?>
            $(".venhide").css("display", "none");
<?php } else { ?>
            $(".venshow").css("display", "none");
<?php } ?>
    });
</script>
<script type="text/javascript">
    $(function() {
       
        var start = moment().subtract(29, 'days');
        var end = moment();
   
       $('#vendorreport').daterangepicker();

if ($('input[name="dates"]').val()==""){
    $('#vendorreport').data('daterangepicker').setStartDate(start);
    $('#vendorreport').data('daterangepicker').setEndDate(end);
 }
 else
 { 
     $('#vendorreport').data('daterangepicker').setStartDate( $('input[name="dates"]').val().split("_")[0]);
      $('#vendorreport').data('daterangepicker').setEndDate( $('input[name="dates"]').val().split("_")[1]);
 }
    });
</script>
<div class="container">
	<ul class="breadcrumb">
		<li><a href="index.php?r=vendor/vendorlayout">Home</a></li>
		<li class="active">Sign In</li>
	</ul>
	<div class="vendashbrd" id="vendordash">
		<div class="row">
			
			<form method="post" class="signin" action="index.php?r=vendor/vendorlayout" id="venchart1" name="vendordata" > 
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="row">
						<input type="hidden" name="usid" id="uid" value="<?php echo Yii::$app->user->identity->id; ?>" > 
						
					  <?php 
					  if (isset($fromdate)){
						  $date = $fromdate ;   } else{
							  $date = "";
						  }
						  ?>
						  <div class="row">
								<div class="col-md-8 col-sm-10 col-xs-12">
									<input type="hidden" name="dates" id="dates" value="<?php echo $date ?>" > 
									<input id="vendorreport" class="pull-right" name="daterange" value="<?php echo $date ?>">
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<div type="submit" id="venchart" class="btn btn-primary calbtn" value="submit">Show</div> 
								</div>
						  </div>
					</div>
				</div>
			</form>
		</div>
			<div class="mt20"></div>
			<div class="ven" style="display: block" >
				<div class="row">
					 <?php if (isset($dataProvider)) {
					  ?>
					<div class="col-md-4 ">
						<div class="row">
						    <div class="col-md-12 col-sm-6 col-xs-12">
								<span class="chartlbl"><div class="labelbox"></div><div class="boxlabel" >Total Leads</div></span>
							</div> 
						</div>
						<div class="mt20"></div>
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12">
								<div id="pieChart" class="chart"></div>
							</div> 
						</div>
						<div class="mt20"></div>
						<div class="row">
						    <div class="col-md-12 col-sm-6 col-xs-12">
								<span class="chartlbl"><div class="labelbox1"></div><div class="boxlabel" >Total orders</div></span>
							</div> 
						</div> 
						<div class="mt20"></div>
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12">
								<div id="pieChart1" class="chart"></div>
							</div> 
						</div>
					</div>
					<?php //echo $diginimpression ?>
					<div class="col-md-8">  
						<h3>Product</h3>
						<h3><input type="checkbox" class="venproduct" checked > Product Wise</h3>
					   
					   <div class="venproductshow">
						 
						  <?=
							GridView::widget([
								'dataProvider' => $dataProvider,
								'columns' => [
									['class' => 'yii\grid\SerialColumn'],
									[
										'label' => 'Product Name',
										'headerOptions' => ['class'=>'list-group-item', 'id' =>'filt'],
										'attribute' => 'productname',
								        'format'=>'raw',
										'value' => function ($data) {
													return $data['productname'];                      
										},
									],
									[
										'label' => 'Google Impressions',
										'attribute' => 'googleimpression',
									],
									[
										'label' => 'Google Clicks',
										'attribute' => 'googleclicks',
									],
									[
										'label' => 'Digin Impressions',
										'attribute' => 'diginimpression',
									],
									[
										'label' => 'Digin Clicks',
										'attribute' => 'diginclicks',
									],
								],
							]);
							?>
						</div> 
						<div class="venproducthide" >
	  
							<table class="table table-striped table-bordered" id="vendortotal">
								<thead>
									<tr>
										<th>Product Name</th>
										<th>Google Impressions</th>
										<th>Google Clicks</th>
										<th>Digin Impressions</th>
										<th>Digin Clicks</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="vendor-search-input">$Total</td>
										<td class="vendor-search-input">-</td>
										<td class="vendor-search-input">-</td>
										<td class="vendor-search-input"><?php echo $vendorimpression ?></td>
										<td class="vendor-search-input"><?php echo $vendorclicks ?></td>
									</tr>
								<tbody>
							</table>
						</div> 
					 </div> <?php } ?>
				</div>
			</div>
	</div>
</div>
<?php 
$qrystr= Yii::$app->request->getQueryString();
$qrystrarr = explode("&",$qrystr);

$qrystrarr1 = array_splice($qrystrarr,0,4);
 if(isset($qrystrarr1[1])){
			
		$sortstr = explode("=",$qrystrarr1[1]);
			$sortstrdata = $sortstr[1];
		}
?>
<script>
    $(function() {
        vendimpressions = '<?php echo $vendorimpression ?>';
        totalleads = '<?php echo $vendorleads ?>';
        vendertotalorders = '<?php echo $vendororders ?>';

        vendimprper = vendimpressions / (vendimpressions + totalleads) * 100;
        vendleadper = totalleads / (vendimpressions + totalleads) * 100;
        vendordersper = vendertotalorders / (vendimpressions + totalleads) * 100;
        $("#pieChart").drawPieChart([
            {title: "Total Impressions", value: Math.round(vendimprper), color: "#333"},
            {title: "Total Leads", value: Math.round(vendleadper), color: "#D1092E"},
        ]);

        $("#pieChart1").drawPieChart([
            {title: "Total Impressions", value: Math.round(vendimprper), color: "#333"},
            {title: "Total Orders", value: Math.round(vendordersper), color: "#FC7C93"},
        ]);

    });

var form = document.getElementById("venchart1");

document.getElementById("venchart").addEventListener("click", function (e) {
     var date = $('input[name="daterange"]').val();
  form.submit();
});

 sortstrng = '<?php if(isset($qrystrarr1[1])){ echo $sortstrdata;  }?>'; 
	if(sortstrng == '-productname'){
		$(".list-group-item").addClass("glyphicon glyphicon-arrow-down downdist");   
	  }
	  else if(sortstrng =='productname'){
	        $(".list-group-item").addClass("glyphicon glyphicon-arrow-up updist");
	}
</script>

<script>
    $(".venproductshow").show();
    $(".venproducthide").hide();
    $(".venproduct").click(function() {
        if ($(this).is(":checked")) {
            $(".venproductshow").show();
            $(".venproducthide").hide();
        } else {
            $(".venproductshow").hide();
            $(".venproducthide").show();
        }
    });
</script>

