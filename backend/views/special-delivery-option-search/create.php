<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SpecialDeliveryOption */

$this->title = Yii::t('app', 'Create Special Delivery Option');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Special Delivery Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-delivery-option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
