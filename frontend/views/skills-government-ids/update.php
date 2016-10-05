<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsGovernmentIds */

$this->title = 'Update Skills Government Ids: ' . ' ' . $model->gid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Government Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gid, 'url' => ['view', 'id' => $model->gid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-government-ids-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
