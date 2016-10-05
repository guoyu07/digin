<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsPlans */

$this->title = 'Update Skills Plans: ' . ' ' . $model->planid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->planid, 'url' => ['view', 'id' => $model->planid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-plans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
