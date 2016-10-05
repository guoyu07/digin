<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Reviewquestions */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Reviewquestions',
]) . ' ' . $model->qid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviewquestions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qid, 'url' => ['view', 'id' => $model->qid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="reviewquestions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
