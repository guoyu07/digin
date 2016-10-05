<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsAchievements */

$this->title = 'Update Skills Achievements: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Skills Achievements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-achievements-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
