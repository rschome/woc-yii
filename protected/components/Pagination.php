<?php
/**
 * 分页公共部件
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */ 
	
class Pagination extends CWidget {
   public $pages;

   public function run() {
	   $page_arr = $purl_arr =array();
	   $current = $this->pages->getCurrentPage()+1;
	   $total = $this->pages->getPageCount();
	   $previous = ($current > 1) ? ($current-1) : 1;
	   $next = ($current < $total) ? ($current+1) : $total;
	   for ($i=0; $i<$total; $i++) {
		   $page_arr[] = $i+1;
		   $purl_arr[] = $this->url($i+1);
	   }
	   $this->render('pagination',array(
		     'pager' => $this->pages,
		     'pages' => $page_arr,
		     'purls' => $purl_arr,
		     'current' => $current,
		     'previous' => $this->url($previous),
		     'next' => $this->url($next)
	   ));
   }

   public function url($page) { 
	   return Yii::app()->getController()->createUrl(Yii::app()->getController()->getAction()->id, array('page'=>$page));
   }
}

?>
