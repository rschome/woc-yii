<?php
/**
 * 登录认证（注意继承CController）
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class AuthController extends CController {

	public $layout='column1';
	private $_model;

	public function actionIndex(){
		$this->redirect(array('login'));
	}
	
	public function actionLogin(){
		$str_name = "";
		$msgName = "";
		$msgPass = "";
		$msgError = "";
		if(!empty($_POST)) {
			$str_name = trim($_POST['name']);
			$str_password = trim($_POST['password']);
			if($str_name == ""){
				$msgName = "必填选项不能留空";
			}
			if($msgName == ""){
				if($str_password == ""){
					$msgPass = "必填选项不能留空";
				}
			}
			if($msgName == "" && $msgPass == ""){
				$identity=new UserIdentity($str_name,md5($str_password));
				if($identity->authenticate()) {
					Yii::app()->user->login($identity);
					$_SESSION['rid']=$identity->getRid();
					$this->redirect(Yii::app()->user->returnUrl);
				}else{
					$msgError = "用户名或密码错误";
				}
			}
		}
		$this->render('login', array(
			'Name'=>$str_name,
			'msgName'=>$msgName,
			'msgPass'=>$msgPass,
			'msgError'=>$msgError
		));
	}
	
	public function actionLogout(){
		Yii::app()->user->logout();
		$_SESSION['rid']='';
		$this->redirect(Yii::app()->user->returnUrl);
	}
}

?>
