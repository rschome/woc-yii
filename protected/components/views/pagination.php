<?php if ($pager->getPageCount()): ?>
<div class="vpager">
<ul class="pager">
<li><label>当前页:</label><?php echo $current;?></li>
<li><label>总记录:</label><?php echo $pager->getItemCount();?></li>
<li><label>总页数:</label><?php echo $pager->getPageCount();?></li>
<!-- Previous page link -->
<?php if (isset($previous)): ?>  
<li><a href="<?php echo $previous; ?>">    &lt; Previous  </a></li>
<?php else: ?>  
<li class="prev">&lt; Previous</li>
<?php endif; ?>
<!-- Numbered page links -->
<?php foreach ($pages as $key => $page): ?>  
<?php if ($page != $current): ?>    
<li><a href="<?php echo $purls[$key]; ?>"><?php echo $page; ?></a></li>
<?php else: ?>
<li  class="active"> <?php echo $page; ?> </li>
<?php endif; ?>
<?php endforeach; ?>
<!-- Next page link -->
<?php if (isset($next)): ?> <li class="next"> <a href="<?php echo $next; ?>">    Next &gt;  </a></li>
<?php else: ?>  
<li>Next &gt;</li>
<?php endif; ?>
</ul>
</div>
<?php endif; ?>

 