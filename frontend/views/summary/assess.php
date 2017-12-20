<?php
use yii\helpers\Url;
print_r($data);
?>
<h1>评分列表</h1>
<table class="table table-hover">
<?php //print_r($data);exit();?>
    <?php foreach($data as $list):?>
    <tr>
        <td><a href="<?=Url::to(['summary/show', 'Tid' => $list['summary']['Tid'], 'Zid'=> $list['summary']['Zid']])?>"><?= $list['name']?></a></td>
    </tr>
    <?php endforeach;?>
  
</table>