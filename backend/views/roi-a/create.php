<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RoiA */

$this->title = Yii::t('app', 'Create Roi A');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roi As'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roi-a-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
