<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\Category;
use backend\models\Product;
use yii\web\JsExpression;

?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/vendorproduct.js"></script>

<div class="vendor-products-form">
       
    <?php $form = ActiveForm::begin(); ?>

    
<!--    <div id="form">-->
     
       <div class="row">
        <div class="col-xs-5"> 
            <?php echo $form->field($model, "catname")->textInput(); ?>
        </div>
        
        <div class="col-xs-5"> 
            <?php echo $form->field($model, "prodname")->textInput(); ?>
        </div>
      </div>
      
        
        <div class="row" style="margin-top: 10px;">
        <div class="col-xs-5"> 
            <?php echo Html::button('Search',array('id'=>'searchcatrpt', 'class'=>'btn btn-primary')); ?>
        </div>
        
        <div class="col-xs-6"> 
            <?php echo Html::button('Search',array('id'=>'searchprodrpt', 'class'=>'btn btn-primary')); 
                  echo "<div id=searchmsg>To clear searched results click Search again.</div>"?>           
        </div><br>       
        </div><br>
        
        <?php
          //$prodcats=array(); 
          /*if(isset($prodcatdata)&& $prodcatdata!=NULL)
          {
            $prodcats=array_keys($prodcatdata);  
          }  
           * $category= \backend\models\Category::find()->select('id, path')->where(['not in','id',$prodcats])->all();     */                   
            $category= backend\models\Category::find()->select('id, path')->all();         
            $categoryData=ArrayHelper::map($category,'id','path');          
      ?>   
        <div class="row">
        <div class="col-xs-5"> 
        <?php //$cat=new Category();         
         echo  $form->field($model, 'category')-> listBox(
                $categoryData,               
                array('id'=>'listone1','size'=>10)
                )->label(false);
          ?>
        </div>
    
        
        <?php $product= \backend\models\Product::find()->all();             
              $productData=  ArrayHelper::map($product, 'prid', 'prodname');             
              ?>
        <div class="col-xs-5"> 
        <?php //$prod=new Product();        
         echo  $form->field($model, 'product')-> listBox(
                $productData,               
                array('id'=>'listtwo','size'=>10)
                )->label(false); 
         ?>
        </div>
        </div>
<!--     </div>--> 
    
   <div class="row">
    <div class="col-xs-10 prodtable">
        <?php echo "<table border='1' class='table prodtab'>";
              echo  "<thead><th>Category</th><th>Product</th></thead>";
              echo "<tr><td id=cat>None</td><td id=prod>None</td></tr>";   
              echo "</table>";?>
    </div>
       <div style="margin-top: 40px;" class="form-group">
           <?php //echo Html::submitButton('Show Report',array(['/product/productrpt'], 'class'=>'btn btn-primary')); ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Show Report') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
               </div></div>
   
    <?php ActiveForm::end(); ?>   
   
</div>

 <div style="width: 1600px;">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Product-wise Report</legend>
    <?php 
    
     echo Html::beginTag('table class="table table-striped"');
          echo Html::beginTag('tr');
          
          echo Html::tag('th class="th1"', 'Sr.No'); // for Table head 
          echo Html::tag('th class="th1"', 'Vendor Name');
          echo Html::tag('th class="th1"', 'Address');
          echo Html::tag('th class="th1"', 'City');
          echo Html::tag('th class="th1"', 'Country');
          echo Html::tag('th class="th1"', 'ContactNo.');
          echo Html::endTag('tr');
          $i=0;
          if(isset($productreports) && $productreports !="") {
             
             foreach ($productreports as $p){
                 $i = $i + 1;
          
          echo Html::beginTag('tr');
          
       
           echo Html::tag('td', $i);  
          
           //echo Html::tag('td','<a href="index.php?r=product/index&ProductSearch[city]='.$p['city'].'&VendorSearch[crtdt]=">'.$p['city'].'</a>'); 
          
           echo Html::tag('td',$p['firstname'].' '.$p['lastname']); 
           echo Html::tag('td',$p['address1'].' '.$p['address1']); 
           echo Html::tag('td',$p['city']); 
           echo Html::tag('td','India'); 
           echo Html::tag('td',$p['phone1'].','.$p['phone2']); 
           echo Html::endTag('tr');
          }
   //echo "Set.."; var_dump($vencount);
    //echo var_dump($v['fromdate'].'_'.$v['todate']);
}

       echo Html::endTag('table'); 
       /* echo \yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
        ]);  */
?>     
         </fieldset>
  </div>
   
</div>

<style type="text/css">
    
    .th1 {
            /*...all th attributes like padding etc*/
            background-color:#d4e3e5;
            padding: 8px;
    }
   
    </style>