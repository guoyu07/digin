<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SkillCommonDetails */

$this->title = 'Create Skill Common Details';
$this->params['breadcrumbs'][] = ['label' => 'Skill Common Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-common-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userdetailmodel' => $userdetailmodel,
                'country' =>$country,
                'state' => $state,
                'city' => $city,
                'user' => $user,
    ]) ?>

</div>
