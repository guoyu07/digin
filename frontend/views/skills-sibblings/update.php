<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsSibblings */

$this->title = 'Update Skills Sibblings: ' . ' ' . $model->sibid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Sibblings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sibid, 'url' => ['view', 'id' => $model->sibid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-sibblings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
