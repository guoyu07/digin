<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsSocialmedia */

$this->title = 'Update Skills Socialmedia: ' . ' ' . $model->smid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Socialmedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->smid, 'url' => ['view', 'id' => $model->smid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-socialmedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
