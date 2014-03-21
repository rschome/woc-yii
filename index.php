<?php

// change the following paths if necessary
set_include_path('./library' . PATH_SEPARATOR . get_include_path());
ini_set('display_errors', 1);
error_reporting(E_ALL);
$yii=dirname(__FILE__).'/library/Yii/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();

?>