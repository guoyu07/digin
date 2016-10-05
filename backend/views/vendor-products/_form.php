<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\Category;
use backend\models\Product;
/* @var $this yii\web\View */
/* @var $model backend\models\VendorProducts */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/form.css" />
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/vendorproduct.js"></script>

<?php $auth=Yii::$app->authManager;
          $users=array();
          if(!Yii::$app->user->isGuest){
          $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);          
          if ($userRole) {
            foreach ($userRole as $role) {
               $roles[] = $role->name;
            }
            // if user have 1 role then $userRole will be a string containing it
            // othewhise let $userRole be an array containing them all
            $userRole = count($roles) === 1 ? $roles[0] : $roles ;
         }
          }
?>

<style>
.loadingDiv
{
    top:45%;
     left:50% ;
     position:absolute;
     z-index: 100;
        
}
.load {
  width: 40px;
  height: 40px;  
  background:url("/advanced/images/ajax-loader.gif") no-repeat center center;
}


</style>
 <div class="loadingDiv" id="loading">       
 
      <img class="load"></div>
  
<script type="text/javascript">
 $(document).ready(function(){
      $('#loading').hide();
      $(document)
        .ajaxStart(function () {         
           $('#loading').show();
        })
        .ajaxStop(function () {           
           $('#loading').hide();
        });   
  });
</script>      

