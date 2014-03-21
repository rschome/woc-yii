<div class="location">添加功能</div>

<form action="<?php echo $r; ?>function/add" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>
			<td><label>功能名称:</label><input type="text" name="name" value="" size=64/></td>
		</tr>
		<tr>
			<td><label>控制器:</label><input type="text" name="controller" value="" size=64/></td>
		</tr>
		<tr>
			<td><input type="submit" name="rsubmit" value="添加" class="buttons_a"/></td>
		</tr>
		<tr><label><?php echo $msgFunction;?></label></tr>
	</table>
</form>