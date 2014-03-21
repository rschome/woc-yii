<?php
/**
 * 分类管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class TypeController extends Controller {

	public $layout='column2';
	private $_model;

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

	public function actionIndex() {
		$this->redirect(array('list'));
	}
	
	public function actionList(){
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$list = array();
		$criteria=new CDbCriteria(array(
			'order'=>'id ASC'
		));
		$types = new Type();
        $count = $types->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $types->findAll($criteria);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','pages'=>$pager,'list'=>$list));
	}
	
	public function actionAdd() {
		$msgPT = "";
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
			$name = trim($request->getPost('name'));
			if($name == ""){
				$msgPT = "分类名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgPT = "输入不能大于64个字符";
			}
			if($msgPT == ""){
				$uid = rand(1,999999*microtime());
				$pro = array(
					'tid'  => $uid,
					'name' => $name
				);
				try{
					$rt = new Type();
					$rt->_attributes = $pro;
					$rt->insert();
					$this->redirect(array('list'));
				}catch (Exception $re){
					throw Exception($re);
				}
			}
		}
		try{
			$rs = new Site();
		}catch(Exception $e){
			throw Exception($e);
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rs'=>$rs,
			'msgPT'=>$msgPT
        ));
	}
	
	public function actionEdit(){
		$msgPT = "";
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$name = trim($request->getPost('name'));
			if($name == ""){
				$msgPT = "分类名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgPT = "输入不能大于64个字符";
			}
			if($msgPT == ""){		
				$pt = array(
					'name' => $name
				);
				try{
					$rt = new Type();
					$rt = $rt->find('tid=:tid',array(':tid'=>$id));
					$rt->_attributes = $pt;
					$rt->setIsNewRecord(false);
					$rt->update();
					$this->redirect(array('list'));
				}catch (Exception $re){
					throw Exception($re);
				}
			}
		}
		try{
			$rs = new Type();
			$rsInfo = $rs->find('tid=:tid',array(':tid'=>$id));
		}catch(Exception $e){
			throw Exception($e);
		}
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rsInfo'=>$rsInfo,
			'msgPT'=>$msgPT
        ));
	}
	
	public function actionDelete(){
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$rs = new Type();
				$row = $rs->find('tid=:tid',array(':tid'=>$id));
				$row->delete();
				$this->redirect(array('list'));
			}catch (Exception $e){
				throw Exception($e);
			}
		}
	}
}

?>
