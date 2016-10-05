<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$role='';
    $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
    foreach($userrole as $r)
    {
      $role=$r->name;
    }

$this->title = Yii::t('app', 'Vendors');
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/css/daterangepicker.css" />

 
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl?>/js/vendorfacility.js"></script>
<div class="vendor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        $refer = Yii::$app->request->referrer;
        $r = explode('?', $refer);
     if(isset($r[1])) {
       $act = explode('=', $r[1]);
     if(($role=='Superadmin' || $role=='Admin') &&($act[1]=='vendor%2Fvendorcount')) {
       echo Html::a(Yii::t('app', 'Back'), ['/vendor/vendorcount'], ['class' => 'btn btn-success']) ;
       }
      }
	          $auth=Yii::$app->authManager;
              $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);
             if(array_keys($userRole)[0]!='Franchisee Manager') 
                echo  Html::a(Yii::t('app', 'Create Vendor'), ['create'], ['class' => 'btn btn-success']); ?>
    </p>
    
    <?php 
           $auth=Yii::$app->authManager;
          $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);
          if ($userRole === 'Franchisee Manager' or $userRole === 'Franchisee Executive' ){
             
              
          }     
    ?>

   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'vid',
            'firstname',
            'lastname',
            'city',
           // 'crtdt',
              [
                    'label'=>'Date',
                    'attribute'=>'crtdt',
                    //'format'=>'raw',
                    'format' => ['date', 'php:d/m/Y'],
					'visible' => Yii::$app->user->can('Superadmin') || Yii::$app->user->can('Admin'),
                 ],
            'email:email',
            'website',
            'businessname',
            // 'logo',
            // 'vendtor_type',
            // 'phone1',
            // 'phone2',
            // 'aboutme:ntext',
            // 'address1',
            // 'address2',
            // 'city',
            // 'state',
            // 'pin',
            // 'location',
            // 'plan',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby', 
             [
                    'label'=>'B/U',
                    'headerOptions' => ['title'=>'Block/Unblock'],
                    'attribute'=>'Is_blocked',
                    'format'=>'raw',
                       'visible'=> array_keys($userRole)[0]=='Admin' ?true:false,
                                       
                    //'contentOptions' =>function ($model, $key, $index, $column){
                      //  $category=new backend\models\Category();
                        //$status=$model->getCategoryStatus($model->id); 
                        //return [(($status==1)? Html::encode('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>') : Html::encode('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>'))];
                   // },                    
                       'value'=>function($model){
                        $blocks=$model->getVendorBlocked($model->vid); 
                        return $blocks==0? "<span class='glyphicon glyphicon-ok-sign blk block' aria-hidden='true'  style='color:#5cb85c' id='v_".$model->vid."_0' title='Block/Unblock'></span>" : "<span class='glyphicon glyphicon-exclamation-sign block' aria-hidden='true' style='color:#d9534f' id='v_".$model->vid."_1'></span>";
                        
                    },
                   
            ],
            [
                    'label'=>'A/I',
                    'headerOptions' => ['title'=>'Active/Inactive'],
                    'attribute'=>'Is_active',
                    'format'=>'raw',
                    'visible'=> array_keys($userRole)[0]=='Admin' ?true:false,
                    
               
                    //'contentOptions' =>function ($model, $key, $index, $column){
                      //  $category=new backend\models\Category();
                        //$status=$model->getCategoryStatus($model->id); 
                        //return [(($status==1)? Html::encode('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>') : Html::encode('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>'))];
                   // },                    
                       'value'=>function($model){
                        $activs=$model->getVendorActive($model->vid);
                        //return $activs;
                        return $activs==1? "<span class='glyphicon glyphicon-ok-circle activ'  aria-hidden='true'  style='color:#33CCFF' id='ven_".$model->vid."_1' title='Active/Inactive'></span>" : "<span class='glyphicon glyphicon-ban-circle activ' aria-hidden='true' style='color:#d9534f' id='ven_".$model->vid."_0'></span>";
                      },
                   
            ],
            [
                'label'=> 'Franchisee Executive',
                'attribute'=>'crtby',
                //$executive=  \backend\models\UserDetail::find()->select('firstname,lastname')->where(['role'=>'Franchisee Executive'])->all();                  
                'filter'=>  \yii\helpers\ArrayHelper::map(\backend\models\UserDetail::find()->select(['user_id', 'CONCAT(firstname," ",lastname) as name'])->asArray()->where(['role'=>'Franchisee Executive'])->all(), 'user_id', 'name'),
                'value' =>function($model){
                        
                       $executivename=  \backend\models\UserDetail::find()->select(['firstname','lastname'])->where(['user_id'=>$model->crtby])->one();                       
                        return $executivename['firstname']." ".$executivename['lastname'];
                },
                //'visible'=> Yii::$app->user->can('Franchisee Manager'),
                'visible'=> $role=='Franchisee Manager' ? true : false,
            ],              
             
           'status',               
            ['class' => 'yii\grid\ActionColumn',                
                          'template'=>'{view} {update} {addproduct}',   
                          'visible' => Yii::$app->user->can('Superadmin') || Yii::$app->user->can('Admin') || Yii::$app->user->can('Executive') || Yii::$app->user->can('Franchisee Executive'), 
                            'buttons'=>[
                              'addproduct' => function ($url, $model) { 
                                $auth=Yii::$app->authManager;
                                $userRole=$auth->getRolesByUser(Yii::$app->user->identity->id);
                                return array_keys($userRole)[0]!='Franchisee Executive' ? Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/vendor-products/create', 'id'=>$model->vid,],['title'=>'Add Product']) : '';                                
            
                              }
                          ]                            
            ], 
          
        ],
    ]); ?>

</div>
<script type="text/javascript">
			$(function() {
				$('input[name="VendorSearch[crtdt]"]').daterangepicker();
			});
   </script>