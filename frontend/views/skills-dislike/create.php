<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsDislike */

$this->title = 'Create Skills Dislike';
$this->params['breadcrumbs'][] = ['label' => 'Skills Dislikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-dislike-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
