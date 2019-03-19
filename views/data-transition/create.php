<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataTransition */

$this->title = 'Create Data Transition';
$this->params['breadcrumbs'][] = ['label' => 'Data Transitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-transition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
