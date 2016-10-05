<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsFaith */

$this->title = 'Update Skills Faith: ' . ' ' . $model->faithid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Faiths', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->faithid, 'url' => ['view', 'id' => $model->faithid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="skills-faith-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
