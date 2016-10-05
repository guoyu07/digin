<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Wishlist */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Wishlist',
]) . ' ' . $model->wid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wishlists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wid, 'url' => ['view', 'id' => $model->wid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="wishlist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
