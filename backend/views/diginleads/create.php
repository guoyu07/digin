<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Diginleads */

$this->title = Yii::t('app', 'Create Diginleads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diginleads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diginleads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
