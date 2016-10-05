<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php //$session = Yii::$app->session;
     // $result = $session->hasFlash('success');
     // if($result){
         //echo $session->getFlash('success');
     //}
?>
<div class="user-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['/user/registration/register'], ['class' => 'btn btn-success']) ?>
    </p>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'uid',
            'firstname',
            'lastname',
            //'user_id',         
            'username',
            'email',
            'phone',
            'role',
            //'city',
            //'country',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],        
        ],
    ]); ?>

</div>
