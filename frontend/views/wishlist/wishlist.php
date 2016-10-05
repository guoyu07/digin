
    
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
        <li class="active">Favourites</li>
       
      </ul>
       <div class="row wishProductList">
        <?php 
        if((isset($wish[0]) && $wish[0]!=NULL) || (isset($wish[1]) && $wish[1]!=NULL)){
             foreach ($wish[0] as $r)
            {
                  $url='index.php?r=search/searchproducts&prid='.$r['prid'];
                  
                       echo '<div class="col-xs-12"><a href="'.$url.'" class="clearfix wishList"><img src='.$r['Image'].' alt="" style="width:150px;height:150px;" class="pull-left">'
                               . '<div class="wishProductName"><h2>'.
                               $r['prodname'].'</h2>---'.$r['description'].'---</div><i class="fa fa-angle-right pull-right"></i></a></div>';
             } 
             foreach ($wish[1] as $r)
            {
                 $url='index.php?r=search/searchvendors&vid='.$r['vid'];
                 
                       echo '<div class="col-xs-12"><a href="'.$url.'" class="clearfix wishList"><img src='.$r['Logo'].' alt="" style="width:150px;height:150px;" class="pull-left">'
                               . '<div class="wishProductName"><h2>'.
                               $r['businessname'].'</h2>'.$r['aboutme'].'</div><i class="fa fa-angle-right pull-right"></i></a></div>';
             }
             }             
            else{
                    echo '<b><div class="row cartList">There are no products or vendors in your wishlist.</div></b>';
              }
             ?>
        </div>
    </div>
      