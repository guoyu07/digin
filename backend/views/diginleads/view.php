<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Diginleads */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Diginleads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diginleads-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'vid',
            'leadType',
            'leadName',
            'leadEmail:email',
            'leadPhone',
            'crtdt',
        ],
    ]) ?>

</div>
