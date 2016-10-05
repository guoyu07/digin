<div class="container sectionWrap">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li class="active">Products</li>
      </ul>
        
  <?php 
  if(isset($product) && $product!=NULL){
  foreach ($product as $c){
	   $price="";
    if($c['price']!=NULL){
       $price='<span class="price"> Price starting at '. $c['currency'] ." ". $c['price']  .' </span> ';
     }
       echo '<div class="col-md-6 cartList">
				<div class="row mb10" id="cartitem_'.$c['vpid'].'">
					 <div class="col-md-4 text-center"><a href="index.php?r=search/searchproducts&prid='.$c['prid'].'"> <img class="img-responsive moboSingle" alt="" src='.$c['Image'].'> </a></div>
					<div class="col-md-8">
						<h4><a href="index.php?r=search/searchproducts&prid='.$c['prid'].'">'.$c['prodname'].'</a></h4>  
						 <p>'. $price.' </p>
            <p>Nearest distance '.round($c['distance'],1).' kms </p>
					</div>
				</div>
          </div>';          
         }
         }else{
             echo '<div class="item active"> <img src="images/search_not_found.png" style="margin-left:260px;">
               <div class="errormsg">
                  <a href="index.php" class="continueforShop" style="background: #f44336;">Go To Home Page </a></div>
                </div>';
        }
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>	
	
    </div>
