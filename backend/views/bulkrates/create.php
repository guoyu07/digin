<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Bulkrates */

$this->title = Yii::t('app', 'Create Bulkrates');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bulkrates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bulkrates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
