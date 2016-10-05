<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsOccupation */

$this->title = 'Create Skills Occupation';
$this->params['breadcrumbs'][] = ['label' => 'Skills Occupations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-occupation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userskillmodel' => $userskillmodel,
        'testmodel' => $testmodel,
        'consultantmodel' => $consultantmodel,
    ]) ?>

</div>
