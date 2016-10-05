<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use kartik\file\FileInput;
use yii\helpers\Url;
use backend\models\Category;
use moonland\tinymce\TinyMCE;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>


<link rel="stylesheet" type="text/css" href="./css/form.css" />
<script type="text/javascript" src="./js/jquery.popup.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.popup.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="./js/product.js"></script>

<div class="row">
       <div class="col-md-6 col-xs-12"> 
<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id'=>'productform']]); ?>
    <div class="row">
       <div class="col-md-12 col-sm-4 col-xs-12"> 
            <?php echo $form->field($model, 'prodname')->textInput(['maxlength' => true]);
                 echo "<div class=proderror style='color: #a94442;' ></div>";?>
        </div>
    </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">  
            <?= $form->field($model, 'isservice')->checkbox() ?>
        </div>
    </div> 
     <div class="row">
        <div class="col-md-12 col-sm-4 col-xs-12"> 
            <?php echo $form->field($model, "category")->textInput(); ?>
        </div>
     </div>
        
      <?php $role='';
	$userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
	foreach($userrole as $r)
        {
	  $role=$r->name;
				
	}
	if($role=="Vendor"){ ?>	 
     <div class="row">
        <div class="col-md-6 col-xs-12"> 
            <?php echo Html::button('Search',array('id'=>'searchcat1', 'class'=>'btn btn-primary')); ?>
        </div>
     </div>
	<?php } else{?>

	<div class="row">
        <div class="col-md-6 col-xs-12"> 
            <?php echo Html::button('Search',array('id'=>'searchcat', 'class'=>'btn btn-primary')); ?>
        </div>
     </div>
	<?php } ?>
    <?php
          $prodcats=array(); 
          if(isset($prodcatdata)&& $prodcatdata!=NULL)
          {
            $prodcats=array_keys($prodcatdata);  
          }                      
            $category= \backend\models\Category::find()->select('id, path')->where(['not in','id',$prodcats])->all();         
            $categoryData=  \yii\helpers\ArrayHelper::map($category,'id','path');  
          
      ?>
     
    <div class="row">
         <div class="col-md-12 col-sm-4 col-xs-12" >
		<label></label>		 
        <?php $cat=new \backend\models\Category();
         echo  $form->field($cat, 'id')-> listBox(
                $categoryData,               
                array('id'=>'list1','size'=>10,'multiple' => 'true')
                )->label(false); ?>
        </div>
    </div>
      <div class="row"> 
	       <div class="col-md-6 col-xs-6">			 
	         <?php echo Html::Button('',['id'=>'btnAdd1','class'=>'btn btndefault addbtn']); ?>
          </div>
          <div class="col-md-6 col-xs-6">
  	      <?php echo Html::Button('',['id'=>'btnRemove1','class'=>'btn btndefault addbtn']); ?>
          </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-sm-4 col-xs-12" > 
            <?php if(!isset($prodcatdata)){
                    $prodcatdata=array();             
            }?>
            <?= $form->field($mdlProductCategory,'prodcat')->listBox($prodcatdata,
                array('id'=>'catlist','size'=>10,'multiple' => 'true')
                )->label('')?>
        </div>
     </div>
    
  <!-------------Vendor Product fields--------------------------------->
   <?php if($role=='Vendor'){ ?>
  <div class="row">
       <div class="col-md-3 col-xs-6"> 
         <?php
           echo $form->field($mdlvendorproduct,'height')->textInput();
          ?>
         </div>
          
         <div class="col-md-1 col-xs-6"> 
         <?php
          echo '<label style="margin-top: 35px;margin-left: -20px;">Cm</label>';
          ?>
       </div>
          
       <div class="col-md-3 col-xs-6"> 
              <?php
            echo $form->field($mdlvendorproduct,'width')->textInput();
            ?>
       </div>
        
        <div class="col-md-1 col-xs-6"> 
         <?php
          echo '<label style="margin-top: 35px;margin-left: -20px;">Cm</label>';
          ?>
       </div>
        
          <div class="col-md-3 col-xs-6"> 
            <?php
             echo $form->field($mdlvendorproduct,'lenght')->textInput();
             ?>
         </div>
        
         <div class="col-md-1 col-xs-6"> 
         <?php
          echo '<label style="margin-top: 35px;margin-left: -20px;">Cm</label>';
          ?>
       </div>
        
        </div>
  
   <div class="mt20"></div>
   
  <div class="row">
          <div class="col-md-3 col-xs-6"> 
            <?php echo $form->field($mdlvendorproduct, 'weight')->textInput(); ?>
            <?php //echo $form->field($model, 'weight[]')->dropDownList(['a' => 'Kilograms', 'b' => 'Grams']); ?>
         </div>
         
         <?php 
            $wgtunits= \backend\models\Wgtunits::find()->all();
          $listdata=  ArrayHelper::map($wgtunits, 'wgt_id', 'wgt_name')?>

        <div class="col-md-3 col-xs-6"> 
           
       <?= $form->field($mdlvendorproduct, 'weightunit')->dropDownList($listdata,['prompt'=>'Select']) ?>
         </div>
      
       <div class="col-md-3 col-xs-6"> 
            <?= $form->field($mdlvendorproduct, "price")->textInput() ?>
        </div> 
      
      <?php $units=  \backend\models\Units::find()->all();
              $unitsdata= \yii\helpers\ArrayHelper::map($units, 'unitid', 'unitname')?>
        <div class="col-md-3 col-xs-6"> 
            <?= $form->field($mdlvendorproduct, "unit")->dropDownList($unitsdata,['prompt'=>'Select']) ?>
        </div>      
         </div>
   <div class="mt20"></div>
     <div class="row">
      <div class="col-md-3 col-xs-6">                            
            <?= $form->field($mdlvendorproduct, 'can_book')->radioList(array('0'=>'Buy',1=>'Book')); ?>
        </div>
  </div>
   <?php } ?>
    <div class="row">
   <div class="col-md-12 col-xs-6">   
     <?php echo $form->field($model, "keywords")->textInput(); ?>
   </div>
   </div>
   
   <div class="row">
       <div class="col-md-12 col-xs-12">
           <fieldset class="scheduler-border">
        <legend class="scheduler-border">Brand Details</legend>
        <div class="row">
            <div class="col-md-6 col-sm-4 col-xs-12" >
                <input type="checkbox" name="chkbrnd" class="" id="brndcheck">&nbsp;&nbsp;<b>No Brand</b>
            </div>
        </div>
        
        <div class="mt20"></div>
        
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12" >
                <label id="seachlbl">
                Search Brand
                </label>
            </div>
            <div class="col-md-6 col-sm-4 col-xs-12">
             <?php //echo $form->field($model, "brdnm")->textInput()->label(''); ?>
                <?= $form->field($model, 'brdnm')->textInput(['maxlength' => 255, 'class' => 'form-control','id'=>'searchbrnd'])->label(false); ?>
