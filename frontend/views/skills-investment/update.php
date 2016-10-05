<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsInvestment */

$this->title = 'Update Skills Investment: ' . ' ' . $model->invid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Investments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invid, 'url' => ['view', 'id' => $model->invid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-investment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
