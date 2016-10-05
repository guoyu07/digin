<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\Models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="./js/product.js"></script>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <!--?= Html::button('Create Category', ['value' => Url::to(['category/create']), 'title' => 'Creating New Category', 'class' => 'showModalButton btn btn-success']); ?-->
    
    <?= 
         GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'parentid',
            
             [
                       'label' => 'Parent Category',
                       'attribute' => 'parent',
                       'value' => function ($data) {
                            $category=new backend\models\Category();
                            return $category->getParentName($data->parentid);
                       },
            ],
            //'description',
            [
                    'label'=>'Description',
                    'attribute'=>'description',
                    'value'=>function ($data) {
                         $category=new backend\models\Category();
                         return $data->getCategoryDescription($data->id);
                    },
            ],
            //'tags',
            [
                    'label'=>'Tags',
                    'attribute'=>'tags',
                    'value'=>function ($data) {
                         $category=new backend\models\Category();
                         return $data->getCategoryTags($data->id);
                    },
            ],
           [
                    'label'=>'Status',
                    'attribute'=>'status',
                    'format'=>'raw',                   
                    'value'=>function($data){
						//$model=new backend\models\Category();
                        $status=$data->getVenderCatActive($data->id); 
						
						 return $status==1? "<span class='glyphicon glyphicon-ok-sign activVen'  aria-hidden='true'  style='color:#5cb85c' id='ven_".$data->id."_1' title='Active/Inactive'></span>" : "<span class='glyphicon glyphicon-exclamation-sign activVen' aria-hidden='true' style='color:#d9534f' id='ven_".$data->id."_0'></span>";
                        
                    },
                   
            ],
            //'path',
            [
                    'label'=>'Path',
                    'attribute'=>'path',
                    'value'=>function ($data) {
                         $category=new backend\models\Category();
                         return $data->getCategoryPath($data->id);
                    },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        
    ]); ?>

</div>
