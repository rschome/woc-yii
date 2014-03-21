<?php
/**
 * 域名管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class DomainController extends Controller {

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
		$domains = new Domain();
        $count = $domains->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $domains->findAll($criteria);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','pages'=>$pager,'list'=>$list));
	}

	public function actionAdd() {
		$msgDomain = "";
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
			$name = trim($request->getPost("name"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$provider = trim($request->getPost("provider"));
			$status = trim($request->getPost("status"));

			if($name == ""){
				$msgDomain = "域名名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgDomain = "输入不能大于64个字符";
			}

			if($msgDomain == ""){
				$domain = array(
					'name' => $name,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'provider' => $provider,
					'status' => $status
				);
				try{
					$res = new Domain();
					$res->_attributes = $domain;
					$res->insert();
					$this->redirect(array('list'));
				}catch (CDbException $re){
					throw CDbException($re);
				}
			}
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'msgDomain'=>$msgDomain
        ));
	}
	
	public function actionEdit() {
		$msgDomain = "";
		$rsInfo = "";
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$name = trim($request->getPost("name"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$provider = trim($request->getPost("provider"));
			$status = trim($request->getPost("status"));
			
			if($name == ""){
				$msgDomain = "域名名称选项不能留空";
			}else if(strlen($name) > 64){
				$msgDomain = "输入不能大于64个字符";
			}
			
			if($msgDomain == ""){
				$domain = array('name'=>$name,'admin' => $admin,'username' => $username,'password' => $password,'provider' => $provider,'status' => $status);
				try{
					$res = new Domain();
					$res->_pk = $id;
					$res->_attributes = $domain;
					$res->setIsNewRecord(false);
					$res->update();
					$this->redirect(array('list'));
				}catch (CDbException $e){
					throw CDbException($e);
				}
			}
		}
        try{
			$Rs = new Domain();
			$rsInfo=$Rs->findByPk($id);
        }catch(CDbException $e){
			throw CDbException($e);
        }
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rsInfo'=>$rsInfo,
			'msgDomain'=>$msgDomain
        ));
	}

	public function actionDelete() { 
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$res = new Domain();
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
