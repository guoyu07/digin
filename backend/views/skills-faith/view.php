<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsFaith */

$this->title = $model->faith;
$this->params['breadcrumbs'][] = ['label' => 'Skills Faiths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-faith-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->faithid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->faithid], [
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
            'faithid',            
            'faith',
          /*  'crtdt',
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>

</div>
