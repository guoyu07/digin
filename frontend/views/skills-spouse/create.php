<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsSpouse */

$this->title = 'Create Skills Spouse';
$this->params['breadcrumbs'][] = ['label' => 'Skills Spouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-spouse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
