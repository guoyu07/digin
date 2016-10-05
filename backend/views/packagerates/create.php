<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Packagerates */

$this->title = Yii::t('app', 'Create Packagerates');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packagerates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packagerates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
