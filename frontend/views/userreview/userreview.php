
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
        <li class="active">Reviews</li>
      </ul>
      
      <!--h2 class="sectionHeading"><i class="fa fa-tag"></i><span>My Offer</span></h2-->
      <div class="container feedback">
      <form id="reviewuser" method="GET" action="index.php">
      <input type="hidden" name="r" value="userreview/adduserreview">
      <input type="hidden" name="vid" value="<?=Yii::$app->request->get('vid')?>">
      <?php foreach ($review as $r){
        echo  '<div class="row">
          <div class="col-xs-12">
            <div class="addressBlock clearfix">
              <h2>'.$r['question'].'</h2>
              <div class="col-xs-12 col-sm-3">
              <div><span><input type="radio" id="q_'.$r['qid'].'" name="q_'.$r['qid'].'" value="5" checked="checked"></span>Best</div>
               </div>
              <div class="col-xs-12 col-sm-3">
              <div><span><input type="radio" id="q_'.$r['qid'].'" name="q_'.$r['qid'].'" value="4"></span>Very Good</div>
               </div>
               <div class="col-xs-12 col-sm-2">
              <div><span><input type="radio" id="q_'.$r['qid'].'" name="q_'.$r['qid'].'" value="3"></span>Good</div>
               </div>
               <div class="col-xs-12 col-sm-2">
              <div><span><input type="radio" id="q_'.$r['qid'].'" name="q_'.$r['qid'].'" value="2"></span>Average</div>
               </div>
               <div class="col-xs-12 col-sm-2">
              <div><span><input type="radio" id="q_'.$r['qid'].'" name="q_'.$r['qid'].'" value="1"></span>Poor</div>
               </div>
          </div>
        </div>
      </div>';
       }?>
        
      
      <br> <br>
      <div style="height: auto;" id="collapseOne" class="addressForm">
      <div class="row">
      <div class="col-sm-6 col-xs-12">
                  <label>Add a Comment</label>
                  <textarea placeholder="Your Review" id="comment" name="cmnt" class="form-control"></textarea>
      </div>
      </div>
      </div>
      </form>  
    </div>
                 
        <div class="col-xs-12 section-footer" style="margin-left: 15px;"><a href="#" id="review" class="sellerAddressButton">Add Review</a></div>

    
  </div>
  <!-- end content --> 
  
  <script type="text/javascript">
      $(document).ready(function(){
          $("#review").click(function(){          
            if($("#comment").val()=="")
            {
                alert("Comment should be added!");
            }
            else{
                $("#reviewuser").submit();
            }
          });
      });
  </script>

  


