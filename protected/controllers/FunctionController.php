<?php
/**
 * 功能管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class FunctionController extends Controller {

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
	
	public function actionList() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$list = array();
		$criteria=new CDbCriteria(array(
			'order'=>'id ASC'
		));
		$funcs = new Func();
        $count = $funcs->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $funcs->findAll($criteria);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','pages'=>$pager,'list'=>$list));
	}
	
	public function actionAdd() {
		$msgFunction = "";
		$request = Yii::app()->getRequest();
		if(!empty($_POST)) {
			$name = trim($request->getPost("name"));
			$controller = trim($request->getPost("controller"));
			if($name == ""){
				$msgFunction = "功能名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgFunction = "输入不能大于64个字符";
			}else if($controller == ""){
				$msgFunction = "控制器选项不能留空";
			}
			if($msgFunction == ""){
				$function = array(
					'name' => $name,
					'controller'=>$controller
				);
				try{
					$res = new Func();
					$res->_attributes = $function;
					$res->insert();
					$this->redirect(array('list'));
				}catch (CDbException $re){
					throw CDbException($re);
				}
			}
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'msgFunction'=>$msgFunction
        ));
	}
	
	public function actionEdit() {
		$msgFunction = "";
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$name = trim($request->getPost("name"));
			$controller = trim($request->getPost("controller"));
			if($name == ""){
				$msgFunction = "功能名称选项不能留空";
			}else if(strlen($name) > 64){
				$msgFunction = "输入不能大于64个字符";
			}else if($controller == ""){
				$msgFunction = "控制器选项不能留空";
			}
			if($msgFunction == ""){
				$func = array('name'=>$name, 'controller'=>$controller);
				try{
					$res = new Func();
					$res=$res->findByPk($id);
					$res->_attributes = $func;
					$res->setIsNewRecord(false);
					$res->update();
					$this->redirect(array('list'));
				}catch (CDbException $e){
					throw CDbException($e);
				}
			}
		}
		try{
			$Rs = new Func();
			$RsInfo= $Rs->FunctionInfo($id);
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'RsInfo'=>$RsInfo,
			'msgFunction'=>$msgFunction
        ));
	}

	public function actionDelete() { 
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$res = new Func();
				$row = $res->findByPk($id);
				$row->delete();
				$this->redirect(array('list'));
			}catch (CDbException $e){
				throw CDbException($e);
			}
		}
	}
}

?>
