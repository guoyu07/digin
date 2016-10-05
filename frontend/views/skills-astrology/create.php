<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsAstrology */

$this->title = 'Create Skills Astrology';
$this->params['breadcrumbs'][] = ['label' => 'Skills Astrologies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-astrology-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
