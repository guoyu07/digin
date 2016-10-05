<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserHobbies */

$this->title = 'Update User Hobbies: ' . ' ' . $model->uhbid;
$this->params['breadcrumbs'][] = ['label' => 'User Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uhbid, 'url' => ['view', 'id' => $model->uhbid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-hobbies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
