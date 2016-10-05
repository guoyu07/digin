<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillsTravelDetails */

$this->title = 'Create Skills Travel Details';
$this->params['breadcrumbs'][] = ['label' => 'Skills Travel Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-travel-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
