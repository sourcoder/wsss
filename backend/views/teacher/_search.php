<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TeacherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tid') ?>

    <?= $form->field($model, 'Tname') ?>

    <?= $form->field($model, 'Taccount') ?>

    <?= $form->field($model, 'Tpassword') ?>

    <?= $form->field($model, 'Tgender') ?>

    <?php // echo $form->field($model, 'Tbirthday') ?>

    <?php // echo $form->field($model, 'Tphoto') ?>

    <?php // echo $form->field($model, 'Ttitle') ?>

    <?php // echo $form->field($model, 'Temail') ?>

    <?php // echo $form->field($model, 'Tdepartment') ?>

    <?= //$form->field($model, 'Ttype') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
