<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserreviewComments */

$this->title = Yii::t('app', 'Create Userreview Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Userreview Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userreview-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
