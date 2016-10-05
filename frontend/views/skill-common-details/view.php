<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SkillCommonDetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Skill Common Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-common-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userid',
            'birthdate',
            'birthplaceid',
            'religionid',
            'faithid',
            'castid',
            'sex',
            'marrital_status',
            'landline',
            'blog:ntext',
            'annual_income',
            'crtdt',
            'crtby',
            'upddt',
            'updby',
        ],
    ]) ?>

</div>
