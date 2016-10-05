<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SkillsCreationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Skills Creations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-creations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Skills Creations', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'crid',
            'userid',
            'title:ntext',
            'note:ntext',
            'image',
            // 'youtoube_link:ntext',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
