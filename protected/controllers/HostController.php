<?php
/**
 * 主机管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class HostController extends Controller {

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
		
	public function actionIndex(){
		$this->redirect(array('list'));
	}
	
	public function actionList() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$list = array();
		$criteria=new CDbCriteria(array(
			'order'=>'id ASC'
		));
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if ($id) $criteria->addCondition("id = $id");
		$hosts = new Host();
        $count = $hosts->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $hosts->findAll($criteria);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','pages'=>$pager,'list'=>$list));
	}

	public function actionAdd() {
		$msgHost = "";
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
			$ip = trim($request->getPost("ip"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$provider = trim($request->getPost("provider"));
			$status = trim($request->getPost("status"));
			if($ip == ""){
				$msgHost = "主机IP选项不能留空";
			}else if(strlen($ip)> 64){
				$msgHost = "输入不能大于64个字符";
			}
			if($msgHost == ""){
				$host = array(
					'ip' => $ip,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'provider' => $provider,
					'status' => $status
				);
				try{
					$res = new Host();
					$res->_attributes = $host;
					$res->insert();
					$this->redirect(array('list'));
				}catch (CDbException $re){
					throw CDbException($re);
				}
			}
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'msgHost'=>$msgHost
        ));
	}
	
	public function actionEdit() {
		$msgHost = "";
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$ip = trim($request->getPost("ip"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$provider = trim($request->getPost("provider"));
			$status = trim($request->getPost("status"));
			if($ip == ""){
				$msgHost = "主机IP选项不能留空";
			}else if(strlen($ip) > 64){
				$msgHost = "输入不能大于64个字符";
			}
			if($msgHost == ""){
				$host = array('ip'=>$ip,'admin' => $admin,'username' => $username,'password' => $password,'provider' => $provider,'status' => $status);
				try{
					$res = new Host();
					$res->_pk = $id;
					$res->_attributes = $host;
					$res->setIsNewRecord(false);
					$res->update();
					$this->redirect(array('list'));
				}catch (CDbException $e){
					throw CDbException($e);
				}
			}
		}
		try{
			$Rs = new Host();
			$rsInfo=$Rs->findByPk($id);
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rsInfo'=>$rsInfo,
			'msgHost'=>$msgHost
        ));
	}

	public function actionDelete() { 
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$res = new Host();
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
