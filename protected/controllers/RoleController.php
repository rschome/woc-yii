<?php
/**
 * 角色管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class RoleController extends Controller {

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

	public function actionIndex()
	{
		$this->redirect(array('list'));
	}
	
	public function actionList(){
		$page = isset($_GET['id']) ? intval($_GET['id']) : 1;
		$list = array();
		$criteria=new CDbCriteria(array(
			'order'=>'id ASC'
		));
		$roles = new Role();
        $count = $roles->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $roles->findAll($criteria);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','pages'=>$pager,'list'=>$list));
	}
	
	public function actionAdd() {
		$msgRole = "";
		$request = Yii::app()->getRequest();
		$str_res = "";
		if(!empty($_POST)) {
			$name = trim($request->getPost('name'));
			$res = trim($request->getPost('resource'));
			if($name == ""){
				$msgRole = "角色名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgRole = "输入不能大于64个字符";
			}
			if($res == "0"){
				$str_res = $res;
			}else{
				$res_detail = $request->getPost('role');
				$str_res = implode(",",$res_detail);
			}
			if($msgRole == ""){
				$uid = rand(1,999999*microtime());
				$role = array(
					'rid'  => $uid,
					'name' => $name
				);
				$permission = array(
					'rid'  => $uid,
					'perm' => $str_res
				);
				try{
					$rl = new Role();
					$rl->_attributes = $role;
					$rl->insert();
					$perm = new Permission();
					$perm->_attributes = $permission;
					$perm->insert();
					$this->redirect(array('list'));
				}catch (CDbException $re){
					throw CDbException($re);
				}
			}
		}
		try{
			$func = new Func();
			$rs = $func->findAll();
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rs'=>$rs,
			'msgRole'=>$msgRole
        ));
	}
	
	public function actionEdit(){
		$msgRole = "";
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$name = trim($request->getPost('name'));
			$r_isall = trim($request->getPost('resource'));
			if($name == ""){
				$msgRole = "角色名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgRole = "输入不能大于64个字符";
			}
			if($r_isall == "0"){
				$str_res = $r_isall;
			}else{
				$res_detail = $request->getPost('role');
				$str_res = implode(",",$res_detail);
			}
			if($msgRole == ""){
				$uid = rand(1,999999*microtime());
				$role = array(
					'rid'  => $uid,
					'name' => $name
				);
				$permission = array(
					'rid'  => $uid,
					'perm' => $str_res
				);
				try{
					$perm = new Permission();
					$perm = $perm->find('rid=:rid',array(':rid'=>$id));
					$perm->_attributes = $permission;
					$perm->setIsNewRecord(false);
					$perm->update();
					$rl = new Role();
					$rl = $rl->find('rid=:rid',array(':rid'=>$id));
					$rl->_attributes = $role;
					$rl->setIsNewRecord(false);
					$rl->update();
					$this->redirect(array('list'));
				}catch (CDbException $re){
					throw CDbException($re);
				}
			}
		}
		try{
			$rs = new Role();
			$rsInfo = $rs->find('rid=:rid', array(':rid'=>$id));
			$func = new Func();
			$res = $func->findAll();
			$perm = new Permission();
			$permInfo = $perm->find('rid=:rid', array(':rid'=>$id));
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rsInfo'=>$rsInfo,
			'res'=>$res,
			'permInfo'=>$permInfo,
			'msgRole'=>$msgRole
        ));
	}
	
	public function actionDelete(){
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$rs = new Role();
				$rrow = $rs->find('rid=:rid', array(':rid'=>$id));
				$rrow->delete();
				$pm = new Permission();
				$prow = $pm->find('rid=:rid', array(':rid'=>$id));
				$prow->delete();
				$this->redirect(array('list'));	
			}catch (CDbException $e){
				throw CDbException($e);
			}
		}
	}
}

?>
