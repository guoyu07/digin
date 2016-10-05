<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsTestimonials */

$this->title = 'Update Skills Testimonials: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Skills Testimonials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->testid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-testimonials-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
