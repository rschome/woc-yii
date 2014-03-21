 <div class="location">修改用户</div>
<form action="<?php echo $r; ?>user/edit" method="post" name="addform">
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr>

			<td><label>用户名称:</label></td><td><input type="text" name="name" class="ipt_m" value="<?php echo $usr['name'];?>" size="18"/></td><td><?php echo $msgName;?></td>
		</tr>
		<tr>
			<td><label>密码:</label></td><td><input type="password" name="pass" class="ipt_m" value="" size="18"/></td><td><?php echo $msgPass;?></td>
		</tr>
		<tr>
			<td><label>重复密码:</label></td><td><input type="password" name="repass" class="ipt_m" value="" size="18"/></td><td><?php echo $msgRepass;?></td>
		</tr>
		<tr>
			<td><label>电子邮箱:</label></td><td><input type="text" name="email" class="ipt_m" value="<?php echo $usr['email'];?>" size="18"/></td><td><?php echo $msgEmail;?></td>
		</tr>
		<tr>
			<td><label>联系电话:</label></td>
			<td>
				<input type="text" name="tel" class="ipt_m" value="<?php echo $usr['telphone'];?>" size="18"/></td>
			
			<td><?php echo $msgTelephone;?></td>
		</tr>
		<tr>
			<td><label>状态:</label></td>
			<td>
				<?php if($usr['status'] == "0"):?>
					<input type="radio" name="status" id="status0" value="0" checked/><label for="status0">禁用</label><input type="radio" name="status" id="status1" value="1" /><label for="status1">开启</label>
				<?php else:?>
					<input type="radio" name="status" id="status0" value="0" /><label for="status0">禁用</label><input type="radio" name="status" id="status1" value="1" checked/><label for="status1">开启</label>			
				<?php endif;?>
			</td><td></td>
		</tr>
		<tr>
			<td><label>所属角色:</label></td>
			<td>
				<select name="role">

					<?php foreach ($rs as $item):?>
						<?php if($usr['rid'] == $item['rid']){?>
							<option value="<?php echo $item['name']?>|<?php echo $item['rid']?>" selected><?php echo $item['name']?></option>
						<?php }else{?>
							<option value="<?php echo $item['name']?>|<?php echo $item['rid']?>" ><?php echo $item['name']?></option>
						<?php }?>
					<?php endforeach;?>
				</select>
			</td>
			<td></td>
		</tr>
		<tr>
			<td><label>所属产品:</label></td>
			<td>
				<select name="product">
					<?php if($usr['ptid'] == 0):?>
						<option value="All Product|0" selected>全部</option>
					<?php else:?>
						<option value="All Product|0" >All Product</option>
					<?php endif;?>
					<?php foreach ($pt as $item):?>
						<?php if($usr['ptid'] == $item['tid']){?>
							<option value="<?php echo $item['name']?>|<?php echo $item['tid']?>" selected><?php echo $item['name']?></option>
						<?php }else{?>
							<option value="<?php echo $item['name']?>|<?php echo $item['tid']?>" ><?php echo $item['name']?></option>
						<?php }?>
					<?php endforeach;?>
				</select>
			</td>
			<td></td>
		</tr>
		<input type="hidden" name="id" value="<?php echo $usr['uid'];?>"/>
		<tr>
			<td colspan="3"><input type="submit" name="rsubmit" value="修改" class="buttons_a"/></td>
		</tr>
	
	</table>
</form>