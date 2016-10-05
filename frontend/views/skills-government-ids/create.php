<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsGovernmentIds */

$this->title = 'Create Skills Government Ids';
$this->params['breadcrumbs'][] = ['label' => 'Skills Government Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-government-ids-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
