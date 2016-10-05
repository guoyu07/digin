<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Orderitem */

$this->title = Yii::t('app', 'Create Orderitem');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orderitems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
