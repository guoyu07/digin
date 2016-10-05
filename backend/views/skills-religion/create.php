<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SkillsReligion */

$this->title = 'Create Religion';
$this->params['breadcrumbs'][] = ['label' => 'Skills Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-religion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