<div class="vendor-products-form">
<?php Pjax::begin() ?>
        
    <?php $form = ActiveForm::begin(['id'=>'vendorprodform']); ?>

    <!--?= $form->field($model, 'vid')->textInput() ?-->
    <div id="form">
     
        <!--div class="col-xs-3">             
            < ?=  Html::label('Parent Category')?>
   
        < ?php  $data1 = backend\models\Category::find()
                         ->select(['path as value', 'path as  label','id as id'])
                         ->asArray()
                         ->all();
              $category='';
                if(isset($model->categorypath)){
                    $category=$model->categorypath;
                }
                     echo AutoComplete::widget([
                     'name' => 'Category',
                     'id' => 'cat',   
                     'value' =>$category,    
                     'clientOptions' => [
                         'source' => $data1,        
                         'autoFill'=>true,
                         'minLength'=>'3',
                         'select' => new JsExpression("function( event, ui ) {                                                         
                             $('#vendorproducts-category').val(ui.item.id); 
                          }")
                         ],
                      'options' => [
                                 'class' => 'form-control catautcomp'
                              ]
                      ]);  //#vendorproducts-category is the id of hiddenInput.
                  ?>

         < ?php   echo Html::activeHiddenInput($model, "category");  ?>
        </div-->
    
    
        <!--div class="col-xs-3"> 
             < ?=  Html::label('Product')?>
   
        < ?php            
        /*$data2 = backend\models\Product::find()
                         ->select(['prodname as value', 'prodname as  label','c.prid as id'])
                         ->from('product p')  
                         ->asArray()
                         ->join('join', 'product_categories c', 'c.prid=p.prid')
                         ->where('c.catid=37')
                         ->all();*/
                // var_dump($data2);                 
              $product='';
                if(isset($model->prodname)){
                    $product=$model->prodname;
                }
                     echo AutoComplete::widget([
                     'name' => 'Product',
                     'id' => 'prod',   
                     'value' => $product,    
                     'clientOptions' => [
                         //'source' => $data2,        
                         'autoFill'=>true,
                         'minLength'=>'1',
                         'select' => new JsExpression("function( event, ui ) {
                             $('#vendorproducts-product').val(ui.item.id); 
                          }")],
                      'options' => [
                                 'class' => 'form-control'
                              ]
                      ]);  //#vendorproducts-product is the id of hiddenInput.
                  ?>

         < ?php   echo Html::activeHiddenInput($model, "product");  ?>       
        </div-->
        <div class="row">
        <div class="col-xs-3"> 
            <?php echo $form->field($model, "catname")->textInput(); ?>
        </div>
        
        <div class="col-xs-3"> 
            <?php echo $form->field($model, "prodname")->textInput(); ?>
        </div>
        
        
        <?php $units=  \backend\models\Units::find()->all();
              $unitsdata= \yii\helpers\ArrayHelper::map($units, 'unitid', 'unitname')?>
        <div class="col-xs-3"> 
            <?= $form->field($model, "unit")->dropDownList($unitsdata,['prompt'=>'Select']) ?>
        </div>      
        
       
        <div class="col-xs-3"> 
            <?= $form->field($model, "price")->textInput() ?>
        </div>    
        </div>
      
        
        <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3"> 
            <?php echo Html::button('Search',array('id'=>'searchcat', 'class'=>'btn btn-primary')); ?>
        </div>
        
        <div class="col-xs-6"> 
            <?php echo Html::button('Search',array('id'=>'searchprod', 'class'=>'btn btn-primary')); 
                  echo "<div id=searchmsg>To clear searched results click Search again.</div>"?>           
        </div>            
        </div>
        
        <?php
          //$prodcats=array(); 
          /*if(isset($prodcatdata)&& $prodcatdata!=NULL)
          {
            $prodcats=array_keys($prodcatdata);  
          }  
           * $category= \backend\models\Category::find()->select('id, path')->where(['not in','id',$prodcats])->all();     */                   
            $category= Category::find()->select('id, path')->all();         
            $categoryData=ArrayHelper::map($category,'id','path');          
      ?>   
        <div class="row">
        <div class="col-xs-3"> 
        <?php //$cat=new Category();         
         echo  $form->field($model, 'category')-> listBox(
                $categoryData,               
                array('id'=>'listone','size'=>10)
                )->label(false);
          ?>
        </div>
    
        
        <?php $product=  Product::find()->all();             
              $productData=  ArrayHelper::map($product, 'prid', 'prodname');             
              ?>
        <div class="col-xs-3"> 
        <?php //$prod=new Product();        
         echo  $form->field($model, 'product')-> listBox(
                $productData,               
                array('id'=>'listtwo','size'=>10)
                )->label(false); 
         ?>
        </div>

            <?php 
           if(isset($_GET['id'])){
           $postid = $_GET['id'];
           }
           if($userRole=='Vendor' || $userRole=='Admin') {
           echo "&nbsp;&nbsp;<div style='margin-top: 80px;'><b><a href='#' id='exp'>Download My Existing Products</a>&nbsp;&nbsp;&nbsp;&nbsp;</b>";
           echo "/&nbsp;&nbsp;&nbsp;<b><a href='?r=product/upload&id=".$postid."' id='exp'>Upload Updated Product Price</a>&nbsp;&nbsp;&nbsp;&nbsp;</b></div>";
           }?>

        </div>
     </div>
  <?php if($userRole!='Admin' && $userRole!='Superadmin'){ ?>
  <div class="row">
    <div class="col-md-3">
    <?= $form->field($model, 'country')->textInput(['readonly' => true]) ?>
    </div>
 </div>
  <?php } ?>
    <div class="row">
        <div class="col-xs-3">                              
            <?= $form->field($model, 'can_book')->radioList(array('0'=>'Buy',1=>'Book')); ?>
        </div>
    </div>
    
    <div class="row">
               <div class="col-xs-1"> 
         <?php
           echo $form->field($model,'height')->textInput();
          
          ?>
         </div>
          
           <div class="col-xs-1"> 
         <?php
          echo '<label style="margin-top: 35px;margin-left: -20px;">cm</label>';
          ?>
       </div>
          
        <div class="col-xs-1"> 
              <?php
            echo $form->field($model,'width')->textInput();
            ?>
          </div>
          <div class="col-xs-1"> 
         <?php
          echo '<label style="margin-top: 35px;margin-left: -20px;">cm</label>';
          ?>
       </div>
        <div class="col-xs-1"> 
            <?php
             echo $form->field($model,'lenght')->textInput();
             ?>
          </div>
          <div class="col-xs-1"> 
         <?php
          echo '<label style="margin-top: 35px;margin-left: -20px;">cm</label>';
          ?>
       </div>
        <div class="col-xs-1">
            <?php echo $form->field($model, 'weight')->textInput(); ?>
            <?php //echo $form->field($model, 'weight[]')->dropDownList(['a' => 'Kilograms', 'b' => 'Grams']); ?>
         </div>
         
         <?php 
            $wgtunits= \backend\models\Wgtunits::find()->all();
          $listdata=  ArrayHelper::map($wgtunits, 'wgt_id', 'wgt_name')?>

         <div class="col-xs-2">
           
       <?= $form->field($model, 'weightunit')->dropDownList($listdata,['prompt'=>'Select']) ?>
         </div>
        </div>
    
    <div class="row">
    <div class="col-xs-12 prodtable">
        <?php echo "<table border='1' class='table prodtab'>";
              echo  "<thead><th>Category</th><th>Product</th><th>Unit</th><th>Price</th></thead>";
              echo "<tr><td id=cat>None</td><td id=prod>None</td><td id=unit>None</td><td id=price>None</td></tr>";   
              echo "</table>";?>
    </div>
    </div>
    
<div class="row">
   <div class="col-xs-9 form-group" style="margin-top: 20px; margin-bottom: 20px;">         
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       <?= Html::a('Cancel',['index'],['class'=>'btn btn-primary']) ?>
   </div>
    </div>
    <?php ActiveForm::end(); ?>   
 <?php Pjax::end() ?>  
 
  
  <?php 
  if($userRole!='Admin' && $userRole!='Superadmin'){
  $form = ActiveForm::begin(['id'=>'vendorprodformcountry','method'=>'get']); ?>
 <div class="row">
   <div class="col-xs-4">   
  <?php $countries= \frontend\models\Countries::find()->all();
          $countrydata=  ArrayHelper::map($countries, 'id', 'name')?>
     <?= $form->field($model, 'countrylst')->dropDownList($countrydata,['prompt'=>'Select']) ?>
   </div>
     <?php ActiveForm::end();
  } ?>
 </div>
  

<div id="message" style="display: none;"></div>

<?php Pjax::begin(['id'=>'vendorprod']); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],           
            [
                       'label' => 'Product',
                       'attribute' => 'product',
                       'value' => function ($data) {  
                          return \backend\models\Product::findOne($data['prid'])->prodname;                          
                        },
            ],          
            [
                       'label' => 'Unit',
                       'attribute' => 'unit',
                       'value' => function ($data) {                          
                            return ($data['unit']==0 ? 'None' :\backend\models\Units::findOne($data['unit'])->unitname);                          
                },
            ],           
            //'price', 
             [
               'label'=>'Price',
              'attribute'=>'price', 
              'format'=>'raw',
              'visible'=> !isset($_GET['VendorProducts']['countrylst'])?true:false,
             ],
            [
              'label'=>'Price',
              'attribute'=>'price',
               'format'=>'raw',
               'visible'=> isset($_GET['VendorProducts']['countrylst'])?true:false,
             
               'value' => function($data, $key, $index, $column) {
                       
                     if(isset($_GET['VendorProducts']['countrylst'])){
                         return $this->render('ratechangeform',[
                          'model' => $data,
                      ]); 
                      }else{
                          return '--';
                      }
                 },
                
                 
            ],
                  
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                 'visible'=> !isset($_GET['VendorProducts']['countrylst'])?true:false,
                
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php 
      $country =backend\models\Vendor::findOne(['user_id'=>  Yii::$app->user->identity->id]);
      $countryid = frontend\models\Countries::findOne(['name'=>$country['country']]);
        
?>
<script type="text/javascript">
     $(document).ready(function(){
       var idi = '<?php echo $_GET['id']; ?>';
         $('#exp').click(function(){  
              alert('Please Do Not Change Vendor_Id and Vendor_Product_Id columns in downloaded Excelsheet.');
             location.href="index.php?r=exportproduct/export&id="+idi; 
        });
        
        
        /************Country set***************/
        var vencountry = '<?php echo $country['country'];  ?>'
        var countryid = '<?php echo $countryid['id']; ?>'
         $('#vendorproducts-country').val(vencountry);
         $('#vendorproducts-countrylst').val(countryid);
         
        /*****************Counrty change********************/
           $('#vendorproducts-countrylst').change(function(){    
               //alert('hi..change');
               //alert(postcountry);
               $("#vendorprodformcountry").submit();
               
           });
        });
</script>
