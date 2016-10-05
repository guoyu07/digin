<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RoiB */

$this->title = Yii::t('app', 'Create Roi B');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roi Bs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roi-b-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
