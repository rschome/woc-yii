  <div class="location">用户管理</div>
  

  <div class="massaction"><a href="<?php echo $r; ?>user/add">添加</a></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr class="headings">
		<td>编号</td>
		<td>真实姓名</td>
		<td>所属分组</td>
		<td>电子邮箱</td>
		<td>联系电话</td>
		<td>状态</td>
		<td>最后登陆时间</td>
		<td>最后登陆ip</td>
		<td>操作</td>	
	</tr>
<?php $i=0;?>

<?php foreach($list as $key=>$item):?>
	<?php  if($i%2 == 0):?>
		<tr bgcolor="#F6F6F6">
			<td><?php echo $item['uid'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['rname'];?></td>
			<td><?php echo $item['email'];?></td>
			<td><?php echo $item['telphone'];?></td>
			<td><?php echo $item['status']?"启用":"禁止 ";?></td>
			<td><?php echo date("Y-m-d H:i:s",$item['access']);?></td>
			<td><?php echo $item['ip'];?></td>
			<td><a href="<?php echo $r; ?>user/edit/id/<?php echo $item['uid']; ?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $r; ?>user/delete/id/<?php echo $item['uid'];?>">删除</a></td>
		</tr>
	<?php else:?>
		<tr>
			<td><?php echo $item['uid'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['rname'];?></td>
			<td><?php echo $item['email'];?></td>
			<td><?php echo $item['telphone'];?></td>
			<td><?php echo $item['status']?"启用":"禁止 ";?></td>
			<td><?php echo date("Y-m-d H:i:s",$item['access']);?></td>
			<td><?php echo $item['ip'];?></td>
			<td><a href="<?php echo $r; ?>user/edit/id/<?php echo $item['uid']; ?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $r; ?>user/delete/id/<?php echo $item['uid'];?>">删除</a></td>
		</tr>
	<?php endif;?>
	<?php $i++;?>
<?php endforeach;?>
	<tr>
		<td colspan="9" align="right"><?php $this->widget('Pagination', array('pages' => $pages)); ?></td>
	</tr>

</table>