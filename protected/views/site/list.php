
<div class="location">网站管理</div>

<div class="massaction"><a href="<?php echo $r; ?>site/add">添加</a></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>编号</td>
		<td>名称</td>
		<td>账号</td>
		<td>密码</td>
		<td>订单数量</td>
		<td>客户数量</td>
		<td>状态</td>
		<td>操作</td>
	</tr>
<?php $i=0;?>
<?php foreach($list as $key=>$item):?>
<?php if($i%2 == 0):?>
	<tr bgcolor="#F6F6F6">
		<td><?php echo $item['sid'] ?></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo $item['username'] ?></td>
		<td><?php echo $item['password'] ?></td>
		<td><?php echo $mynum[$key] ?></td>
		<td><?php echo $mynum2[$key] ?></td>
		<td>
		     <?php if(0 == $item['status']):?>使用中
		     <?php elseif(1 == $item['status']):?>已出错
		     <?php elseif(2 == $item['status']):?>维护中
		     <?php elseif(3 == $item['status']):?>已停用
		     <?php endif;?>
		</td>
		<td>
		<a target="_blank" href="<?php echo 'http://'.$item['admin'].'/' ?>">管理</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>site/edit/id/<?php echo $item['sid'] ?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>site/delete/id/<?php echo $item['sid'] ?>">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>domain/list/id/<?php echo $item['dmid'] ?>">域名</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>host/list/id/<?php echo $item['hid'] ?>">主机</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>data/list/id/<?php echo $item['dbid'] ?>">数据库</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>email/list/id/<?php echo $item['eid'] ?>">邮箱</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>seo/list/id/<?php echo $item['sid'] ?>">SEO</a>
		</td>
	</tr>
<?php else:?>
	<tr>
		<td><?php echo $item['sid'] ?></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo $item['username'] ?></td>
		<td><?php echo $item['password'] ?></td>
		<td><?php echo $mynum[$key] ?></td>
		<td><?php echo $mynum2[$key] ?></td>
		<td>
		     <?php if(0 == $item['status']):?>使用中
		     <?php elseif(1 == $item['status']):?>已出错
		     <?php elseif(2 == $item['status']):?>维护中
		     <?php elseif(3 == $item['status']):?>已停用
		     <?php endif;?>
		</td>
		<td>
		<a target="_blank" href="<?php echo 'http://'.$item['admin'].'/' ?>">管理</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>site/edit/id/<?php echo $item['sid'] ?>">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>site/delete/id/<?php echo $item['sid'] ?>">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>domain/list/id/<?php echo $item['dmid'] ?>">域名</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>host/list/id/<?php echo $item['hid'] ?>">主机</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>data/list/id/<?php echo $item['dbid'] ?>">数据库</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $r; ?>email/list/id/<?php echo $item['eid'] ?>">邮箱</a>
		</td>
	</tr>
<?php endif;?>
	<?php $i++;?>
<?php endforeach;?>
	<tr>
		<td colspan="8" align="right"><?php $this->widget('Pagination', array('pages' => $pages)); ?></td>
	</tr>
</table>