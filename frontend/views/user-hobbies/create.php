<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserHobbies */

$this->title = 'Create User Hobbies';
$this->params['breadcrumbs'][] = ['label' => 'User Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-hobbies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
