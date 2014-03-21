
<div class="tabs_menu">

	<h3>运营管理</h3>
	<?php if($permission['perm']):?>
	<ul>
		<?php if(preg_match("/site/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/" <?php if (isset($site)) echo $site;?>>网站管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/domain/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/domain/" <?php if (isset($domain)) echo $domain;?>>域名管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/host/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/host/" <?php if (isset($host)) echo $host;?>>主机管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/data/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/data/" <?php if (isset($data)) echo $data;?>>数据管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/email/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/email/" <?php if (isset($email)) echo $email;?>>邮箱管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/seo/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/seo/" <?php if (isset($seo)) echo $seo;?>>SEO管理</a></li>
		<?php endif;?>
	</ul>
	<?php else:?>
	<ul>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/" <?php if (isset($site)) echo $site;?>>网站管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/domain/" <?php if (isset($domain)) echo $domain;?>>域名管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/host/" <?php if (isset($host)) echo $host;?>>主机管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/data/" <?php if (isset($data)) echo $data;?>>数据管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/email/" <?php if (isset($email)) echo $email;?>>邮箱管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/seo/" <?php if (isset($seo)) echo $seo;?>>SEO管理</a></li>
	</ul>
	<?php endif;?>

	<h3>系统管理</h3>
	<?php if($permission['perm']):?>
	<ul>
		<?php if(preg_match("/user/",$permission['perm'])):?>		
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/" <?php if (isset($user)) echo $user;?>>用户管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/role/",$permission['perm'])):?>	
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/role/" <?php if (isset($role)) echo $role?>>角色管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/type/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/type/" <?php if (isset($type)) echo $type;?>>分类管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/function/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/function/" <?php if (isset($function)) echo $function;?>>功能管理</a></li>
		<?php endif;?>
		<?php if(preg_match("/caches/",$permission['perm'])):?>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/caches/" <?php if (isset($caches)) echo $caches;?>>缓存管理</a></li>
		<?php endif;?>
	</ul>
	<?php else:?>
	<ul>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/" <?php if (isset($user)) echo $user;?>>用户管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/role/" <?php if (isset($role)) echo $role?>>角色管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/type/" <?php if (isset($type)) echo $type;?>>分类管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/function/" <?php if (isset($function)) echo $function;?>>功能管理</a></li>
			<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/caches/" <?php if (isset($caches)) echo $caches;?>>缓存管理</a></li>
	</ul>
	<?php endif;?>

</div>