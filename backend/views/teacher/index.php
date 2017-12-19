<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '机关老师或评委';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tid',
            'Tname',
            'Taccount',
            'Tpassword',
            'Tgender',
            // 'Tbirthday',
            // 'Tphoto',
            // 'Ttitle',
            // 'Temail:email',
            // 'Tdepartment',
            // 'Ttype',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
