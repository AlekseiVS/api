<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataTransitionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-transition-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'link_id') ?>

    <?= $form->field($model, 'date_transition') ?>

    <?= $form->field($model, 'referer') ?>

    <?= $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'browser') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
