<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsTravelDetails */

$this->title = 'Update Skills Travel Details: ' . ' ' . $model->trid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Travel Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trid, 'url' => ['view', 'id' => $model->trid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-travel-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
