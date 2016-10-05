<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SkillsHobbies */

$this->title = 'Update Skills Hobbies: ' . ' ' . $model->hbid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hbid, 'url' => ['view', 'id' => $model->hbid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-hobbies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
