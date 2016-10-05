<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Skills */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Skills',
]) . ' ' . $model->skill;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->skill, 'url' => ['view', 'id' => $model->sid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="skills-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
