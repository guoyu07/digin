<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ZoneCities */

$this->title = Yii::t('app', 'Create Zone Cities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zone Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-cities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
