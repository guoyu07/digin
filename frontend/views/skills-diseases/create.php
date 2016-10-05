<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\SkillsDiseases */

$this->title = 'Create Skills Diseases';
$this->params['breadcrumbs'][] = ['label' => 'Skills Diseases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-diseases-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
