<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsDiseases */

$this->title = 'Update Skills Diseases: ' . ' ' . $model->disid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Diseases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->disid, 'url' => ['view', 'id' => $model->disid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-diseases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
