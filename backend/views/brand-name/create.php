<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BrandName */

$this->title = Yii::t('app', 'Create Brand Name');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brand Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-name-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
