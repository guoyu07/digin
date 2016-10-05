<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsSibblings */

$this->title = 'Create Skills Sibblings';
$this->params['breadcrumbs'][] = ['label' => 'Skills Sibblings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-sibblings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
