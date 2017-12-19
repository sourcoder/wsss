<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Taccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tpassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ttype')->dropDownList([1 => '评委', 0=> '机关老师']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>