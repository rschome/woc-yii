<div class="location">添加角色</div>

<form action="<?php echo $r; ?>role/add" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>
			<td><label>角色添加:</label><input type="text" name="name" value="" size=64/><input type="submit" name="rsubmit" value="添加" class="buttons_a"/></td>
		</tr>
		<tr>
			<td><label>资源选择:</label><select name='resource' onchange='if(this.value=="1")document.getElementById("res_area").style.display="";else document.getElementById("res_area").style.display="none";'><option value='0'>全部</option><option value="1">选择</option></select></td>
		</tr>
		<tr id="res_area" style='display:none'>
			<td>
				<?php $i=0; foreach ($rs as $item):?>
					<input id="<?php echo $i;?>" type="checkbox" name="role[]" value="<?php echo $item['controller'];?>"><label for="<?php echo $i;?>"><?php echo $item['name']?></label>
				<?php $i++; endforeach;?>
			</td>
		</tr>
		<tr><label><?php echo $msgRole;?></label></tr>
	</table>
</form>