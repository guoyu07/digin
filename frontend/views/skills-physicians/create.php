<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsPhysicians */

$this->title = 'Create Skills Physicians';
$this->params['breadcrumbs'][] = ['label' => 'Skills Physicians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-physicians-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
