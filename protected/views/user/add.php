 <div class="location">用户添加</div>
<form action="<?php echo $r; ?>user/add" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>
			<td><label>用户名称:</label></td><td><input type="text" name="name" class="ipt_m" value="<?php echo $name;?>" size="18"/></td><td><?php echo $msgName;?></td>
		</tr>
		<tr>
			<td><label>密码:</label></td><td><input type="password" name="pass" class="ipt_m" value="" size="18"/></td><td><?php echo $msgPass;?></td>
		</tr>
		<tr>
			<td><label>重复密码:</label></td><td><input type="password" name="repass" class="ipt_m" value="" size="18"/></td><td><?php echo $msgRepass;?></td>
		</tr>
		<tr>
			<td><label>电子邮箱:</label></td><td><input type="text" name="email"  class="ipt_m" value="<?php echo $email;?>" size="18"/></td><td><?php echo $msgEmail;?></td>
		</tr>
		<tr>
			<td><label>联系电话:</label></td>
			<td>
				<input type="text" name="tel" class="ipt_m" value="<?php echo $tel;?>" size="18"/></td>
			
			<td><?php echo $msgTelephone;?></td>
		</tr>
		<tr>
			<td><label>状态:</label></td>
			<td>
				<input type="radio" name="status" id="status0" value="0"/><label for="status0">禁用</label><input type="radio" name="status" id="status1" value="1" checked/><label for="status1">开启</label>
			</td><td></td>
		</tr>
		<tr>
			<td><label>所属角色:</label></td>
			<td>
				<select name="role">

					<?php foreach ($rs as $item):?>
						<option value="<?php echo $item['name']?>|<?php echo $item['rid']?>"><?php echo $item['name']?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td></td>
		</tr>
		<tr>
			<td><label>所属产品:</label></td>
			<td>
				<select name="product">
					<option value="All Product|0">全部</option>
					<?php foreach ($pt as $item):?>
						<option value="<?php echo $item['name']?>|<?php echo $item['tid']?>"><?php echo $item['name']?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" name="rsubmit" value="添加" class="buttons_a"/></td>
		</tr>
	
	</table>
</form>