<!--                <input type="text" name="searchtextbrnd" class="form-control" id="searchbrnd">-->
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12" >
                 <label>
             <?php echo Html::button('Search',array('id'=>'searchbrand', 'class'=>'btn btn-primary')); ?>
            </label>
            </div>
        </div>
        
         <div class="mt20"></div>
         
         <div class="col-md-7 col-sm-4 col-xs-12" >
			
         <?php $brandname= \backend\models\BrandName::find()->all();             
              $brandData=  ArrayHelper::map($brandname, 'id', 'brand_name');             
              ?>	 
        <?php $brndnm=new \backend\models\BrandName();
         //echo Html::label('Category');
         echo  $form->field($brndnm, 'id')-> listBox(
                $brandData,               
                array('id'=>'listbrand','size'=>10)
                )->label(false); ?>
        </div>
    
           </fieldset>
       </div>  
   </div>
   
   
   <div class="row" style="margin-top: 10px;">
         <div class="col-md-12 col-sm-8 col-xs-12"> 
            <?php                       
                echo TinyMCE::widget(['name' => 'text-content']);
                $form->field($model, 'description')->widget(TinyMCE::className());?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12 col-sm-4 col-xs-12"> 
             <?php echo Html::activeHiddenInput($mdlproductimage, 'primaryimage'); 
             ?>
        </div>
     </div>
     <div class="mt10"></div>
    <div class="row">
       <div class="col-md-12 col-sm-4 col-xs-12"> 
        <?php               
        echo FileInput::widget([            
            'name' => 'ProductImages[image][]',
            'options'=>[
                'multiple'=>true
            ],
            'pluginOptions' => [   
                'uploadUrl' => Url::to(['/site/file-upload']),                               
                'showUpload'=>false,
                'maxFileCount' => 10
            ]
        ]);
        echo "<div class='alert alert-warning note'>Please do not upload file containing special character or space in its name.</div>";
        ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12"> 
            <?php $displayimg='';   
                  $count=0;                 
                  $imgPath = \yii\helpers\Url::to('https://www.digin.in/images/productimages/' . $model->prid . '/');            
                  $prodid='';
                  foreach ($mdlproductimage->images as $img)
                  {
                      $bgcolor=''; 
                      if($img->ismain==1){
                        $bgcolor='#F1D8D8';
                      }
                      $prodid=$img->prid;
                      $displayimg=Html::img($imgPath.$img->image,['id'=>$img->primgid,'class'=>'file-preview-image', 'name'=>'dbimage','width'=>'auto', 'height'=>200,'title'=>$img->image, 'alt'=>'Blank']);                   
                      echo "<div class=file-preview-frame id=img-$prodid-$count name=prodimage style=background-color:$bgcolor;><span class='glyphicon glyphicon-trash close'></span>".$displayimg."<span class=file-footer-caption>$img->image</span></div>";
                      $count++;
                  }
                ?>
        </div>
    </div>
 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success submit create' : 'btn btn-primary submit']) ?>
    <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
