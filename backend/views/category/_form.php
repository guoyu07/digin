<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use backend\models\Category;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\Models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/categoryfacility.js"></script>


<div class="category-form">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',
                                                   'id' => 'create-category-form']]);?> 
            
           
    <div class="row">
        <div class="col-xs-3">
            <!--?php  echo $form->field($model, 'parentid')->dropDownList($listData,['prompt'=>'Select Category']); ?-->
            <!--?= Html::Button('Search',['class' => 'btn btn-primary searchpath showModalButton']) ?-->            
            <!--?= Html::button('Search', ['value' => Url::to(['category/search-path']), 'title' => 'Searching Path', 'class' => 'showModalButton btn btn-primary searchpath']); ?-->
   <?=  Html::label('Parent Category')?>
   
   <?php  $data = Category::find()
                    ->select(['path as value', 'path as  label','id as id'])
                    ->asArray()
                    ->all();
         
                echo AutoComplete::widget([
                'name' => 'Category',
                'id' => 'cat',   
                'value' => $model->path,    
                'clientOptions' => [
                    'source' => $data,        
                    'autoFill'=>true,
                    'minLength'=>'3',
                    'select' => new JsExpression("function( event, ui ) {
                        $('#category-category').val(ui.item.id); 
                     }")],
                 'options' => [
                            'class' => 'form-control'
                         ]
                 ]);  //#category-category is the id of hiddenInput.
            
        
     ?>

    <?php   echo Html::activeHiddenInput($model, 'category');             
            ?>
            
        </div>
     </div>
          
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'description')->textarea(['maxlength' => false]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-6">                              
            <?php echo $form->field($model, 'image')->fileInput(); ?>
             
        </div>
    </div>
    

    <?php if(isset($_POST)){ ?>
    <div class="row">
        <div class="col-xs-6"> 
            <?php 
             
               $displayimg='';   
                  $imgPath = \yii\helpers\Url::to('/advanced/images/categoryimages/' . $model->id . '/');            
                  $bgcolor='#F1D8D8';  
                     $displayimg=Html::img($imgPath.$model->image,['id'=>'imgedit','width'=>'auto', 'height'=>200]);                   
                      echo "<div class=file-preview-frame  name=prodimage style=background-color:$bgcolor;><span class='glyphicon glyphicon'></span>".$displayimg."<span class=file-footer-caption>$model->image</span></div>";
                   
                  //echo '<span><img src='.$imgPath.''.$model->image.'  style="width:auto;height:50;"></span>';
                  ?>
        </div>
    </div>
    <?php } ?>
    
    
    <div class="row">
        <div class="col-xs-3">                              
            <?= $form->field($model, 'status')->radioList(array('1'=>'Active',2=>'Inactive')); ?>
        </div>
    </div>
    
    <?php //$facility= \backend\models\Facility::findBySql("select id, name from facility")->all();         
          //$failityData=ArrayHelper::map($facility,'id','name');          
        ?>
       
    <?php 
           
          $catfacids=array(); 
          if(isset($catfacilityData)&& $catfacilityData!=NULL)
          {
            $catfacids=array_keys($catfacilityData);  
          }  
          
          $facility= \backend\models\Facility::find()->select('id, name')->where(['not in','id',$catfacids])->all();         
         // $facility= \backend\models\Facility::findBySql("select id, name from facility")->where("t.id not in ($venfacids)")->all();         
          $facilityData=ArrayHelper::map($facility,'id','name');  
          
          ?>
    <div class="row">
        <div class="col-xs-2"> 
        <?php $facility=new \backend\models\Facility();
         echo Html::label('Facility');
         echo  $form->field($facility, 'id')-> listBox(
                $facilityData,               
                array('id'=>'listA','size'=>4,'multiple' => 'true')
                )->label(false); ?>
        </div>
    </div>
    
    <div class="col-xs-2">        
	<?php echo Html::Button('>',['id'=>'btnAdd','class'=>'btn btndefault']); ?>
  	<?php echo Html::Button('<',['id'=>'btnRemove','class'=>'btn btndefault']); ?>
    </div>
       
    <div class="row">
        <div class="col-xs-2"> 
        <?php //$data=array();        
        if(!isset($catfacilityData))
        {
            $catfacilityData=array();
        }
        echo $form->field($mdlCategoryFacility, 'facidarray')-> listBox($catfacilityData,
                array('id'=>'listB','size'=>4,'multiple' => 'true')
                )->label(''); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success submit' : 'btn btn-primary submit']) ?>
    <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>

  </div>

    <?php ActiveForm::end(); ?>

</div>
