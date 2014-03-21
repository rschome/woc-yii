<div class="location">修改邮箱</div>

<form action="<?php echo $r; ?>email/edit" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr><label><?php echo $msgEmail;?></label></tr>
		<tr>
			<td><label>邮箱名称:</label><input type="text" name="name" value="<?php echo $rsInfo['name'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>管理入口:</label><input type="text" name="admin" value="<?php echo $rsInfo['admin'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>管理账号:</label><input type="text" name="username" value="<?php echo $rsInfo['username'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>管理账号:</label><input type="text" name="password" value="<?php echo $rsInfo['password'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>供应商户:</label><input type="text" name="provider" value="<?php echo $rsInfo['provider'];?>" size=30/></td>
		</tr>
		<tr>
			<td>
			<label>邮箱状态:</label>
			<input type="radio" name="status" id="status0" value="0"<?php if(0 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status0">使用中</label>
			<input type="radio" name="status" id="status1" value="1"<?php if(1 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status1">已出错</label>
			<input type="radio" name="status" id="status1" value="2"<?php if(2 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status1">维护中</label>
			<input type="radio" name="status" id="status1" value="3"<?php if(3 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status1">已停用</label>
			</td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $rsInfo['id']; ?>"/>
		<tr>
			<td><input type="submit" name="rsubmit" value="修改 " class="buttons_a"/></td>
		</tr>
	</table>
</form>