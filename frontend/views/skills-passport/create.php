<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsPassport */

$this->title = 'Create Skills Passport';
$this->params['breadcrumbs'][] = ['label' => 'Skills Passports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-passport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
