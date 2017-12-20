<?php
use yii\helpers\Url;
?>
<h1>评分列表</h1>
<table class="table table-hover">
<?php //print_r($data);exit();?>
    <?php foreach($data as $list):?>
    <tr>
        <td><a href="<?=Url::to(['summary/score', 'Tid' => $tid, 'Zid'=> $list['summary']['Zid']])?>"><?= $list['name']?></a></td>
        <td><?=$list['isScore']?"已评价":"未评价"?></td>
    </tr>
    <?php endforeach;?>
  
</table>