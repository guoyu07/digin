<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsHealthdetails */

$this->title = 'Create Skills Healthdetails';
$this->params['breadcrumbs'][] = ['label' => 'Skills Healthdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-healthdetails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
