<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsFaith */

$this->title = 'Create Faith';
$this->params['breadcrumbs'][] = ['label' => 'Skills Faiths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-faith-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
