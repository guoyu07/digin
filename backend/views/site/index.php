<?php



$this->title = 'Digin';
?>
<!--div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div-->

<?php use yii\helpers\Url; ?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />

<?php $role='';
    $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
    foreach($userrole as $r)
    {
      $role=$r->name;
    }
    
?>

<?php $categories=  \backend\models\Category::find()->all();
      $totalcategories=sizeof($categories);?>
<?php if($role=='Superadmin' || $role=='Admin') {?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Category</h3>
                      <p><?= $totalcategories ?></p>
                    </div>                
                  <a href="<?= Url::to(['/category/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
                
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin' || $role=='Executive') {?>
<?php $vendors=  \backend\models\Vendor::find()->where(['Is_active'=>1])->all();
      $totalvendors=sizeof($vendors);
      if($role=='Executive')
      {
          $exevendors=  \backend\models\Vendor::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_active'=>1])->all();
          $totalvendors=sizeof($exevendors);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Vendor</h3>
                      <p><?= $totalvendors ?></p>
                    </div>                
               <?php //if($role=='Superadmin' || $role=='Admin') {?>
<!--                <a href="< ?= Url::to(['/vendor/index'])?>" class="small-box-footer">Add More  <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>-->
                <?php //} else if($role=='Executive') {?>
                 <a href="<?= Url::to(['/vendor/index'])?>" class="small-box-footer">Add More  <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
                <?php //} ?>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $plans=  backend\models\Plan::find()->all();
      $totalplans=sizeof($plans);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Plan</h3>
                      <p><?= $totalplans ?></p>
                    </div>                
                <a href="<?= Url::to(['/plan/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $facilities=  \backend\models\Facility::find()->all();
      $totalfacilities=sizeof($facilities); ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Facility</h3>
                      <p><?= $totalfacilities ?></p>
                    </div>                
                <a href="<?= Url::to(['/facility/index'])?>" class="small-box-footer">Add More  <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php $ventypes=  \backend\models\Vendortype::find()->all();
      $totalventypes=sizeof($ventypes);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Vendor Type</h3>
                      <p><?= $totalventypes ?></p>
                    </div>                
                <a href="<?= Url::to(['/vendortype/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>


<?php $products=  backend\models\Product::find()->all();
      $totalproducts=sizeof($products);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Product</h3>
                      <p><?= $totalproducts ?></p>
                    </div>                
                <a href="<?= Url::to(['/product/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php } ?>

<?php  if($role=='Vendor'){?>
<?php $products=  backend\models\Product::find()->where(['crtby'=>Yii::$app->user->identity->id])->all();
      $totalproducts=sizeof($products);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Product</h3>
                      <p><?= $totalproducts ?></p>
                    </div>                
                <a href="<?= Url::to(['/product/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php } ?>


<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $vendors=  \backend\models\Vendor::find()->where(['Is_active'=>0])->all();
      $totalvendors=sizeof($vendors);
      if($role=='Executive')
      {
          $exevendors=  \backend\models\Vendor::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_active'=>0])->all();
          $totalvendors=sizeof($exevendors);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>InActive Vendor</h3>
                      <p><?= $totalvendors ?></p>
                    </div> 
                  <?php //echo  Url::to(['/vendor/index&VendorSearch[Is_active]=0']); ?>
                <a href="<?= Url::to(['/vendor/index','VendorSearch[Is_active]'=>0])?>" class="small-box-footer">View<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $veninactprods= \backend\models\Product::find()->where(['Is_active'=>0])->all();
      $totalveninactpros=sizeof($veninactprods);
      if($role=='Executive')
      {
          $exevendors= \backend\models\Product::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_active'=>0])->all();
          $totalinactvenpros=sizeof($exevendors);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>InActive Product</h3>
                      <p><?= $totalveninactpros ?></p>
                    </div>                
                <a href="<?= Url::to(['/product/index','ProductSearch[Is_active]'=>0])?>" class="small-box-footer">View<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $vendors=  \backend\models\Vendor::find()->where(['Is_active'=>1])->all();
      $totalvendors=sizeof($vendors);
      if($role=='Executive')
      {
          $exevendors=  \backend\models\Vendor::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_active'=>1])->all();
          $totalvendors=sizeof($exevendors);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Vendor Report</h3>
                      <p><?= $totalvendors ?></p>
                    </div>                
                <a href="<?= Url::to(['/vendor/vendorcount'])?>" class="small-box-footer">Click Here<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>


<?/********************For Franchisee***********************/ ?>
<?php  if($role=='Franchisee Manager'){?>
<?php $franch_user_frid= backend\models\FranchiseeUser::findOne(['userid'=>Yii::$app->user->identity->id]);
      $franch_user_userid= backend\models\FranchiseeUser::find()->where(['frid'=>$franch_user_frid['frid']])->andWhere(['not in','userid',Yii::$app->user->identity->id])->all();
    foreach($franch_user_userid as $f){
     $vendors=  backend\models\Vendor::find()->where(['crtby'=>$f['userid']])->all();
    }  
    $totalvendors=sizeof($vendors);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Vendors</h3>
                      <p><?= $totalvendors ?></p>
                    </div>                
                <a href="<?= Url::to(['/vendor/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }   if($role=='Franchisee Executive'){?>

<?php $vendors=  backend\models\Vendor::find()->where(['crtby'=>Yii::$app->user->identity->id])->all();
      $totalvendors=sizeof($vendors);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Vendors</h3>
                      <p><?= $totalvendors ?></p>
                    </div>            
                <a href="<?= Url::to(['/vendor/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php } ?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Product Report</h3>
                      <p> <img style="height: 35px;width: 50px;" src="<?php echo (Yii::$app->request->baseUrl. '/../../images/rpt.png');?>" id="DataDisplay"/>       
             </p>
                    </div>                
                <a href="<?= Url::to(['/product/productrpt'])?>" class="small-box-footer">Click Here<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>




<?php /****New Model Of skills...and other...*****/ ?>

<?php $franchisees= backend\models\Franchisee::find()->all();
      $totalfranchisees=sizeof($franchisees);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Franchisee</h3>
                      <p><?= $totalfranchisees ?></p>
                    </div>                
                <a href="<?= Url::to(['/franchisee/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Franchisee Manager') {

 $frnchiseeid = \backend\models\FranchiseeUser::find()->where(['userid'=> \Yii::$app->user->identity->id])->one();
  $alluser = \backend\models\FranchiseeUser::find()->where(['frid'=> $frnchiseeid['frid']])->all();
  $alluserarr = array();
  foreach ($alluser as $allusr){
      array_push($alluserarr, $allusr['userid']); 
  }
  $alluserstring = implode(',', $alluserarr);
  
  $frnchnm = \backend\models\UserDetail::find()->where(['uid'=> $alluserarr])
                                                      ->andWhere(['role'=>'Franchisee Executive'])
                                                      ->all();
  $vndleads = \backend\models\VendorLeads::find()->where(['Is_convert'=>0,'crtby'=> $alluserarr])->all();
  
  $totalvendorleads=sizeof($vndleads);
?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Vendorleads</h3>
                      <p><?= $totalvendorleads ?></p>
                    </div>                
                <a href="<?= Url::to(['/vendorleads/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>
<?php
  if($role=='Superadmin' || $role=='Admin'){
  $vendorleads = \backend\models\VendorLeads::find()->where(['Is_convert'=>0])->all();
      $totalvendorleads=sizeof($vendorleads);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Vendorleads</h3>
                      <p><?= $totalvendorleads ?></p>
                    </div>                
                <a href="<?= Url::to(['/vendorleads/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>


<?php $deliverypartners=  \backend\models\DeliveryPartner::find()->all();
      $totaldeliverypartners=sizeof($deliverypartners);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Delivery Partners</h3>
                      <p><?= $totaldeliverypartners ?></p>
                    </div>                
                <a href="<?= Url::to(['/delivery-partner/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php } ?>
<?php if($role=='Franchisee Executive'){
   $vendorleads = \backend\models\VendorLeads::find()->where(['Is_convert'=>0,'crtby'=> \yii::$app->user->identity->id])->all();
  $totalvendorleads=sizeof($vendorleads);?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Vendorleads</h3>
                      <p><?= $totalvendorleads ?></p>
                    </div>                
                <a href="<?= Url::to(['/vendorleads/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php } ?>


<!----------------------------------------------------------------------------------------------------------------------------------->
<?php if($role=='Vendor'){
   $count = 0;
   $vid = backend\models\Vendor::findOne(['user_id'=>Yii::$app->user->identity->id]);
        $vpids = backend\models\VendorProducts::find()->where(['vid'=>$vid['vid']])->all();
        $vpid = array();
      foreach ($vpids as $vp){
          //echo 'vpids...'.$vp['vpid'];
               //array_push($vpid, $vp['vpid']);
          $item = \backend\models\Orderitem::find()->where(['vpid'=>$vp['vpid']])->all();
           foreach ($item as $i){
          if($i['vpid'] !=NULL){
           $count = $count + 1;
          }
          }
       }  
  ?>
<?php } ?>


<!--//My order for admin ------------------------------------->

<?php if($role=='Admin'){
   //$count = 0;
   //$vid = backend\models\Vendor::findOne(['user_id'=>Yii::$app->user->identity->id]);
        //$vpids = backend\models\VendorProducts::find()->where(['vid'=>$vid['vid']])->all();
        //$vpid = array();
//      $orids = backend\models\Orders::find()->all();
//      foreach ($orids as $or){
          //echo 'vpids...'.$vp['vpid'];
               //array_push($vpid, $vp['vpid']);
          $item = \backend\models\Orderitem::find()->all();
          $count = sizeof($item);
        //}  
       
  ?>
<div class="col-lg-3 col-xs-6">             
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>My Orders</h3>
                      <p><?php echo $count; ?></p>
                    </div>                
                <a href="<?= Url::to(['/orderitem/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php
$brands = \backend\models\BrandName::find()->all();
$totalbrands=sizeof($brands);
?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Brands</h3>
                      <p><?php echo $totalbrands; ?></p>
                    </div>                
                <a href="<?= Url::to(['/brand-name/index'])?>" class="small-box-footer">Add More <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>

<?php
$ordersitem = \backend\models\Orderitem::find()->all();
$totalorders=sizeof($ordersitem);
?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Payment Report</h3>
                      <p><?php echo $totalorders; ?></p>
                    </div>                
                <a href="<?= Url::to(['/orderitem/paymentrpt'])?>" class="small-box-footer">Click Here<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php } ?>

<!----------------------------------------------------------------------------------------------------------------------------------->


<?php //if($role=='Superadmin' || $role=='Admin') {?>
<!--div style="margin-left: 13px; color: #8c8b8b; visibility: hidden;margin-bottom: -20px;">--</div>
<div class="style2" style="margin-left: 16px;"></div>

<div style="font-size: 25px; font-weight: bold; margin-left: 40px;">
    Delivery Partners</div><br-->

<?php //}?>






<?php if($role=='Superadmin' || $role=='Admin') {?>

<!--div ><hr class="style2" style="margin-top: 300px;"></div-->
<div style="margin-left: 13px; color: #8c8b8b; visibility: hidden;margin-bottom: -20px;">--</div>
<div class="style2" style="margin-left: 16px;"></div>

<div style="font-size: 25px; font-weight: bold; margin-left: 40px;">
Skills</div>

<!--div class="hr style-four" style="margin-right: 25px;">-----------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------</div-->

    
<?php /****New Model Of skills...and other...*****/ ?>


<?php $skills= \frontend\models\Skills::find()->where(['Is_approved'=>1])->all();
      $totalskills=sizeof($skills);
      if($role=='Executive')
      {
          $exeskills=  \backend\models\Skills::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>1])->all();
          $totalskills=sizeof($exeskills);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Skills</h3>
                      <p><?= $totalskills ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills/index'])?>" class="small-box-footer">Add More<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $veninactskils= \frontend\models\Skills::find()->where(['Is_approved'=>0])->all();
      $totalveninactskills=sizeof($veninactskils);
      if($role=='Executive')
      {
          $exeskills= \frontend\models\Skills::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>0])->all();
          $totalinactskils=sizeof($exeskills);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>InActive Skills</h3>
                      <p><?= $totalveninactskills ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills/index','SkillsSearch[Is_approved]'=>0])?>" class="small-box-footer">View<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>



<?php /****New Model Of Cast...*****/ ?>
<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $casts= \frontend\models\SkillsCast::find()->where(['Is_approved'=>1])->all();
      $totalcasts=sizeof($casts);
      if($role=='Executive')
      {
          $execast= \frontend\models\SkillsCast::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>1])->all();
          $totalcast=sizeof($execast);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Cast</h3>
                      <p><?= $totalcasts ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-cast/index'])?>" class="small-box-footer">Add More<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $inactcast= \frontend\models\SkillsCast::find()->where(['Is_approved'=>0])->all();
      $totalcasts=sizeof($inactcast);
      if($role=='Executive')
      {
          $exescast= \frontend\models\SkillsCast::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>0])->all();
          $totalinactskils=sizeof($exescast);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>InActive Cast</h3>
                      <p><?= $totalcasts ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-cast/index','SkillsCastSearch[Is_approved]'=>0])?>" class="small-box-footer">View<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php /****New Model Of Faith...*****/ ?>
<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $faiths= \frontend\models\SkillsFaith::find()->where(['Is_approved'=>1])->all();
      $totalfaiths=sizeof($faiths);
      if($role=='Executive')
      {
          $exefaiths= \frontend\models\SkillsFaith::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>1])->all();
          $totalfaith=sizeof($exefaiths);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Faith</h3>
                      <p><?= $totalfaiths ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-faith/index'])?>" class="small-box-footer">Add More<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $inactfaith= \frontend\models\SkillsFaith::find()->where(['Is_approved'=>0])->all();
      $totalfaiths=sizeof($inactfaith);
      if($role=='Executive')
      {
          $exefaith= \frontend\models\SkillsFaith::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>0])->all();
          $totalinactfaith=sizeof($exescast);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>InActive Faith</h3>
                      <p><?= $totalfaiths ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-faith/index','SkillsFaithSearch[Is_approved]'=>0])?>" class="small-box-footer">View<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php /****New Model Of Hobbies...*****/ ?>
<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $hobbies= \frontend\models\SkillsHobbies::find()->where(['Is_approved'=>1])->all();
      $totalhobbies=sizeof($hobbies);
      if($role=='Executive')
      {
          $exehobbies= \frontend\models\SkillsHobbies::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>1])->all();
          $totalhobbies=sizeof($totalhobbies);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Hobbies</h3>
                      <p><?= $totalhobbies ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-hobbies/index'])?>" class="small-box-footer">Add More<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $inacthobbies= \frontend\models\SkillsHobbies::find()->where(['Is_approved'=>0])->all();
      $totalhobbies=sizeof($inacthobbies);
      if($role=='Executive')
      {
          $exehobbie= \frontend\models\SkillsHobbies::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>0])->all();
          $totalinacthobbies=sizeof($exehobbie);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>InActive Hobbies</h3>
                      <p><?= $totalhobbies ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-hobbies/index','SkillsHobbiesSearch[Is_approved]'=>0])?>" class="small-box-footer">View<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php /****New Model Of Religion...*****/ ?>
<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $religion= \frontend\models\SkillsReligion::find()->where(['Is_approved'=>1])->all();
      $totalreligion=sizeof($religion);
      if($role=='Executive')
      {
          $exerlgn= \frontend\models\SkillsReligion::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>1])->all();
          $totalrlgns=sizeof($totalreligion);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Religion</h3>
                      <p><?= $totalreligion ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-religion/index'])?>" class="small-box-footer">Add More<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>

<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $inactreligns= \frontend\models\SkillsReligion::find()->where(['Is_approved'=>0])->all();
      $totalrlgn=sizeof($inactreligns);
      if($role=='Executive')
      {
          $exergln= \frontend\models\SkillsReligion::find()->where(['crtby'=>Yii::$app->user->getId(),'Is_approved'=>0])->all();
          $totalrgns=sizeof($exergln);
      }
      ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-green">
                    <div class="inner">
                      <h3>InActive Religion</h3>
                      <p><?= $totalrlgn ?></p>
                    </div>                
                <a href="<?= Url::to(['/skills-religion/index','SkillsReligionSearch[Is_approved]'=>0])?>" class="small-box-footer">View<i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
              </div>
</div>
<?php }?>
<?php if($role=='Superadmin' || $role=='Admin') {?>
<?php $leads=  \backend\models\Diginleads::find()->all();
      $totalleads=sizeof($leads); ?>
<div class="col-lg-3 col-xs-6">              
              <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Digin Leads</h3>
                      <p><?= $totalleads ?></p>
                    </div>                
                  <a href="<?= Url::to(['/diginleads/index'])?>" class="small-box-footer">View <i class="glyphicon glyphicon-arrow-right" style='color:#fff'></i></a>
                
              </div>
</div>
<?php }?>

