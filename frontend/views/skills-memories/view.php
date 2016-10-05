<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsMemories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Skills Memories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-memories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->memoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->memoid], [
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
            'memoid',
            'userid',
            'title:ntext',
            'note:ntext',
            'crtdt',
            'crtby',
            'upddt',
            'updby',
        ],
    ]) ?>

</div>
