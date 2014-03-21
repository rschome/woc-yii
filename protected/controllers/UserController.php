<?php
/**
 * 用户管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class UserController extends Controller {

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
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$list = array();
		$criteria=new CDbCriteria(array(
			'order'=>'uid ASC'
		));
		$users = new User();
        $count = $users->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $users->findAll($criteria);
        $this->render('list',array('r'=>Yii::app()->request->baseUrl.'/','pages'=>$pager,'list'=>$list));
	}
	
	public function actionAdd(){
		$name = "";
		$email = "";
		$tel = "";
		$msgName = "";
		$msgPass = "";
		$msgRepass = "";
		$msgEmail = "";
		$msgTelephone = "";
		$request = Yii::app()->getRequest();
		if(!empty($_POST)) {
			$name = trim($request->getPost('name'));
			$pass = trim($request->getPost('pass'));
			$repass = trim($request->getPost('repass'));
			$email = trim($request->getPost('email'));
			$tel = trim($request->getPost('tel'));
			$status = trim($request->getPost('status'));
			$role = trim($request->getPost('role'));
			$pduct = trim($request->getPost('product'));
			if($name == ""){
				$msgName = "用户名称选项不能留空";
			}else if(strlen($name) > 64){
				$msgName = "输入字符不要大于64位";
			}
			if($pass == ""){
				$msgPass = "密码选项不能留空";
			}else if(strlen($pass) < 6){
				$msgPass = "密码太短";
			}
			if($repass <> $pass){
				$msgRepass ="两次密码输入不一致";
			}
			$validate=new CEmailValidator;
			if($email == ""){
				$msgEmail = "电子邮箱选项不能留空";
			}else if(!$validate->validateValue($email)){
				$msgEmail = "请输入合法的电子邮箱";
			}else if(strlen($email) >64){
				$msgEmail ="输入字符不要大于64位";
			}
			if($tel == ""){
				$msgTelephone = "联系电话选项不能留空";
			}else if (strlen($tel) >20){
				$msgTelephone = "输入字符不要大于20位";
			}
			if($msgName == "" && $msgPass == "" && $msgRepass == "" && $msgEmail == "" && $msgTelephone == ""){
				$arr_role = explode('|',$role);
				$arr_product = explode('|',$pduct);
				$ptid = $arr_product[1];
				$pname = $arr_product[0];
				$rid = $arr_role[1];
				$rname = $arr_role[0];
				$arr_user = array(
					'name' => $name,
					'pass' => md5($pass),
					'email' => $email,
					'telphone' => $tel,
					'status' => $status,
					'created' => time(),
					'access' =>time(),
					'login' =>time(),
					'ip' =>$_SERVER['REMOTE_ADDR'],
					'rid' => $rid,
					'rname' => $rname,
					'ptid' => $ptid,
					'pname' => $pname
				);
				try{
					$user = new User();
					$user->_attributes = $arr_user;
					$user->insert();
					$this->redirect(array('list'));
				}catch (CDbException $e){
					throw CDbException($e);
				}
			}
		}
		try{
			$rs = new Role();
			$rs = $rs->findAll();
			$product = new Type();
			$pt = $product->findAll();
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rs'=>$rs,
			'pt'=>$pt,
			'name'=>$name,
			'email'=>$email,
			'tel'=>$tel,
			'msgName'=>$msgName,
			'msgPass'=>$msgPass,
			'msgRepass'=>$msgRepass,
			'msgEmail'=>$msgEmail,
			'msgTelephone'=>$msgTelephone
        ));
	}
	
	public function actionEdit(){
		$msgName = "";
		$msgPass = "";
		$msgRepass = "";
		$msgEmail = "";
		$msgTelephone = "";
		$request = Yii::app()->getRequest();
		$uid = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$name = trim($request->getPost('name'));
			$pass = trim($request->getPost('pass'));
			$repass = trim($request->getPost('repass'));
			$email = trim($request->getPost('email'));
			$tel = trim($request->getPost('tel'));
			$status = trim($request->getPost('status'));
			$role = trim($request->getPost('role'));
			$pduct = trim($request->getPost('product'));
			if($name == ""){
				$msgName = "用户名称选项不能留空";
			}else if(strlen($name) > 64){
				$msgName = "输入字符不要大于64位";
			}
			if($pass == ""){
				$msgPass = "密码选项不能留空";
			}else if(strlen($pass) < 6){
				$msgPass = "密码太短";
			}
			if($repass <> $pass){
				$msgRepass ="两次密码输入不一致";
			}
			$validate=new CEmailValidator;
			if($email == ""){
				$msgEmail = "电子邮箱选项不能留空";
			}else if(!$validate->validateValue($email)){
				$msgEmail = "请输入合法的电子邮箱";
			}else if(strlen($email) >64){
				$msgEmail ="输入字符不要大于64位";
			}
			if($tel == ""){
				$msgTelephone = "联系电话选项不能留空";
			}else if (strlen($tel) >20){
				$msgTelephone = "输入字符不要大于20位";
			}
			if($msgName == "" && $msgPass == "" && $msgRepass == "" && $msgEmail == "" && $msgTelephone == ""){
				$arr_role = explode('|',$role);
				$arr_product = explode('|',$pduct);
				$ptid = $arr_product[1];
				$pname = $arr_product[0];
				$rid = $arr_role[1];
				$rname = $arr_role[0];
				$arr_user = array(
					'name' => $name,
					'email' => $email,
					'telphone' => $tel,
					'status' => $status,
					'created' => time(),
					'access' =>time(),
					'login' =>time(),
					'ip' =>$_SERVER['REMOTE_ADDR'],
					'rid' => $rid,
					'rname' => $rname,
					'ptid' => $ptid,
					'pname' => $pname
				);
				if($pass != ""){
					$arr_user['pass'] = md5($pass);
				}
				try{
					$user = new User();
					$user=$user->findByPk($uid);
					$user->_attributes = $arr_user;
					$user->setIsNewRecord(false);
					$user->update();
					$this->redirect(array('list'));
				}catch (CDbException $e){
					throw CDbException($e);
				}
			}
		}
		try{
			$role = new Role();
			$rs = $role->findAll();
			$product = new Type();
			$pt = $product->findAll();
			$user = new User();
			$usr=$user->findByPk($uid);
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'rs'=>$rs,
			'pt'=>$pt,
			'usr'=>$usr,
			'msgName'=>$msgName,
			'msgPass'=>$msgPass,
			'msgRepass'=>$msgRepass,
			'msgEmail'=>$msgEmail,
			'msgTelephone'=>$msgTelephone
        ));
	}
	
	public function actionDelete(){
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$rs = new User();
				$row = $rs->findByPk($id);
				$row->delete();
				$this->redirect(array('list'));
			}catch(CDbException $e){
				throw CDbException($e);
			}
		}		
	}
}

?>
