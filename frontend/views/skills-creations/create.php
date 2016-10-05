<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsCreations */

$this->title = 'Create Skills Creations';
$this->params['breadcrumbs'][] = ['label' => 'Skills Creations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-creations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
