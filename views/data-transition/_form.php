<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataTransition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-transition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'link_id')->textInput() ?>

    <?= $form->field($model, 'date_transition')->textInput() ?>

    <?= $form->field($model, 'referer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
