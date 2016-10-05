<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsAstrology */

$this->title = 'Update Skills Astrology: ' . ' ' . $model->astid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Astrologies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->astid, 'url' => ['view', 'id' => $model->astid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-astrology-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
