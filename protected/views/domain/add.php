<div class="location">添加域名</div>

<form action="<?php echo $r; ?>domain/add" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr><label><?php echo $msgDomain;?></label></tr>
		<tr>
			<td><label>域名名称:</label><input type="text" name="name" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>管理入口:</label><input type="text" name="admin" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>管理账号:</label><input type="text" name="username" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>管理密码:</label><input type="text" name="password" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>供应商户:</label><input type="text" name="provider" value="" size=30/></td>
		</tr>
		<tr>
			<td>
			<label>域名状态:</label>
			<input type="radio" name="status" id="status0" value="0" checked/><label for="status0">使用中</label>
			<input type="radio" name="status" id="status1" value="1"/><label for="status1">已出错</label>
			<input type="radio" name="status" id="status1" value="2"/><label for="status1">维护中</label>
			<input type="radio" name="status" id="status1" value="3"/><label for="status1">已停用</label>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="rsubmit" value="添加" class="buttons_a"/></td>
		</tr>
		
	</table>
</form>