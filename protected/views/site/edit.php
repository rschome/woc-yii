<div class="location">修改网站</div>

<form action="<?php echo $r; ?>site/edit" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr><label><?php echo $msgSite;?></label></tr>
		<tr>
			<td><label>网站名称:</label><input type="text" name="name" value="<?php echo $rsInfo['name'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>网站后台:</label><input type="text" name="admin" value="<?php echo $rsInfo['admin'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>用户名称:</label><input type="text" name="username" value="<?php echo $rsInfo['username'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>用户密码:</label><input type="text" name="password" value="<?php echo $rsInfo['password'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>连接方式:</label><input type="text" name="method" value="<?php echo $rsInfo['method'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>订单数量:</label><input type="text" name="onum" value="<?php echo $rsNum['onum'];?>" size=30/></td>
		</tr>
		<tr>
			<td><label>客户数量:</label><input type="text" name="cnum" value="<?php echo $rsNum['cnum'];?>" size=30/></td>
		</tr>
		<tr>
			<td>
			<label>网站状态:</label>
			<input type="radio" name="status" id="status0" value="0"<?php if(0 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status0">使用中</label>
			<input type="radio" name="status" id="status1" value="1"<?php if(1 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status1">已出错</label>
			<input type="radio" name="status" id="status1" value="2"<?php if(2 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status1">维护中</label>
			<input type="radio" name="status" id="status1" value="3"<?php if(3 == $rsInfo['status']):?> checked<?php endif;?>/><label for="status1">已停用</label>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站类型:</label>
			<select name="site_type">
				<?php foreach ($type as $item):?>
					<?php if(0 == $rsInfo['tid']):?>
					<option value="">请选择</option>
					<?php else:?>
					<?php if($item['tid'] == $rsInfo['tid']):?>
						<option value="<?php echo $item['tid']?>" selected><?php echo $item['name'];?></option>
					<?php else:?>
						<option value="<?php echo $item['tid']?>"><?php echo $item['name'];?></option>
					<?php endif;?>
					<?php endif;?>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站域名:</label>
			<select name="domain">
				<?php if(0 == $rsInfo['dmid']):?>
					<option value="">请选择</option>
				<?php endif;?>
				<?php foreach ($domain as $item):?>
					<?php if($item['id'] == $rsInfo['dmid']):?>
						<option value="<?php echo $item['id']?>" selected><?php echo $item['name'];?></option>
					<?php else:?>
						<option value="<?php echo $item['id']?>"><?php echo $item['name'];?></option>
					<?php endif;?>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站主机:</label>
			<select name="host">
				<?php if(0 == $rsInfo['hid']):?>
					<option value="">请选择</option>
				<?php endif;?>
				<?php foreach ($host as $item):?>
					<?php if($item['id'] == $rsInfo['hid']):?>
						<option value="<?php echo $item['id']?>" selected><?php echo $item['ip'];?></option>
					<?php else:?>
						<option value="<?php echo $item['id']?>"><?php echo $item['ip'];?></option>
					<?php endif;?>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站数据库:</label>
			<select name="data">
				<?php if(0 == $rsInfo['dbid']):?>
					<option value="">请选择</option>
				<?php endif;?>
				<?php foreach ($data as $item):?>
					<?php if($item['id'] == $rsInfo['dbid']):?>
						<option value="<?php echo $item['id']?>" selected><?php echo $item['name'];?></option>
					<?php else:?>
						<option value="<?php echo $item['id']?>"><?php echo $item['name'];?></option>
					<?php endif;?>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<label>网站邮箱:</label>
			<select name="email">
				<?php if(0 == $rsInfo['eid']):?>
					<option value="">请选择</option>
				<?php endif;?>
				<?php foreach ($email as $item):?>
					<?php if($item['id'] == $rsInfo['eid']):?>
						<option value="<?php echo $item['id']?>" selected><?php echo $item['name'];?></option>
					<?php else:?>
						<option value="<?php echo $item['id']?>"><?php echo $item['name'];?></option>
					<?php endif;?>
				<?php endforeach;?>
			</select>
			</td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $rsInfo['sid']; ?>"/>
		<input type="hidden" name="oldname" value="<?php echo $rsInfo['name']; ?>"/>
		<tr>
			<td><input type="submit" name="rsubmit" value="修改 " class="buttons_a"/></td>
		</tr>
	</table>
</form>