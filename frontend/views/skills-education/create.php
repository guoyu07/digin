<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsEducation */

$this->title = 'Create Skills Education';
$this->params['breadcrumbs'][] = ['label' => 'Skills Educations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-education-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
