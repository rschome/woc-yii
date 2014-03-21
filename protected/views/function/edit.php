<div class="location">修改功能</div>

<form action="<?php echo $r; ?>function/edit" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>
			<td>
			<label>功能名称:</label>
			<input type="text" name="name" value="<?php echo $RsInfo['name'];?>" size=64/>
			</td>
		</tr>
		<tr>
			<td>
			<label>控制器:</label>
			<input type="text" name="controller" value="<?php echo $RsInfo['controller'];?>" size=64/>
			</td>
		</tr>
		<tr>
			<td>
			<input type="hidden" name="id" value="<?php echo $RsInfo['id'];?>"/>
			<input type="submit" name="rsubmit" value="修改 " class="buttons_a"/>
			</td>
		</tr>
		<tr><label><?php echo $msgFunction;?></label></tr>
	</table>
</form>