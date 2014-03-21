
<div class="location">缓存管理</div>

<div class="massaction">
<a href="<?php echo $r; ?>caches/list">系统缓存</a>  |  
<a href="<?php echo $r; ?>caches/list/ctype/smarty">模板缓存</a>  |  
<a href="<?php echo $r; ?>caches/clear">更新系统缓存</a>  |  
<a href="<?php echo $r; ?>caches/clear/ctype/smarty">清空模板缓存</a>
</div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>文件名</td>
		<td>创建时间</td>
		<td>文件大小</td>
	</tr>
<?php foreach($caches as $key=>$item):?>
	<tr>
		<td bgcolor="#F6F6F6"><?php echo $item['fname'] ?></td>
		<td bgcolor="#F6F6F6"><?php echo $item['ftime'] ?></td>
		<td bgcolor="#F6F6F6"><?php echo $item['fsize'] ?></td>
	</tr>
<?php endforeach;?>
</table>