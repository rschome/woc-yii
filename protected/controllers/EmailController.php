<?php
/**
 * 邮箱管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class EmailController extends Controller {

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
		$emails = new Email();
        $count = $emails->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $emails->findAll($criteria);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','pages'=>$pager,'list'=>$list));
	}

	public function actionAdd() {
		$msgEmail = "";
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
			$name = trim($request->getPost("name"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$provider = trim($request->getPost("provider"));
			$status = trim($request->getPost("status"));
			
			$validate=new CEmailValidator;
			if($name == ""){
				$msgEmail = "邮箱名称选项不能留空";
			}else if(strlen($name) > 64){
				$msgEmail = "输入不能大于64个字符";
			}else if(!$validate->validateValue($name)){
				$msgEmail = "请输入合法的电子邮箱";
			}
			
			if($msgEmail == ""){
				$email = array(
					'name' => $name,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'provider' => $provider,
					'status' => $status
				);
				try{
					$res = new Email();
					$res->_attributes = $email;
					$res->insert();
					$this->redirect(array('list'));
				}catch (CDbException $re){
					throw CDbException($re);
				}
			}
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'msgEmail'=>$msgEmail
        ));
	}
	
	public function actionEdit() {
		$msgEmail = "";
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$name = trim($request->getPost("name"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$provider = trim($request->getPost("provider"));
			$status = trim($request->getPost("status"));
			
			$validate=new CEmailValidator;
			if($name == ""){
				$msgEmail = "邮箱名称选项不能留空";
			}else if(strlen($name) > 64){
				$msgEmail = "输入不能大于64个字符";
			}else if(!$validate->validateValue($name)){
				$msgEmail = "请输入合法的电子邮箱";
			}
			
			if($msgEmail == ""){
				$email = array('name'=>$name,'admin' => $admin,'username' => $username,'password' => $password,'provider' => $provider,'status' => $status);
				try{
					$res = new Email();
					$res->_pk = $id;
					$res->_attributes = $email;
					$res->setIsNewRecord(false);
					$res->update();
					$this->redirect(array('list'));
				}catch (CDbException $e){
					throw CDbException($e);
				}
			}
		}
		try{
			$Rs = new Email();
			$rsInfo=$Rs->findByPk($id);
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rsInfo'=>$rsInfo,
			'msgEmail'=>$msgEmail
        ));
	}

	public function actionDelete() { 
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$res = new Email();
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
