<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsMemories */

$this->title = 'Create Skills Memories';
$this->params['breadcrumbs'][] = ['label' => 'Skills Memories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-memories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
