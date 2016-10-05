<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ServicablePincodes */

$this->title = Yii::t('app', 'Create Servicable Pincodes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicable Pincodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicable-pincodes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
