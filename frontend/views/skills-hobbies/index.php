<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SkillsHobbiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Skills Hobbies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-hobbies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Skills Hobbies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'hbid',
            'hobby',
            'crtdt',
            'crtby',
            'upddt',
            // 'updby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
