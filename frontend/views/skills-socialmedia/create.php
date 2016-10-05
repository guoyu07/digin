<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsSocialmedia */

$this->title = 'Create Skills Socialmedia';
$this->params['breadcrumbs'][] = ['label' => 'Skills Socialmedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-socialmedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
