<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */

$this->title = '创建老师或评委角色';
$this->params['breadcrumbs'][] = ['label' => '机关老师或评委', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('createForm', [
        'model' => $model,
    ]) ?>

</div>
