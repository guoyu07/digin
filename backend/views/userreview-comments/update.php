<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserreviewComments */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Userreview Comments',
]) . ' ' . $model->ucid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Userreview Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ucid, 'url' => ['view', 'id' => $model->ucid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="userreview-comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
