<?php
/**
 * 站点管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class SiteController extends Controller {

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

	public function actionList()
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$list = array();
		$criteria=new CDbCriteria(array(
			'order'=>'sid ASC'
		));
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if ($id) $criteria->addCondition("sid = $id");
		$sites = new Site();
        $count = $sites->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);
        $list = $sites->findAll($criteria);
		$mynum = $mynum2 = array();
		$rnum = new Rnum();
		foreach ($list as $key => $site) {
			$row = $rnum->find('sname=:sname', array(':sname'=>$site->name));
			$mynum[$key] = $row->onum;
			$mynum2[$key] = $row->cnum;
		}
        $this->render('list',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'pages'=>$pager,
			'list'=>$list,
			'mynum'=>$mynum,
			'mynum2'=>$mynum2
        ));
	}

	public function actionAdd() {
		$msgSite = "";
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
			$name = trim($request->getPost("name"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$method = trim($request->getPost("method"));
			$status = trim($request->getPost("status"));
			$type_id = trim($request->getPost("site_type"));
			$domain_id = trim($request->getPost("domain"));
			$host_id = trim($request->getPost("host"));
			$data_id = trim($request->getPost("data"));
			$email_id = trim($request->getPost("email"));
			if($name == ""){
				$msgSite = "网站名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgSite = "输入不能大于64个字符";
			}else if($admin == ""){
				$msgSite = "网站后台选项不能留空";
			}else if($username == ""){
				$msgSite = "用户名称选项不能留空";
			}else if($password == ""){
				$msgSite = "用户密码选项不能留空";
			}else if($method == ""){
				$msgSite = "连接方式选项不能留空";
			}
			if($msgSite == ""){
				$site = array(
					'name' => $name,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'method' => $method,
					'status' => $status,
					'tid' => $type_id,
					'dmid' => $domain_id,
					'hid' => $host_id,
					'dbid' => $data_id,
					'eid' => $email_id
				);
				$rnum = array(
					'sname' => $name,
					'onum'=>0,
					'cnum'=>0
				);
				try{
					$res = new Site();
					$res->_attributes = $site;
					$res->insert();
					$res2 = new Rnum();
					$res2->_attributes = $rnum;
					$res2->insert();
					$this->redirect(array('list'));
				}catch(CDbException $re){
					throw CDbException($re);
				}
			}
		}
		try{
			$type = new Type();
			$type = $type->findAll();
			$domain = new Domain();
			$domain = $domain->findAll();
			$host = new Host();
			$host = $host->findAll();
			$data = new Data();
			$data = $data->findAll();
			$email = new Email();
			$email = $email->findAll();
		}catch(CDbException $e){
			throw CDbException($e);
		}
        $this->render('add',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'type'=>$type,
			'domain'=>$domain,
			'host'=>$host,
			'data'=>$data,
			'email'=>$email,
			'msgSite'=>$msgSite
        ));
	}
	
	public function actionEdit() {
		$msgSite = "";
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if(!empty($_POST)) {
			$name = trim($request->getPost("name"));
			$admin = trim($request->getPost("admin"));
			$username = trim($request->getPost("username"));
			$password = trim($request->getPost("password"));
			$method = trim($request->getPost("method"));
			$status = trim($request->getPost("status"));
			$onum = trim($request->getPost("onum"));
			$cnum = trim($request->getPost("cnum"));
			$type_id = trim($request->getPost("site_type"));
			$domain_id = trim($request->getPost("domain"));
			$host_id = trim($request->getPost("host"));
			$data_id = trim($request->getPost("data"));
			$email_id = trim($request->getPost("email"));
			$oldname = trim($request->getPost("oldname"));
			if($name == ""){
				$msgSite = "网站名称选项不能留空";
			}else if(strlen($name)> 64){
				$msgSite = "输入不能大于64个字符";
			}else if($admin == ""){
				$msgSite = "网站后台选项不能留空";
			}else if($username == ""){
				$msgSite = "用户名称选项不能留空";
			}else if($password == ""){
				$msgSite = "用户密码选项不能留空";
			}else if($method == ""){
				$msgSite = "连接方式选项不能留空";
			}
			if($msgSite == ""){
				$site = array('name'=>$name,'admin' => $admin,'username' => $username,'password' => $password,'method' => $method,'status' => $status,'tid'=>$type_id,'dmid' => $domain_id,'hid' => $host_id,'dbid' => $data_id,'eid' => $email_id);
				$rnum = array('sname'=>$name,'onum'=>$onum,'cnum'=>$cnum);
				try{
					$res = new Site();
					$res->_pk = $id;
					$res->_attributes = $site;
					$res->setIsNewRecord(false);
					$res->update();
					$res2 = new Rnum();
					$res2 = $res2->find('sname=:sname',array(':sname'=>$oldname));
					$res2->_attributes = $rnum;
					$res2->setIsNewRecord(false);
					$res2->update();
					$this->redirect(array('list'));
				}catch(CDbException $e){
					throw CDbException($e);
				}
			}
		}
		try{
		    $sitet_type = new Type();
			$type = $sitet_type->findAll();	
			$domain = new Domain();
			$domain = $domain->findAll();
			$host = new Host();
			$host = $host->findAll();
			$data = new Data();
			$data = $data->findAll();
			$email = new Email();
			$email = $email->findAll();
		}catch(CDbException $e){
			throw CDbException($e);
		}
        try{
			$Rs = new Site();
			$Rs2 = new Rnum();
			$rsInfo=$Rs->findByPk($id);
			$rsNum = $Rs2->find('sname=:sname', array(':sname'=>$rsInfo->name));
        }catch(CDbException $e){
			throw CDbException($e);
        }
        $this->render('edit',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'type'=>$type,
			'domain'=>$domain,
			'host'=>$host,
			'data'=>$data,
			'email'=>$email,
			'rsInfo'=>$rsInfo,
			'rsNum'=>$rsNum,
			'msgSite'=>$msgSite
        ));
	}

	public function actionDelete() { 
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$res = new Site();
				$res2 = new Rnum();
				$res3 = new Seo();
				$row = $res->findByPk($id);
				$row2 = $res2->find('sname=:sname', array(':sname'=>$row->name));
				$row3 = $res3->find('sid=:sid', array(':sid'=>$row->sid));
				$row->delete();
				$row2->delete();
				$row3->delete();
				$this->redirect(array('list'));
			}catch(CDbException $e){
				throw CDbException($e);
			}
		}
	}
}

?>
