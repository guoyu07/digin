<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SkillCommonDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Skill Common Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-common-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Skill Common Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'birthdate',
            'birthplaceid',
            'religionid',
            // 'faithid',
            // 'castid',
            // 'sex',
            // 'marrital_status',
            // 'landline',
            // 'blog:ntext',
            // 'annual_income',
            // 'crtdt',
            // 'crtby',
            // 'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
