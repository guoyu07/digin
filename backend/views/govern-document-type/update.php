<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GovernDocumentType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Govern Document Type',
]) . ' ' . $model->doc_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Govern Document Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doc_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="govern-document-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
