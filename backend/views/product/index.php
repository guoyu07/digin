<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $role='';
    $userrole= Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
    foreach($userrole as $r)
    {
      $role=$r->name;
    }
    
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="./js/product.js"></script>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
           
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		//'category' => $category,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'prid',
            'prodname',          
            //'description:ntext',
            [
                    'label'=>'Description',
                    'attribute'=>'description', 
                    'format' =>'html',
                    'value'=>function ($data) {                         
                         return $data->getProductDescription($data->prid);
                    },
            ],
            [
                'label'=>'Product Categories',
                'format'=>'raw',                
                'value'=> function ($data) {
                     $product=new backend\models\Product();
                     return $product->getProductCategory($data->prid);
                     //return $product->getCategoryPath($data->prid);
                },
            ], 
			[
                    'label'=>'In/Active',
                    'attribute'=>'Is_active',
                    'format'=>'raw',                                         
                       'value'=>function($data){                       
                         $activs=$data->getProductActive($data->prid);                                            
                        $vid= $data->getProductVendorId($data->crtby);
						 $category=new backend\models\Category();
                       $pridstatus= $category->getCategoryStatusVen($data->prid);
                    //var_dump($pridstatus);
                        return $activs==1? "<span class='glyphicon glyphicon-ok-circle activ'  aria-hidden='true'  style='color:#33CCFF' id='prod_".$data->prid."_1' catstatus='".$pridstatus."'></span>" :"<span class='glyphicon glyphicon-ban-circle activ' aria-hidden='true' style='color:#d9534f;width:85px;'  id='prod_".$data->prid."_0' catstatus='".$pridstatus."'></span><a href='index.php?r=vendor/view&id=".$vid."' target='_blank'>Added By</a>";
                      
                    },
                   'visible' => Yii::$app->user->can('Admin'),
            ],
            //'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


