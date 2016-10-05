<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsLikings */

$this->title = 'Create Skills Likings';
$this->params['breadcrumbs'][] = ['label' => 'Skills Likings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-likings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
