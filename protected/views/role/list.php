  <div class="location">角色管理</div>
  

  <div class="massaction"><a href="<?php echo $r; ?>role/add">添加</a></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>编号</td>
		<td>名称</td>
		<td>操作</td>
	</tr>
<?php $i=0;?>
<?php foreach($list as $key=>$item):?>
	<?php if($i%2 == 0):?>
	<tr bgcolor="#F6F6F6">
		<td><?php echo $item['id']?></td>
		<td><?php echo $item['name']?></td>
		<td><a href="<?php echo $r; ?>role/edit/id/<?php echo $item['rid']?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $r; ?>role/delete/id/<?php echo $item['rid'];?>">删除</a></td>
	</tr>
	<?php else:?>
	<tr>
		<td><?php echo $item['id']?></td>
		<td><?php echo $item['name']?></td>
		<td><a href="<?php echo $r; ?>role/edit/id/<?php echo $item['rid']?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $r; ?>role/delete/id/<?php echo $item['rid'];?>">删除</a></td>
	</tr>
	<?php endif;?>
	<?php $i++;?>
<?php endforeach;?>
	<tr>
		<td colspan="3" align="right"><?php $this->widget('Pagination', array('pages' => $pages)); ?></td>
	</tr>

</table>