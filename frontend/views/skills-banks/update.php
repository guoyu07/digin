<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsBanks */

$this->title = 'Update Skills Banks: ' . ' ' . $model->bid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bid, 'url' => ['view', 'id' => $model->bid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-banks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