<div class="col-md-6 col-xs-12"> 
			<div class="row">
			<?php $role='';
				$userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
				foreach($userrole as $r)
				{
				  $role=$r->name;
				
				}
				if($role=="Vendor"){ ?>
     
				<div class="col-md-4 col-xs-12">
					<div class="mt25"></div>
			
          <a href="#cat-box" class="login-window btn btn-primary">Suggest Category</a>
				</div>
			<?php }?>
    <div id="cat-box" class="cat-popup">
      <div class="row">
        <div class="col-md-12 col-xs-12">
           <a href="#" class="close1">&#10006;</a>
        </div>
      </div>
          <form method="post" class="signin formbox" action="" id="suggcat1" name="catagory-form" >
               <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="poplabel">
                    <span class="btnlbl">Category Title</span>
                    <input class="form-control mt7" name="title" id="title" value="" type="text"  />
                    </div>
                  </div>  
                </div>
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="poplabel mt7">
                    <span class="btnlbl">Parent Category</span>
                    <input name="vencatagory" id="ventitlecat" type="hidden">
                    <input name="path" id="path" type="hidden">
                    <?php  $data = Category::find()
                        ->select(['path as value', 'path as  label','id as id'])
                        ->asArray()
                        ->all();
                   
                      echo AutoComplete::widget([
                      'name' => 'vencatagory',
                      'id' => 'cat',   
                      'value' => $model->path,    
                      'clientOptions' => [
                        'source' => $data,        
                        'autoFill'=>true,
                        'minLength'=>'3',
                         'onChange' => 'holderTypeChangeHandler',
                        'select' => new JsExpression("function( event, ui ) {
                          $('#ventitlecat').val(ui.item.id); 
                         }")],
                       'options' => [
                            'class' => 'form-control mt7'
                           ]
                       ]);  //#category-category is the id of hiddenInput.
                    ?>
                  
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                     <input type="submit" name="submit" value="submit" id="addvencat" class="btn btn-primary catbtn" >
                  </div>
                </div>
              </form>
    </div>

			</div>	
		</div>

<?php if(!$model->isNewRecord) {?>
<script type="text/javascript">
    $(document).ready(function(){
        //alert("load");     
        var descrpt='<?php echo trim(preg_replace('/\s+/', ' ', htmlentities(str_replace("'", "\\'", (isset($model->description) ? $model->description : '')))));?>';         
        $("#w0").html(descrpt);        
        //instead "#w0" this name can be used - 'textarea[name="text-content"]'
    });
</script>
<?php }?>