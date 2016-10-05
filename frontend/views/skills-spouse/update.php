<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsSpouse */

$this->title = 'Update Skills Spouse: ' . ' ' . $model->spid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Spouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->spid, 'url' => ['view', 'id' => $model->spid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-spouse-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
