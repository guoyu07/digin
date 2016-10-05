<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SkillsHobbies */

$this->title = 'Create Skills Hobbies';
$this->params['breadcrumbs'][] = ['label' => 'Skills Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-hobbies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
