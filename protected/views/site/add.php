<div class="location">添加网站</div>

<form action="<?php echo $r; ?>site/add" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr><label><?php echo $msgSite;?></label></tr>
		<tr>
			<td><label>网站名称:</label><input type="text" name="name" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>网站后台:</label><input type="text" name="admin" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>用户名称:</label><input type="text" name="username" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>用户密码:</label><input type="text" name="password" value="" size=30/></td>
		</tr>
		<tr>
			<td><label>连接方式:</label><input type="text" name="method" value="" size=30/></td>
		</tr>
		<tr>
			<td>
			<label>网站状态:</label>
			<input type="radio" name="status" id="status0" value="0" checked/><label for="status0">使用中</label>
			<input type="radio" name="status" id="status1" value="1"/><label for="status1">已出错</label>
			<input type="radio" name="status" id="status1" value="2"/><label for="status1">维护中</label>
			<input type="radio" name="status" id="status1" value="3"/><label for="status1">已停用</label>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站类型:</label>
			<select name="site_type">
					<option value="">请选择</option>
				<?php foreach ($type as $item):?>
					<option value="<?php echo $item['tid']?>"><?php echo $item['name'];?></option>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站域名:</label>
			<select name="domain">
					<option value="">请选择</option>
				<?php foreach ($domain as $item):?>
					<option value="<?php echo $item['id']?>"><?php echo $item['name'];?></option>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站主机:</label>
			<select name="host">
					<option value="">请选择</option>
				<?php foreach ($host as $item):?>
					<option value="<?php echo $item['id']?>"><?php echo $item['ip'];?></option>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站数据库:</label>
			<select name="data">
					<option value="">请选择</option>
				<?php foreach ($data as $item):?>
					<option value="<?php echo $item['id']?>"><?php echo $item['name'];?></option>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站邮箱:</label>
			<select name="email">
					<option value="">请选择</option>
				<?php foreach ($email as $item):?>
					<option value="<?php echo $item['id']?>"><?php echo $item['name'];?></option>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="rsubmit" value="添加" class="buttons_a"/></td>
		</tr>
		
	</table>
</form>