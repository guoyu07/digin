<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsPlans */

$this->title = 'Create Skills Plans';
$this->params['breadcrumbs'][] = ['label' => 'Skills Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-plans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
