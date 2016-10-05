<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsHealthdetails */

$this->title = 'Update Skills Healthdetails: ' . ' ' . $model->hid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Healthdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hid, 'url' => ['view', 'id' => $model->hid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-healthdetails-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
