<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsVehicles */

$this->title = 'Update Skills Vehicles: ' . ' ' . $model->vcid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vcid, 'url' => ['view', 'id' => $model->vcid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-vehicles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
