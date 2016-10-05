<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsIdols */

$this->title = 'Create Skills Idols';
$this->params['breadcrumbs'][] = ['label' => 'Skills Idols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-idols-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
