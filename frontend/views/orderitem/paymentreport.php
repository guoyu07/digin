<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\widgets\Pjax;




//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderitemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payment Details');
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!--link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/daterangepicker.css" />

<!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

<?php $form = ActiveForm::begin(['action' => ['orderitem/saveitempay'], 'id' => 'payrpt', 'method' => 'post']); ?>
<!--form method="POST" id="payrpt" action="index.php?r=orderitem/saveitempay"-->
         <!--input type="hidden" name="r" value="orderitem/saveitempay"-->
          
<input type="hidden" class="dt" name="franchisee" value="">
<h1><?php echo 'Order Payment Details'; ?></h1>
<div class="row">
    <div class="col-md-6">
         
    </div>
    <?php 
    $auth=Yii::$app->authManager;
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
    if($userRole=='Admin' || $userRole=='Superadmin') {
    ?>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->field($model, 'payacn')->dropDownList(['1' => 'Action', '2' => 'Pay'], ['style' => 'background:gray;color:#fff;width:200px;float:right;']); ?>
            </div> 
            <div class="col-md-2">
                <?php //echo'<a href="#"><div class="btn btn-primary" id="gopay">Go</div></a>'; ?>
                <?php echo '<div><input type="button" value="Go" class="btn btn-primary" id="gosave"></div>'; ?>
            </div>  
            <div class="col-md-4">
                 <?php  //echo "<b><a href='#' id='export'>Download</a></b>"; ?>
                <?php $qrystr= Yii::$app->request->getQueryString();
                         //var_dump($qrystr);
                      $nwquery ='';
                      $qrystrarr = explode("&",$qrystr);
                      //var_dump($qrystrarr);
                      //if(sizeof($qrystrarr)>1){
                      $qrystrarr = array_splice($qrystrarr,0,4);
                      //var_dump($qrystrarr);
                      
                      $nwquery = "&".implode("&",$qrystrarr);
                     
                      //}
                     //var_dump($nwquery);
                ?>
                
                <p><a href="index.php?r=orderitem/export<?php echo $nwquery; ?>" id="export" value="<?php //echo Yii::$app->request->getQueryParams(); ?>"><img style="height:40px;width: 40px;" src="<?php echo (Yii::$app->request->baseUrl. '/../../images/Excel_Icon.png');?>"/></a></p>
                
             </div>
        </div> 
    </div>
           <?php } ?>
    </div>
<!--/form-->

<!--?php $form = ActiveForm::begin(['action' => [''], 'id' => 'payrpt', 'method' => 'post']); ?-->
<?php ActiveForm::end(); ?>

    <div class="orderitem">

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
//      
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                
                [
                    'label' => 'Order No.',
                    'attribute' => 'orid',
                    'value' => function ($data) {
                $model = new \backend\models\Orderitem();
                $orderid = $model->getOrderNo($data['orid']);
                return $orderid;
//                    
                 },
                ],
                [
                    'label' => 'Vendor Name',
                    'attribute' => 'vendor',
                    'format'=>'raw',
                    'value' => 'vendor.businessname',
                 
                ],
                  
                [
                    'label' => 'Delivery Details',
                    'attribute' => 'orid',
                    'format'=>'raw',
                    'value' => function ($data) {
                $model = new \backend\models\Orderitem();
                $diliverydetail = $model->getDeliveryDetails($data['orid']);
                 return $diliverydetail;
//                    
                 },
                 
                ],
                
                 [
                    'label' => 'Order Date',
                    'attribute' => 'crtdt',
                      'format' => ['date', 'php:d/m/Y'],
                 ],
               
                [
                    'label' => 'ShipCost',
                    'attribute' => 'shipment',
                    
                ],
                [
                    'label' => 'Payment',
                    //'attribute'=>'rate',
                    //'format'=>'raw',
                    'class' => 'yii\grid\DataColumn',
                    //'value'=>$data['rate'],
                    'value' => function ($data) {
                //$data = new backend\models\Orderitem();
                return $data['producttotal'];
            },
                ],
                [
                    'label' => 'Comission',
                    //'attribute' => 'digin_commision',
                    'value' => function ($data) {
                $model = new backend\models\Orderitem();
                $vennm = $model->getDiginComissn($data['vpid'],$data['oritemid']);
                return $vennm;
            },
                ],
                [
                    'label' => 'PayToVendor',
                    'attribute' => 'payvendor',
                    'value' => function ($data) {
                $model = new backend\models\Orderitem();
                $payven = $model->getPaytovendor($data['vpid']);
                return $payven;
            },
                ],
                [
                    'label' => 'Pay Date',
                    'attribute' => 'vendor_pay_date',
                     'format' => ['date', 'php:d/m/Y'],
                 ],
                    
           [
              'label'=>'DeliveryPin',
              'attribute'=>'delivery_pin',
              'format'=>'raw',
               'visible' => Yii::$app->user->can('Superadmin'),
               'value' => function($model, $key, $index, $column) {
                      
                     if($model->delivery_status!='Delivered'){
                         return $this->render('Deliveryform',[
                          'model' => $model,
                          
                      ]); 
                      }else{
                          return '--';
                      }
                 },
                
            ],
                  
             [ 
               'attribute'=>'delivery_status',
               'format'=>'raw',
               //'contentOptions' => ['style' => 'max-width:300px;disabled:true;'], 
               'visible' => Yii::$app->user->can('Superadmin'), 
                  'value' => function($model, $key, $index, $column) {
                      
                         return $this->render('Deliverystats',[
                          'model' => $model,
                           'index' => $index,
                      ]); 
                  },
               ],

              [
                    'label' => 'Payment Status',
                    'attribute' => 'status',
                      'format' => 'raw',
                    'contentOptions' => ['style' => 'width:200px;disabled:true;'], 
                    'filter'=>array("1"=>"Paid","2"=>"Pending"),
                    'value' => function ($data) {
                     $model = new backend\models\Orderitem();
                     $paysts = $model->getPaystatus($data['oritemid']);
                     return $paysts;
                  },
             ],
                    
            //'vpid',
            //'quantity',
            // 'producttotal',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',
            // 'delivery_status',
           
               [
                   
                    'class' => 'yii\grid\CheckboxColumn',
                    'visible' => Yii::$app->user->can('Superadmin'),
                      // you may configure additional properties here
               ], 

//            ['class' => 'yii\grid\ActionColumn',
//               'template' => '' 
//             ],
            ],
        ]);
        ?>
       
    </div>
<?php //ActiveForm::end(); ?>

 <?php //$this->registerJsFile('testing/backend/web/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

  <?php //$this->registerJsFile('testing/backend/web/js/moment.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

  <?php //$this->registerJsFile('testing/backend/web/js/daterangepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

 <?php $this->registerJsFile('./js/orderitempay.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>


<!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main.js"></script>  Gem jQuery -->
