<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Userreview */

$this->title = Yii::t('app', 'Create Userreview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Userreviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userreview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
