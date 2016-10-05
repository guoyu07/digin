<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserSkills */

$this->title = 'Update User Skills: ' . ' ' . $model->usid;
$this->params['breadcrumbs'][] = ['label' => 'User Skills', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usid, 'url' => ['view', 'id' => $model->usid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-skills-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
