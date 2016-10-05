<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsCreations */

$this->title = 'Update Skills Creations: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Skills Creations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->crid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-creations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
