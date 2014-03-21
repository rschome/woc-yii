
  <div class="location">功能管理</div>
  

<div class="massaction"><a href="<?php echo $r; ?>function/add">添加</a></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>编号</td>
		<td>名称</td>
		<td>控制器</td>
		<td>操作</td>
	</tr>
<?php $i=0;?>
<?php foreach($list as $key=>$item):?>
<?php if($i%2 == 0):?>
	<tr bgcolor="#F6F6F6">
		<td><?php echo $item['id']?></td>
		<td><?php echo $item['name']?></td>
		<td><?php echo $item['controller']?></td>
		<td><a href="<?php echo $r; ?>function/edit/id/<?php echo $item['id']?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $r; ?>function/delete/id/<?php echo $item['id'];?>">删除</a></td>
	</tr>
<?php else:?>
	<tr>
		<td><?php echo $item['id']?></td>
		<td><?php echo $item['name']?></td>
		<td><?php echo $item['controller']?></td>
		<td><a href="<?php echo $r; ?>function/edit/id/<?php echo $item['id']?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $r; ?>function/delete/id/<?php echo $item['id'];?>">删除</a></td>
	</tr>
<?php endif;?>
	<?php $i++;?>
<?php endforeach;?>
	<tr>
		<td colspan="4" align="right"><?php $this->widget('Pagination', array('pages' => $pages)); ?></td>
	</tr>
</table>