<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsOccupation */

$this->title = 'Update Skills Occupation: ' . ' ' . $model->ocid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Occupations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ocid, 'url' => ['view', 'id' => $model->ocid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-occupation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
