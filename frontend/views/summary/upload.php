<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($fileModel, 'file')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end() ?>
<table class="table table-hover">
<?php //print_r($data);exit();?>
    <?php foreach($data as $list):?>
    <tr>
        <td><a href="<?= $list['Zpathurl']?>"><?= $list['filename']?></a></td>
    </tr>
    <?php endforeach;?>
  
</table>