<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Franchisee */

$this->title = Yii::t('app', 'Create Franchisee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Franchisees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="franchisee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modeladdress' => $modeladdress,
    ]) ?>

</div>
