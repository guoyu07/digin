<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Vendortype */

$this->title = Yii::t('app', 'Create Vendortype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendortypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendortype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
