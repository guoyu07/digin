<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsParents */

$this->title = 'Create Skills Parents';
$this->params['breadcrumbs'][] = ['label' => 'Skills Parents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-parents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sibblingmodel' => $sibblingmodel,
        'spousemodel' => $spousemodel,
    ]) ?>

</div>
