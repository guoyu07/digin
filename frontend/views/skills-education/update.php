<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsEducation */

$this->title = 'Update Skills Education: ' . ' ' . $model->eid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Educations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->eid, 'url' => ['view', 'id' => $model->eid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-education-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
