<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsMemories */

$this->title = 'Update Skills Memories: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Skills Memories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->memoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-memories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
