<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Specialdestination */

$this->title = Yii::t('app', 'Create Specialdestination');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialdestinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialdestination-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
