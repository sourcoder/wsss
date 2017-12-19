<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */

$this->title = '更新 ' . $model->Tname;
$this->params['breadcrumbs'][] = ['label' => '机关老师或评委', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tid, 'url' => ['view', 'id' => $model->Tid]];
$this->params['breadcrumbs'][] = '更新数据';
?>
<div class="teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
