<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsPhilosophy */

$this->title = 'Update Skills Philosophy: ' . ' ' . $model->phid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Philosophies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->phid, 'url' => ['view', 'id' => $model->phid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-philosophy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
