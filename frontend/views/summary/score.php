<?php
// print_r($data);
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
?>

<div class="container">
    <h1>评委评分页面</h1>
    <table>
        <tr><td><?= $data['Tname']?></td><tr>
        <tr><td><img src="<?= '/'.$data['Tphoto'] ?>"/></td></tr>
        <tr><td><a href="<?='/'.$summaryinfo['Zpathurl']?>">点击下载个人工作总结</a></td></tr>
        <?php $form = ActiveForm::begin([
				
			]) ?>
        <tr><td><?= $form->field($g, 'GScore')->textInput() ?></td></tr>
		<?php if($isAdvicer) {?>
		  <tr><td><?= $form->field($g, 'Gsuggestion')->textarea(['rows'=>3]) ?></td></tr> 
        <?php }?>
		  <tr><td><?= Html::submitButton("提交", ['class' => 'btn btn-info btn-flat margin upload-btn'])?></td></tr>
        <?php ActiveForm::end() ?>
    </table>
</div>