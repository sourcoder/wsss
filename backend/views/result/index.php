<?php
?>
<table class="table table-hover">
    <tr>
        <th>姓名</th>
        <th>机关老师互评</th>
        <th>评委</th>
        <th>结果</th>
    </tr>
    <?php foreach ($data as $one) {?>
    <tr>
        <td><?= $one['name']?></td>
        <td><?= $one['teacher']?></td>
        <td><?= $one['advicer']?></td>
        <td><?= $one['result']?></td>
    </tr>
    <?php }?>
</table>