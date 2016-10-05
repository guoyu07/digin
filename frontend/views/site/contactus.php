 <?php
 
 
     
     
     //$url='index.php?r=site/contactus&name='.$r['nm'].'&email='.$r['mail'].'&subject='.$r['subject'].'&message='.$r['message'];
           
 ?>
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
        <li><a href="#">Contact Us</a></li>
       </ul>
        
         <div class="row cartList">
          
          <h4>Contact Form</h4>
          <span style="font-family: serif; font-size: 14px;">
          Send an Email. All fields with an * are required.
          </span>
          </div> 
       
        <div class="col-xs-12">
          <div id="accordion-first" class="clearfix">
          
             <div class="accordion" id="accordion2">
                  <div class="accordion-group">
                  <!--div class="accordion"-->
                       <div class="col-xs-6 col-xs-12">
                          <label>Phone:</label>+91 8878765544,9087876688
                      </div>
                      
                    <div class="col-xs-6 col-xs-12">
                          <label>Email:</label>mail@digin.in
                      </div>
               
                     <br><br><br> 
                    
               
                 <div class="accordion-inner"> 
                            
                             <form method="GET" id="contact" action="index.php?r=">
                  <div class="row">
                       <input type="hidden" name="r" value="site/contactus" >
                  <br>    
                  <div class="col-xs-6 col-xs-12">
                      <label>&nbsp;Name<span class="star">*</span></label>
                      <input type="text" name="usernm" placeholder="Name" class="form-control" required>
                  </div>
                  
                  <div class="col-xs-6 col-xs-12">  
                  <label>Email&nbsp;<span class="star">*</span></label>
                  <input type="email" name="mail" placeholder="Email Address" class="form-control" required>
                  </div>
                      
                  <div class="col-xs-6">
                  <label>Subject&nbsp;<span class="star">*</span></label>
                  <input type="text" name="subj" placeholder="Subject" class="form-control" required>
                  </div>
                       
                  
                  <div class="col-xs-9">
                      <label>Message&nbsp;<span class="star">*</span></label>
                  <textarea placeholder="Message" name="msg" class="form-control" style="height: 200px; width: 65%;" required></textarea>
                  </div>
                   
                  
                    <div class="col-xs-12">
                  <div class="section-footer">
                      
                       <!--button data-dismiss="modal" class="btn btn-default" type="button">Send Mail</button-->
                        <input type="submit" name="submit" value="Send Mail" class="btn">
                </div>
                   </div>
                  
                  </div>
                  </form>
                  </div>    
 
                   </div>
               </div>
            </div>
            <!-- end accordion --> 
          </div>
          </div>
          <!--/div-->
      <script type="text/javascript">
           
       $(document).ready(function () {
            $(".btn").click(function(){  
                
                
          //var name= document.getElementById('name');
          //alert("send mail...");
          $("#contact").submit();
        
            }) 
       })
       
       </script>