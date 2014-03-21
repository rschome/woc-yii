
<div class="location">SEO管理</div>

<div class="massaction"></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>网站名称</td>
		<td>ALEXA排名</td>
		<td>百度索引数</td>
		<td>谷歌索引数</td>
		<td>谷歌PR值</td>
		<td>操作</td>
	</tr>
<?php $i=0;?>
<?php foreach($list as $key=>$item):?>
<?php if($i%2 == 0):?>
	<tr bgcolor="#F6F6F6">
		<td><a target="_self" href="<?php echo $r; ?>site/list/id/<?php echo $item['sid'] ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $seo[$key]['alexa'] ? $seo[$key]['alexa'] : '--' ?></td>
		<td><?php echo $seo[$key]['baidu'] ? $seo[$key]['baidu'] : '--' ?></td>
		<td><?php echo $seo[$key]['google'] ? $seo[$key]['google'] : '--' ?></td>
		<td><?php echo $seo[$key]['pr'] ? $seo[$key]['pr'] : '--' ?></td>
		<td>
		<a href="<?php echo $r; ?>seo/refresh/sid/<?php echo $item['sid'] ?>">刷新</a>
		</td>
	</tr>
<?php else:?>
	<tr>
		<td><a target="_self" href="<?php echo $r; ?>site/list/id/<?php echo $item['sid'] ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $seo[$key]['alexa'] ? $seo[$key]['alexa'] : '--' ?></td>
		<td><?php echo $seo[$key]['baidu'] ? $seo[$key]['baidu'] : '--' ?></td>
		<td><?php echo $seo[$key]['google'] ? $seo[$key]['google'] : '--' ?></td>
		<td><?php echo $seo[$key]['pr'] ? $seo[$key]['pr'] : '--' ?></td>
		<td>
		<a href="<?php echo $r; ?>seo/refresh/sid/<?php echo $item['sid'] ?>">刷新</a>
		</td>
	</tr>
<?php endif;?>
	<?php $i++;?>
<?php endforeach;?>
	<tr>
		<td colspan="6" align="right"><?php $this->widget('Pagination', array('pages' => $pages)); ?></td>
	</tr>
</table>