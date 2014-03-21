<div class="location">修改分类</div>

<form action="<?php echo $r; ?>type/edit" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>
			<td><label>分类修改:</label><input type="text" name="name" value="<?php echo $rsInfo['name'];?>" size=64/><input type="submit" name="rsubmit" value="修改" class="buttons_a"/></td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $rsInfo['tid']; ?>"/>
		<tr><label><?php echo $msgPT;?></label></tr>
	</table>

</form>