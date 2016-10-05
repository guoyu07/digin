<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsLikings */

$this->title = 'Update Skills Likings: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Skills Likings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->likeid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-likings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
