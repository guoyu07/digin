<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Reviewquestions */

$this->title = Yii::t('app', 'Create Reviewquestions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviewquestions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewquestions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
