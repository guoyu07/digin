<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsParents */

$this->title = 'Update Skills Parents: ' . ' ' . $model->parentid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Parents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parentid, 'url' => ['view', 'id' => $model->parentid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-parents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
