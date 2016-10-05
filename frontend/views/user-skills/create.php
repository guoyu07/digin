<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserSkills */

$this->title = 'Create User Skills';
$this->params['breadcrumbs'][] = ['label' => 'User Skills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-skills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
