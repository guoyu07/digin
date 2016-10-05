<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsHealthdetails */

$this->title = $model->hid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Healthdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-healthdetails-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->hid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->hid], [
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
            'hid',
            'userid',
            'bloodgroup',
            'height',
            'weight',
            'medication',
            'diseases:ntext',
            'crtdt',
            'crtby',
            'upddt',
            'updby',
        ],
    ]) ?>

</div>
