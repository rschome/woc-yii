<?php

/**
 * Default Layout
 *  
 * @author   yjzzj.com
 * @version  1.1
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/yahoo-dom-event.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/yahoo.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/event.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/connection.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/json.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/jquery.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/layer.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/TableSorter.js"></script>
	<script language="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/skin/js/viewNote.js"></script>
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/skin/style/css.css">
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/skin/style/style.css">
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/skin/style/web.css">
</head>
<body>
<div id="mask"></div>
<div id="append_parent"></div>
<div id="float_window"></div>
<div id="header">
	  <h1 class="logo"><a href="<?php echo Yii::app()->request->baseUrl; ?>">logo</a></h1>
	  <ul class="header_right">
	   <li>Logged in as <?php echo Yii::app()->user->name; ?></li>
	   <li><?php echo date("l ,F j, Y");?></li>
	   <li class="logOut"><a href="<?php echo Yii::app()->request->baseUrl; ?>/auth/logout">logOut</a></li>
	  </ul>
</div>  
<div class="messageBox">
<div id="_x"></div>
</div>
<div id="pg_margins">
<div id="col1"><?php $this->widget('Sidebar'); ?></div>
<div id="col2"><?php echo $content; ?></div>			
</div>
<div class="ft-bg2">&nbsp;</div>
<div id="footad" style="width:960px;margin:0 auto;"><script type="text/javascript">/*960*90£¬´´½¨ÓÚ2012-7-15*/ var cpro_id = \'u983772\';</script><script src="http://cpro.baidu.com/cpro/ui/c.js" type="text/javascript"></script></div>
<div id="footer"> <b class="c_spot">WOC</b> Website Operations Center Version 1.0( <a href="http://www.yjzzj.com" target="_blank"><b class="c_spot">YJZZJ.COM</b></a> )</div>
</body>
</html>

