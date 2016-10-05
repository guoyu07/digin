<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SkillsParents */

$this->title = $model->parentid;
$this->params['breadcrumbs'][] = ['label' => 'Skills Parents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-parents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->parentid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->parentid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'parentid',
            //'userid',           
            'father_firstname',
            'father_lastname',
            'mother_firstname',
            'mother_lastname',
            /*'crtdt',
            'crtby',
            'upddt',
            'updby',*/
        ],
    ]) ?>

</div>
