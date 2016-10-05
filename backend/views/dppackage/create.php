<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Dppackage */

$this->title = Yii::t('app', 'Create Delivery Partner Package');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delivery Partner Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dppackage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mdlpkgrates' => $mdlpkgrates,
        'mdlbulkrates' => $mdlbulkrates,
    ]) ?>

</div>
