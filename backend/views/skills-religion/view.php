<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SkillsReligion */

$this->title = $model->religion_name;
$this->params['breadcrumbs'][] = ['label' => 'Skills Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-religion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->regid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->regid], [
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
            'regid',
            'religion_name',
           /* 'crtdt',
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>

</div>
