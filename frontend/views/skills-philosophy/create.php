<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsPhilosophy */

$this->title = 'Create Skills Philosophy';
$this->params['breadcrumbs'][] = ['label' => 'Skills Philosophies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-philosophy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
