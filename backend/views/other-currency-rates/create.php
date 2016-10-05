<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OtherCurrencyRates */

$this->title = Yii::t('app', 'Create Other Currency Rates');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Other Currency Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="other-currency-rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
