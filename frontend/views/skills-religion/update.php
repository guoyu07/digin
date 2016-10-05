<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SkillsReligion */

$this->title = 'Update Skills Religion: ' . ' ' . $model->regid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->regid, 'url' => ['view', 'id' => $model->regid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-religion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
