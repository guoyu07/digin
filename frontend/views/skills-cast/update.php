<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsCast */

$this->title = 'Update Skills Cast: ' . ' ' . $model->castid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Casts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->castid, 'url' => ['view', 'id' => $model->castid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-cast-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
