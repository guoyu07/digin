<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsMedia */

$this->title = 'Create Skills Media';
$this->params['breadcrumbs'][] = ['label' => 'Skills Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
