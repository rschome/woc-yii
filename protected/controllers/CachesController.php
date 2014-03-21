<?php
/**
 * 缓存管理
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class CachesController extends Controller {

	public $layout='column2';
	private $_model;
	private $cache_dir;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
		
	public function actionIndex(){
		$this->redirect(array('list'));
	}
	
	public function actionList() {
		$request = Yii::app()->getRequest();
		$ctype = $request->getParam("ctype") ? $request->getParam("ctype") : "zend";
		$key = 0;
		$caches = array();
		if ($ctype=='zend') $this->cache_dir = "protected/runtime/";
		else $this->cache_dir = "protected/runtime/";
		$cache_handle = opendir($this->cache_dir);
		while (($cache_file = readdir($cache_handle)) !== false) {
			if ($cache_file !== '.' && $cache_file !== '..') {
				$caches[$key]['fname'] = $cache_file;
				if ($ctype=='zend') $caches[$key]['ftime'] = date("Y-m-d H:i:s", filemtime($this->cache_dir.$cache_file));
				else $caches[$key]['ftime'] = 'N/A';
				if ($ctype=='zend') $caches[$key]['fsize'] = filesize($this->cache_dir.$cache_file);
				else $caches[$key]['fsize'] = 'N/A';
				$key++;
			}
		}
		closedir($cache_handle);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','caches'=>$caches));
	}

	public function actionClear() {
		$request = Yii::app()->getRequest();
		$ctype = $request->getParam("ctype") ? $request->getParam("ctype") : "zend";
		try{
			if ($ctype=='zend') $this->cache_dir = "protected/runtime/";
			else $this->cache_dir = "protected/runtime/";
			$this->delDir($this->cache_dir);
			$this->redirect(array('list'));
		}catch (Exception $e){
			echo 'Clear Cache Error!';
		}
	}

	private function delDir($cache_dir) {
		$cache_handle = opendir($cache_dir);
		while (($cache_file = readdir($cache_handle)) !== false) {
			if ($cache_file <> '.' && $cache_file <> '..') {
				$fullpath=$cache_dir.'/'.$cache_file;
				if (!is_dir($fullpath)) unlink($fullpath);
				else $this->delDir($fullpath);
			}
		}
		closedir($cache_handle);
		if($cache_dir <> $this->cache_dir){
			if(rmdir($cache_dir)) return true;
			else return false;
		}
	}
}
