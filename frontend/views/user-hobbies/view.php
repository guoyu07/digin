<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserHobbies */

$this->title = $model->uhbid;
$this->params['breadcrumbs'][] = ['label' => 'User Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-hobbies-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->uhbid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->uhbid], [
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
            'uhbid',
            'userid',
            'hobbyid',
            'crtdt',
            'crtby',
            'upddt',
            'updby',
        ],
    ]) ?>

</div>
