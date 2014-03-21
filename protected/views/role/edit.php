<div class="location">修改角色</div>


<form action="<?php echo $r; ?>role/edit" method="post" name="editform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>
			<td><label>角色修改:</label><input type="text" name="name" value="<?php echo $rsInfo['name'];?>" size=64/><input type="submit" name="rsubmit" value="修改" class="buttons_a"/></td>
		</tr>

		<?php if($permInfo->perm == "0"):?>
			<tr>
				<td><label>功能选择:</label><select name='resource' onchange='if(this.value=="1")document.getElementById("res_area").style.display="";else document.getElementById("res_area").style.display="none";'><option value='0'>全部</option><option value="1">选择</option></select></td>
			</tr>
			<tr id="res_area" style='display:none'>
				<td>
					<?php $i=0; foreach ($res as $item):?>
						<input id="<?php echo $i;?>" type="checkbox" name="role[]" value="<?php echo $item['controller'];?>"><label for="<?php echo $i;?>"><?php echo $item['name']?></label>
					<?php $i++; endforeach;?>
				</td>
			</tr>
		<?php else:?>
			<tr>
				<td><label>功能选择:</label><select name='resource' onchange='if(this.value=="1")document.getElementById("res_area").style.display="";else document.getElementById("res_area").style.display="none";'><option value='0'>all</option><option value="1" selected>选择</option></select></td>
			</tr>
			<tr id="res_area" style='display:block'>
				<td>
					<?php $i=0; foreach ($res as $item):?>
					
							<?php if(strpos($permInfo->perm,$item['controller']) === false):?>
					
								<input id="<?php echo $i;?>" type="checkbox" name="role[]" value="<?php echo $item['controller'];?>"><label for="<?php echo $i;?>" ><?php echo $item['name']?></label>
							<?php else:?>
								
								<input id="<?php echo $i;?>" type="checkbox" name="role[]" value="<?php echo $item['controller'];?>" checked><label for="<?php echo $i;?>" ><?php echo $item['name']?></label>
							<?php endif;?>
					<?php $i++; endforeach;?>
				</td>
			</tr>		
		<?php endif;?>
		<tr><label><?php echo $msgRole;?></label></tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $rsInfo['rid'];?>"/>
</form>