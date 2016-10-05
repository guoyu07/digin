<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;



//echo 'hello.....';
//if(isset($skillsmodel)){
    //echo 'vovonooo';
     //   var_dump($skillsmodel);
        
//}else
//{
    //echo 'no fond,...';
//}

//if(isset($sklachivemntmodel)){
     ///   var_dump($sklachivemntmodel);
        //echo 'fihhn...';
        
//}else
//{
   // echo 'no skill acjhoibvemege';
//}

//if (isset($commondetailmodel)){
   // var_dump($commondetailmodel);
//}

//if (isset($userdetailmodel)){
//var_dump($user);
   //var_dump($userdetailmodel['firstname']);
   //var_dump($user['email']);
    //var_dump($commondetailmodel);
//}?>
    <?php /*if(isset($userdetailmodel)){
     //foreach ($userdetailmodel as $usr)
     //{
         echo $userdetailmodel[0]; 
    //}
    
    }*/
 ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/style.css" />
 <div class="container sectionWrap" style="min-height: 900px;">
   <div id="wrapper">
       <div class="row">
        <fieldset class="scheduler-border">
        <legend class="scheduler-border legent1" style="width: auto;"><?php echo $usrdetail['firstname'].'&nbsp;&nbsp;'.$usrdetail['lastname']; ?></legend> 
        
        <!--*********************************Personal Information*******************************************-->
            <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent2" style="width: auto;">Personal Information</legend>
               
                    <div class="col-xs-4" style="margin-left: 100px;">
                   <table width="800" height="163" border="0">
                    <tr>
                      <td width="79" height="35"><strong>First Name:</strong></td>
                      <td width="184"><?php echo $userdetailmodel['firstname']; ?></td>
                      <td width="98"><strong>Middle Name: </strong></td>
                      <td width="167"><?php echo $userdetailmodel['middlename']; ?></td>
                      <td width="79"> <strong>Last Name:</strong></td>
                      <td width="153"><?php echo $userdetailmodel['lastname']; ?></td>
                    </tr>
                    <tr>
                      <td height="35"><strong>Email:</strong></td>
                      <td><?php echo $user['email']; ?></td>
                      <td><strong>Phone: </strong></td>
                      <td><?php echo $user['phone']; ?></td>
                      <td> <strong>Landline: </strong></td>
                      <td><?php echo $commondetailmodel['landline']; ?></td>
                    </tr>
                    <tr>
                      <td height="35"><strong>BirthDate:</strong></td>
                      <td><?php echo $commondetailmodel['birthdate']; ?></td>
                      <td><strong>Address:</strong></td>
                      <td colspan="3"><?php echo $userdetailmodel['address1'].', '.$userdetailmodel['address2']; ?></td>
                    </tr>
                    <tr>
                      <td height="35"><strong>City:</strong></td>
                      <td><?php echo $userdetailmodel['city']; ?></td>
                      <td><strong>State: </strong></td>
                      <td><?php echo $userdetailmodel['state']; ?></td>
                      <td> <strong>Country: </strong></td>
                      <td><?php echo $userdetailmodel['country']; ?></td>
                    </tr>
                  </table>

                 </div>
                 
            </fieldset><br>
        
         <!--*********************************Birth Place Information*******************************************-->
        <fieldset class="scheduler-border">
        <legend class="scheduler-border legent2" style="width: auto;">Birth Information</legend>
           <div class="col-xs-3" style="margin-left: 100px;">
                 <table width="800" border="0" height="100">
                  <tr>
                    <td width="68" height="35"><strong>Sex:</strong></td>
                    <td colspan="2"><?php echo $commondetailmodel['sex']; ?></td>
                      <td width="114"> <strong>Marital Status:</strong></td>
                    <td colspan="4"><?php echo $commondetailmodel['marrital_status']; ?></td>
                  </tr>
                  <tr>
                    <td height="32"><strong>Blog:</strong></td>
                    <td colspan="6"><?php echo $commondetailmodel['blog']; ?></td>
                  </tr>
                  <tr>
                    <td height="34"><strong>Religion: </strong></td>
                    <td width="107"><?php echo $religion['religion_name']; ?><td>
                    <td><strong>Cast: </strong></td>
                    <td width="106"><?php echo $cast['cast']; ?></td>
                  <td width="48"> <strong>Faith: </strong></td>
                    <td width="205"><?php echo $faith['faith']; ?></td>
                  </tr>
                </table>
                     </div>               
   </fieldset><br>
         
          <!--*********************************Family Information*******************************************-->
        <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent2" style="width: auto;">Family Information</legend>
               
                <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Parents Information</legend>
                <div class="col-xs-3" style="margin-left: 90px;">  
                <table width="800" border="0">
                    <tr>
                      <td width="104" height="46"><strong>Father</strong></td>  
                      <td width="104" height="46"><strong>First Name: </strong></td>
                      <td width="172"><?php echo $parentsmodel['father_firstname']; ?></td>
                      <td width="157"><strong>Last Name:</strong></td>
                      <td width="339"><?php echo $parentsmodel['father_lastname']; ?></td>
                    </tr>
                    <tr>
                      <td width="104" height="46"><strong>Mother</strong></td>
                      <td height="37"><strong>First Name:</strong></td>
                      <td><?php echo $parentsmodel['mother_firstname']; ?></td>
                      <td><strong>Last Name:</strong></td>
                      <td><?php echo $parentsmodel['mother_lastname']; ?></td>
                    </tr>
                  </table>
                     </div>
                 </fieldset> 
                 
              <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Sibblings Information</legend>
                  <div class="col-xs-3" style="margin-left: 90px;">  
                    <table width="730" border="0">
                    <tr>
                      <td width="48" height="33"><div align="center"><strong>Sr.No</strong></div></td>
                      <td width="186"><div align="center"><strong>First Name  </strong></div></td>
                      <td width="213"><div align="center"><strong>Last Name</strong></div></td>
                      <td width="165"><div align="center"><strong>Link</strong></div></td>
                      <td width="154"><div align="center"><strong>Relation</strong></div></td>
                    </tr>
                     <?php 
                     $no =0;
                 if(isset($sibblingmodel)){
                     foreach ($sibblingmodel as $sblnk){
                     $no = $no +1;
                 ?>
                    <tr>
                        <td height="33"><div align="center"><?php echo $no; ?></div></td>
                        <td><div align="center"><?php echo $sblnk['firstname']; ?></div></td>
                      <td><div align="center"><?php echo $sblnk['lastname']; ?></div></td>
                      <td><div align="center"><?php echo $sblnk['link']; ?></div></td>
                      <td><div align="center"><?php echo $sblnk['relation']; ?></div></td>
                    </tr>
                    <?php }} ?>
                     </table>
                       
                    </div>
                  </fieldset>   
               
                 
                 <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Spouse Information</legend>
                    <div class="col-xs-3" style="margin-left: 90px;">  
                      <table width="550" border="0">
                            <tr>
                              <td width="88" height="34"><strong>First Name:</strong></td>
                              <td width="247">&nbsp;&nbsp;<?php echo $spousemodel['firstname']; ?></td>
                              <td width="134"><strong>Last Name:</strong></td>
                              <td width="153"><?php echo $spousemodel['lastname']; ?></td>

                            </tr>
                            <tr>
                              <td height="33"><strong>Link:</strong></td>
                              <td>&nbsp;&nbsp;<?php echo $spousemodel['link']; ?></td>
                              <td><strong>Aniversary Date:</strong></td>
                              <td><?php echo $spousemodel['anniversary_date']; ?></td>

                            </tr>
                          </table>
                      </div>
                  </fieldset>  
               </fieldset><br>
               
            <!--*********************************Education Information*******************************************-->
             <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent2" style="width: auto;">Education Information</legend>
                <div class="col-xs-3" style="margin-left: 100px;">
                  <table width="720" border="0">
                        <tr>
                          <td width="50" height="36"><div align="center"><strong>Sr No. </strong></div></td>
                          <td width="109"><div align="center"><strong>Qualification</strong></div></td>
                          <td width="286"><div align="center"><strong>Institute</strong></div></td>
                          <td width="127"><div align="center"><strong>Year</strong></div></td>
                        </tr>
                         <?php 
                     $no =0;
                        if(isset($educationmodel)){
                           foreach ($educationmodel as $edu){
                                $no = $no +1;
                          ?>
                        <tr>
                          <td height="33"><div align="center"><?php echo $no; ?></div></td>
                          <td><div align="center"><?php echo $edu['qualification']; ?></div></td>
                          <td><div align="center"><?php echo $edu['institute']; ?></div></td>
                          <td><div align="center"><?php echo $edu['year']; ?></div></td>
                       </tr>
                        <?php }} ?>
                   </table>
                </div>
            </fieldset><br>
            
             <!--*********************************Medical Information*******************************************-->
          <fieldset class="scheduler-border">
            <legend class="scheduler-border legent2" style="width: auto;">Medical Information</legend>
              <fieldset class="scheduler-border">
               <legend class="scheduler-border legent3" style="width: auto;">Health Information</legend>
               
                 <div class="col-xs-3" style="margin-left: 100px;">
                  <table width="720" border="0">
                        <tr>
                          <td width="111" height="36"><strong>Bloodgroup:</strong></td>
                          <td width="183"><?php echo $healthmodel['bloodgroup']; ?></td>
                          <td width="69"><strong>Height:  </strong></td>
                          <td width="167"><?php echo $healthmodel['height'];?></td>
                          <td width="56"><strong>Weight:</strong></td>
                          <td width="108"><?php echo $healthmodel['weight']; ?></td>

                        </tr>
                        <tr>
                          <td height="33"><strong>Medication:</strong></td>
                          <td><?php echo $healthmodel['medication']; ?></td>
                          <td><strong></strong></td>
                          <td><?php //echo $healthmodel['diseases']; ?></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>

                        </tr>
                        <tr>
                          <td height="33" colspan="6">
                    <table width="300" border="0" style="outline-style: solid; outline-color: gray; outline-width: 1px;">
                    <tr>
                      <td width="109" height="33"><div align="left"><strong>Sr.No</strong></div></td>
                      <td width="181"><div align="left"><strong>Diseases</strong></div></td>
                    </tr>
                <?php  
                $no = 0;
                 if(isset($diesiesmdl)){
                  foreach ($diesiesmdl as $diesie)
                  {
                      $no = $no + 1;
                  ?>
                    <tr>
                      <td height="30"><div align="left">&nbsp;&nbsp;<?php  echo $no; ?></div></td>
                      <td><div align="left"><?php echo $diesie['disease'];  ?></div></td>
                    </tr>
                   <?php }} ?>
                </table>
                          </td>
                        </tr>
                 </table>
                     
                 </div>
                 </fieldset>
                 
                 <fieldset class="scheduler-border">
                     <legend class="scheduler-border legent3" style="width: auto;">Physician Information</legend>
                 <div class="col-xs-3" style="margin-left: 90px;">
                  <table width="730" border="0">
                        <tr>
                          <td width="39" height="36"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="250"><div align="center"><strong>Physician Name</strong></div></td>
                          <td width="262"><div align="center"><strong>Speciality </strong></div></td>
                          <td width="140"><div align="center"><strong><strong>Email</strong></strong></div></td>
                          <td width="75"><div align="center"><strong><strong>Phone</strong></strong></div></td>
                        </tr>
                        <?php 
                        $no = 0;
                        if(isset($physicianmodel)){
                            foreach ($physicianmodel as $physn){
                              $no = $no + 1;  
                           
                        ?>
                        <tr>
                          <td height="33"><div align="center"><?php echo $no; ?></div></td>
                          <td><div align="center"><?php echo $physn['physician_name']; ?></div></td>
                          <td><div align="center"><?php echo $physn['speciality']; ?></div></td>
                          <td><div align="center"><?php echo $physn['email']; ?>&nbsp;&nbsp;</div></td>
                          <td><div align="center">&nbsp;&nbsp;<?php echo $physn['phone']; ?></div></td>
                        </tr>
                        <?php }} ?>
                   </table>
                  </div>
                  </fieldset>
              </fieldset><br>
             
             <!--*********************************Goverment Information*******************************************-->
              <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent2" style="width: auto;">Government Information</legend>
                    <fieldset class="scheduler-border">
                     <legend class="scheduler-border legent3" style="width: auto;">Gov. Id Information</legend>
              <div class="col-xs-1" style="margin-left: 90px;">
                <table width="500" border="0">
                        <tr>
                          <td width="59" height="37"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="210"><div align="center"><strong>Gov. Document Type</strong></div></td>
                          <td width="209"><div align="center"><strong>Government No</strong></div></td>
                        </tr>
                            <?php
                             $no = 0;
                            if(isset($govdocnm)){
                             foreach ($govdocnm as $gov)
                             {
                                 $no = $no +1;
                             ?>
                        <tr>
                          <td height="30"><div align="center"><?php echo $no; ?></div></td>
                          <td><div align="center"><?php echo $gov['doc_name']; ?></div></td>
                          <td><div align="center"><?php echo $gov['govern_no']; ?></div></td>
                        </tr>
                        <?php }} ?>
                 </table>
                  
             
              </div><br><br>
                 
             </fieldset>
                    
            <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Passport Information</legend>
              <div class="col-xs-1" style="margin-left: 100px;">
                  <table width="730" border="0">
                        <tr>
                          <td width="100" height="35"><strong>Nationality:</strong></td>
                          <td width="226"><?php echo $passportmodel['nationality'] ?></td>
                          <td width="98"><strong>Passport No. :</strong></td>
                          <td width="248"><?php echo $passportmodel['passport_no']; ?></td>
                        </tr>
                        <tr>
                          <td height="32"><strong>Issue Date</strong></td>
                          <td><?php echo $passportmodel['issuedate']; ?></td>
                          <td><strong>Expiry Date:</strong></td>
                          <td><?php echo $passportmodel['expirydate']; ?></td>
                        </tr>
                      </table>
                   </div>
              </fieldset>
             </fieldset><br>
             
              <!--*********************************Vehicle Information*******************************************-->
         <fieldset class="scheduler-border">
           <legend class="scheduler-border legent2" style="width: auto;">Vehicle Information</legend>
             <div class="col-xs-1" style="margin-left: 100px;">
                <table width="640" border="0">
                    <tr>
                      <td width="46" height="35"><div align="center"><strong>Sr.No</strong></div></td>
                      <td width="264"><div align="center"><strong>Vehicle Type</strong></div></td>
                      <td width="233"><div align="center"><strong>Make</strong></div></td>
                      <td width="75"><div align="center"><strong>Year</strong></div></td>
                      <td width="148"><div align="center"><strong>Registration</strong></div></td>
                    </tr>
                    <?php 
                    $no =0;
                    if(isset($vehiclemodel)){
                        foreach ($vehiclemodel as $vhcl) {
                            $no = $no + 1;
                    ?>
                    <tr>
                      <td height="35"><div align="center"><?php echo $no; ?></div></td>
                      <td><div align="center"><?php echo $vhcl['vehicle_type']; ?></div></td>
                      <td><div align="center"><?php echo $vhcl['make']; ?></div></td>
                      <td><div align="center"><?php echo $vhcl['year']; ?></div></td>
                      <td><div align="center"><?php echo $vhcl['registration_no']; ?></div></td>
                    </tr>
                    <?php }} ?>
                  </table>
           </div>
          </fieldset><br>
              
                <!--*********************************Intellectual Information*******************************************-->
            <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Intellectual Information</legend>
                 <fieldset class="scheduler-border">
                <legend class="scheduler-border legent3" style="width: auto;">Hobbies</legend>
                 <div class="col-xs-1" style="margin-left: 90px;">
                   
                <table width="500" border="0">
                    <tr>
                      <td width="46" height="33"><div align="center"><strong>Sr.No</strong></div></td>
                      <td width="264"><div align="center"><strong>Hobbies</strong></div></td>
                    </tr>
                <?php  
                $no = 0;
                 if(isset($hbarry)){
                  foreach ($hbarry as $hbr)
                  {
                      $no = $no + 1;
                  ?>
                    <tr>
                      <td height="30"><div align="center"><?php  echo $no; ?></div></td>
                      <td><div align="center"><?php echo $hbr['hobby'];  ?></div></td>
                    </tr>
                   <?php }} ?>
                </table>
                    </div>
              </fieldset>
                
               <fieldset class="scheduler-border">
                <legend class="scheduler-border legent3" style="width: auto;">Plans</legend>
                <div class="col-xs-1" style="margin-left: 100px;">
                     <table width="700" border="0">
                        <tr>
                          <td width="46" height="33"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="171"><div align="center"><strong>Plans</strong></div></td>
                          <td width="357"><div align="left"><strong>Description</strong></div></td>
                        </tr>
                         <?php 
                      $no = 0;
                      if(isset($planmodel)){
                            foreach ($planmodel as $pln)
                            {
                                $no = $no + 1;
                            ?>
                        <tr>
                          <td height="30"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="center"><?php echo $pln['plantype'];  ?></div></td>
                          <td><div align="left"><?php echo $pln['description']; }} ?></div></td>
                        </tr>
                    </table>
                 </div>
               </fieldset>
                
               <fieldset class="scheduler-border">
                <legend class="scheduler-border legent3" style="width: auto;">Creations</legend>
                <div class="col-xs-1" style="margin-left: 100px;">
                   <table width="800" border="0">
                        <tr>
                          <td width="46" height="35"><div align="left"><strong>Sr.No</strong></div></td>
                          <td width="195"><div align="left"><strong>&nbsp;&nbsp;Title</strong></div></td>
                          <td width="333"><div align="left"><strong>Note</strong></div></td>
                          <td width="333"><div align="left"><strong>YouTubeLink</strong></div></td>
                          <td width="333"><div align="left"><strong>Image</strong>s</div></td>
                        </tr>
                         <?php 
                                $no = 0;
                                if(isset($creationmodel)){
                                foreach ($creationmodel as $crtn)
                                {
                                    $no = $no + 1;
                          ?>
                        <tr>
                          <td height="35"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $crtn['title'];  ?></div></td>
                          <td><div align="left"><?php echo $crtn['note'];  ?></div></td>
                          <td><div align="left"><?php echo $crtn['youtoube_link']; ?></div></td>
                          <td><div align="left"><?php echo Html::img(Yii::$app->request->baseUrl. '/../../subscriberimg/creationimg/'. $crtn->crid.'/'. $crtn->image, ['width'=>200, 'height'=>200, 'alt'=>'Blank','class' => 'pull-left img-responsive']); }} ?></div></td>
                        </tr>
                      </table> 
                 </div>
               </fieldset>
                
               <fieldset class="scheduler-border">
                <legend class="scheduler-border legent3" style="width: auto;">Achievements</legend>
                <div class="col-xs-1" style="margin-left: 100px;">
                      <table width="700" border="0">
                        <tr>
                          <td width="46" height="35"><div align="left"><strong>Sr.No</strong></div></td>
                          <td width="195"><div align="left"><strong>Title</strong></div></td>
                          <td width="333"><div align="left"><strong>Note</strong></div></td>
                          <td width="333"><div align="left"><strong>Professional Plans</strong></div></td>
                        </tr>
                        <?php 
                            $no = 0;
                            if(isset($achievementmodel)){
                            foreach ($achievementmodel as $achv)
                            {
                                $no = $no + 1;
                            ?>
                        <tr>
                          
                          <td  height="35"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $achv['title'];  ?></div></td>
                          <td><div align="left"><?php echo $achv['note'];  ?></div></td>
                          <td><div align="left"><?php echo $achv['professional_plan']; }} ?></div></td>
                        </tr>
                      </table>
                 </div>
               </fieldset>
               
                <fieldset class="scheduler-border">
                <legend class="scheduler-border legent3" style="width: auto;">Philosophy</legend>
                <div class="col-xs-1" style="margin-left: 80px;">
                    <table width="600" border="0">
                        <tr>
                          <td width="71" height="33"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="513"><strong>Philosophy Text</strong></td>
                        </tr>
                        <?php 
                  $no = 0;
                  if(isset($philosophymodel)){
                  foreach ($philosophymodel as $phls)
                  {
                      $no = $no + 1;
                  ?>
                        <tr>
                          <td height="33"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $phls['philosophytext']; }} ?></div></td>
                        </tr>
                      </table>
                 </div>
               </fieldset>
                
                <fieldset class="scheduler-border">
                <legend class="scheduler-border legent3" style="width: auto;">Memories</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
                    <table width="500" border="0">
                        <tr>
                          <td width="71"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="513"><div align="left"><strong>Title</strong></div></td>
                          <td width="513"><div align="left"><strong>Note</strong></div></td>
                        </tr>
                        <?php 
                            $no = 0;
                            if(isset($memorymodel)){
                            foreach ($memorymodel as $memr)
                            {
                                $no = $no + 1;
                          ?>
                        <tr>
                          <td><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $memr['title'];  ?></div></td>
                          <td><div align="left"><?php echo $memr['note']; }} ?></div></td>
                        </tr>
                      </table>
                   </div>
               </fieldset>
             </fieldset><br>
                
      <!--*********************************Liking Information*******************************************-->
              <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Likings</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
                     <table width="500" border="0">
                        <tr>
                          <td width="71" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="513"><div align="left"><strong>Title</strong></div></td>
                          <td width="513"><div align="left"><strong>Note</strong></div></td>
                        </tr>
                         <?php 
                            $no = 0;
                            if(isset($likingmodel)){
                            foreach ($likingmodel as $lk)
                            {
                                $no = $no + 1;
                            ?>
                        <tr>
                          <td height="29"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $lk['title'];  ?></div></td>
                          <td><div align="left"><?php echo $lk['note']; }} ?></div></td>
                        </tr>
                      </table>
                 </div>
               </fieldset><br>
               
        <!--*********************************Dislikes Information*******************************************-->
       <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Dislikes</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
                   <table width="500" border="0">
                        <tr>
                          <td width="71" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="513"><div align="left"><strong>Title</strong></div></td>
                          <td width="513"><div align="left"><strong>Note</strong></div></td>
                        </tr>
                         <?php 
                          $no = 0;
                          if(isset($dislikemodel)){
                          foreach ($dislikemodel as $dlk)
                          {
                              $no = $no + 1;
                         ?>
                        <tr>
                          <td height="29"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $dlk['title'];  ?></div></td>
                          <td><div align="left"><?php echo $dlk['note']; }} ?></div></td>
                        </tr>
                      </table> 
                 </div>
               
               </fieldset><br>
             
                 <!--*********************************Belongings Information*******************************************-->
       <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Belongings</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
                      <table width="800" border="0">
                        <tr>
                          <td width="71" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="245"><div align="left"><strong>Title</strong></div></td>
                          <td width="366"><div align="left"><strong>Note</strong></div></td>
                          <td width="181"><div align="left"><strong>Image</strong></div></td>
                        </tr>
                         <?php 
                            $no = 0;
                            if(isset($belongingmodel)){
                            foreach ($belongingmodel as $blgs)
                            {
                                $no = $no + 1;
                            ?>
                        <tr>
                          <td height="29"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $blgs['title'];  ?></div></td>
                          <td><div align="left"><?php echo $blgs['note'];  ?></div></td>
                          <td><div align="left"><?php echo Html::img(Yii::$app->request->baseUrl. '/../../subscriberimg/belongingimg/'. $blgs->id.'/'. $blgs->image, ['width'=>50, 'height'=>50, 'alt'=>'Blank','class' => 'pull-left img-responsive']); }} ?></div></td>
                        </tr>
                      </table>
                  </div>
       </fieldset><br>
                   
                   
          <!--*********************************Idols Information*******************************************-->
       <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Idols</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
                       <table width="318" border="0">
                        <tr>
                          <td width="57" height="39"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="245"><div align="left"><strong>Name</strong></div></td>
                        </tr>
                        <?php 
                            $no = 0;
                            if(isset($idolmodel)){
                            foreach ($idolmodel as $idls)
                            {
                                $no = $no + 1;
                            ?>
                        <tr>
                          <td height="29"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $idls['name'];  ?></div></td>
                        </tr>
                            <?php }}?>
                      </table>
                </div>
       </fieldset><br>
             
         <!--*********************************Leasure Information*******************************************-->
       <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Travel Details</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
                     <table width="700" border="0">
                        <tr>
                          <td width="35" height="35"><div align="center">&nbsp;&nbsp;&nbsp;<strong>Sr.No</strong></div></td>
                          <td width="100"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Place</strong></div></td>
                          <td width="110"><div align="left"><strong>Year</strong></div></td>
                          <td width="419"><div align="left"><strong>Description</strong></div></td>
                        </tr>
                        <?php 
                            $no = 0;
                            if(isset($travelmodel)){
                            foreach ($travelmodel as $trvl)
                            {
                                $no = $no + 1;
                         ?>
                        <tr>
                          <td height="35"><div align="center">&nbsp;&nbsp;&nbsp;<?php echo $no ;  ?></div></td>
                          <td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $trvl['place']; ?></div></td>
                          <td><div align="left"><?php echo $trvl['year'];  ?></div></td>
                          <td><div align="left"><?php echo $trvl['description'];  ?></div></td>
                        </tr>
                            <?php }} ?>
                      </table>
                </div>
       </fieldset><br>
           
           <!--*********************************Social Site Information*******************************************-->
       <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Social Site Details</legend>
                <div class="col-xs-1" style="margin-left: 80px;">
                    <table width="700" border="0">
                        <tr>
                          <td width="43" height="35"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="100"><div align="left"><strong>Social Site</strong></div></td>
                          <td width="110"><div align="left"><strong>Link</strong></div></td>
                        </tr>
                         <?php 
                            $no = 0;
                            if(isset($socialmediamodel)){
                            foreach ($socialmediamodel as $scial)
                            {
                                $no = $no + 1;
                            ?>
                        <tr>
                          <td height="35"><div align="center"><?php echo $no ; ?></div></td>
                          <td><div align="left"><?php echo $scial['socialmedia_site']; ?></div></td>
                          <td><div align="left"><?php echo $scial['link']; ?></div></td>
                        </tr>
                  <?php }} ?>
                      </table>
                </div>
       </fieldset><br>
       
                   <!--*********************************Media Information*******************************************-->
       <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Media</legend>
                <div class="col-xs-1" style="margin-left: 100px;">
                    <table width="800" border="0">
                        <tr>
                          <td width="47" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="135"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Title</strong></div></td>
                          <td width="169"><div align="left"><strong>Note</strong></div></td>
                          <td width="206"><div align="left"><strong>Link</strong></div></td>
                          <td width="254"><div align="left"><strong>Image</strong></div></td>
                        </tr>
                         <?php 
                            $no = 0;
                            if(isset($mediamodel)){
                            foreach ($mediamodel as $mda)
                            {
                                $no = $no + 1;
                          ?>
                        <tr>
                          <td height="29"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mda['title'];  ?></div></td>
                          <td><div align="left"><?php echo $mda['note'];  ?></div></td>
                          <td><div align="left"><?php echo $mda['link'];  ?></div></td>
                          <td><div align="left"><?php echo Html::img(Yii::$app->request->baseUrl. '/../../subscriberimg/mediaimg/'. $mda->mid.'/'. $mda->image, ['width'=>50, 'height'=>50, 'alt'=>'Blank','class' => 'pull-left img-responsive']); }} ?></div></td>
                        </tr>
                      </table>
                 </div>
               
       </fieldset><br>
             
        <!--*********************************Finance Information*******************************************-->
        <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Finance</legend>
                
                <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Investment</legend>
              <div class="col-xs-1" style="margin-left: 90px;">
                   <table width="800" border="0">
                        <tr>
                          <td width="39" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="143"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Investment Type</strong></div></td>
                          <td width="177"><div align="left"><strong>Valuation</strong></div></td>
                          <td width="190"><div align="left"><strong>Description</strong></div></td>
                          <td width="117"><div align="left"><strong>Annual Income</strong></div></td>
                        </tr>
                         <?php 
                                $no = 0;
                                if(isset($investmodel)){
                                foreach ($investmodel as $invst)
                                {
                                    $no = $no + 1;
                         ?>
                        <tr>
                          <td height="34"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $invst['investment_type'];  ?></div></td>
                          <td><div align="left"><?php echo $invst['valuation'];  ?></div></td>
                          <td><div align="left"><?php echo $invst['description'];}}  ?></div></td>
                          <td><div align="left"><?php echo $commondetailmodel['annual_income'];  ?></div></td>
                        </tr>
                  </table>
                 </div>
                 </fieldset>
                
              
                <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Banking</legend>
              <div class="col-xs-1" style="margin-left: 90px;">
                     <table width="800" border="0">
                        <tr>
                          <td width="39" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="143"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Bank Name</strong></div></td>
                          <td width="177"><div align="left"><strong>Branch Name</strong></div></td>
                          <td width="190"><div align="left"><strong>Acc. No</strong></div></td>
                          <td width="117"><div align="left"><strong>IFSC Number</strong></div></td>
                        </tr>
                         <?php 
                        $no = 0;
                        if(isset($bankmodel)){
                        foreach ($bankmodel as $bnk)
                        {
                            $no = $no + 1;
                        ?>
                        <tr>
                          <td height="34"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $bnk['bankname'];  ?></div></td>
                          <td><div align="left"><?php echo $bnk['branchname'];  ?></div></td>
                          <td><div align="left"><?php echo $bnk['account_no'];  ?></div></td>
                          <td><div align="left"><?php echo $bnk['IFSC_no']; }} ?></div></td>
                        </tr>
                  </table>
                 </div>
                 </fieldset>
        </fieldset><br>
        
         <!--*********************************Professional Information*******************************************-->
         <fieldset class="scheduler-border">
                <legend class="scheduler-border legent2" style="width: auto;">Professional Information</legend>
                
                <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Occupation</legend>
                  <div class="col-xs-1" style="margin-left: 70px;">
                      <table width="800" style="outline-style: solid; outline-color: gray; outline-width: 1px;">
                        <tr>
                          <td width="81" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="158"><div align="left"><strong>OccupationType</strong></div></td>
                          <td width="156"><div align="left"><strong>&nbsp;&nbsp;&nbsp;Designation</strong></div></td>
                          <td width="116"><div align="left"><strong>Tenure</strong></div></td>
                          <td width="135"><div align="left"><strong>&nbsp;From Date</strong></div></td>
                          <td width="123"><div align="left"><strong>&nbsp;To Date</strong></div></td>
                          <td width="1" rowspan="2">&nbsp;</td>
                        </tr>
                         <?php 
                            $no = 0;
                            if(isset($occupationmodel)){
                            foreach ($occupationmodel as $occpn)
                            {
                                $no = $no + 1;
                            ?>
                           <tr>
                          <td height="29"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $occpn['occupationtype'];  ?></div></td>
                          <td><div align="left"><?php echo $occpn['designation'];  ?></div></td>
                          <td><div align="left"><?php echo $occpn['tenure'];  ?></div></td>
                          <td><div align="left">&nbsp;&nbsp;&nbsp;<?php echo $occpn['fromdate'];  ?></div></td>
                          <td><div align="left">&nbsp;&nbsp;&nbsp;<?php echo $occpn['todate']; ?></div></td>
                        </tr>
                           <tr>
                             <td height="29" colspan="7"><div align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description</strong></div></td>
                           </tr>
                           <tr style="border-bottom: 1px solid gray;">
                             <td height="29" colspan="7"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $occpn['description']; ?></div><?php }} ?></td>
                             </tr>
                      </table>
                  </div>
                 
               </fieldset>
                
                 <fieldset class="scheduler-border">
                 <legend class="scheduler-border legent3" style="width: auto;">Skills</legend>
                  <div class="col-xs-1" style="margin-left: 90px;">
                    <table width="700" border="0">
                        <tr>
                          <td width="55" height="35"><div align="left"><strong>Sr.No</strong></div></td>
                          <td width="235"><div align="left"><strong>Skills</strong></div></td>
                          <td width="388"><div align="left"><strong>Description</strong></div></td>
                        </tr>
                         <?php 
                            $no = 0;
                            if(isset($usrskllmd)){
                            foreach ($usrskllmd as $usrskl)
                            {
                                $no = $no + 1;
                            ?>
                        <tr>
                          <td height="35"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left"><?php echo $usrskl['skill'];  ?></div></td>
                          <td><div align="left"><?php echo $usrskl['description'];}}  ?></div></td>
                        </tr>
                      </table>
                 </div>
               </fieldset>
                
             <fieldset class="scheduler-border">
              <legend class="scheduler-border legent3" style="width: auto;">Consultants</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
                  <table width="740" border="0">
                    <tr>
                      <td width="39" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                         <td width="143"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Consultant Type</strong></div></td>
                          <td width="177"><div align="left"><strong>Name</strong></div></td>
                          <td width="190"><div align="left"><strong>Phone</strong></div></td>
                          <td width="117"><div align="left"><strong>Email</strong></div></td>
                          </tr>
                          <?php 
                            $no = 0;
                            if(isset($consultantmodel)){
                            foreach ($consultantmodel as $conslt)
                            {
                                $no = $no + 1;
                            ?>
                         <tr>
                        <tr>
                          <td height="34"><div align="center"><?php echo $no ;  ?></div></td>
                          <td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $conslt['consultant_type'];  ?></div></td>
                          <td><div align="left"><?php echo $conslt['name'];  ?></div></td>
                          <td><div align="left"><?php echo $conslt['phone'];  ?></div></td>
                          <td><div align="left"><?php echo $conslt['email'];}}  ?></div></td>
                        </tr>
                      </table>
                      
                 </div>
               </fieldset>
                
              <fieldset class="scheduler-border">
                <legend class="scheduler-border legent3" style="width: auto;">Testimonials</legend>
                <div class="col-xs-1" style="margin-left: 90px;">
              <table width="750" border="0">
                <tr>
                <td width="39" height="34"><div align="center"><strong>Sr.No</strong></div></td>
                          <td width="156"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Quotes</strong></div></td>
                          <td width="215"><div align="left"><strong>Name</strong></div></td>
                          <td width="139"><div align="left"><strong>Image</strong></div></td>
                     </tr>
                      <?php 
                        $no = 0;
                        if(isset($testmodel)){
                        foreach ($testmodel as $test)
                        {
                            $no = $no + 1;
                        ?>
                    <tr>
                        <td height="34"><div align="center"><?php echo $no ;  ?></div></td>
                        <td><div align="left">&nbsp;&nbsp;&nbsp;<?php echo $test['quotes'];  ?></div></td>
                        <td><div align="left"><?php echo $test['name']; ?></div></td>
                        <td><div align="left"><?php echo Html::img(Yii::$app->request->baseUrl. '/../../subscriberimg/testimonialimg/'. $test->testid.'/'. $test->image, ['width'=>50, 'height'=>50, 'alt'=>'Blank','class' => 'pull-left img-responsive']); }} ?></div></td>
                    </tr>
                  </table>
                    </div>
            </fieldset>
            
         </fieldset><br>
        </fieldset>
        </div>
    </div>
  </div>