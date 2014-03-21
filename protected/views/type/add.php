<div class="location">添加分类</div>


<form action="<?php echo $r; ?>type/add" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>
			<td><label>分类添加:</label><input type="text" name="name" value="" size=64/><input type="submit" name="rsubmit" value="添加" class="buttons_a"/></td>
		</tr>
		<tr><label><?php echo $msgPT;?></label></tr>
	</table>
</form>