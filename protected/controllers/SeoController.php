<?php
/**
 * SEO管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class SeoController extends Controller {

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
		$criteria=new CDbCriteria(); 
		$criteria->select = 'sid,name';
		$criteria->order = 'sid ASC';
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
		$res = new Seo();
		$seo = array();
		foreach ($list as $key => $site) {
			$row = $res->find('sid=:sid', array(':sid'=>$site->sid));
			$seo[$key] = $row;
		}
        $this->render('list',array(
			'r'=>Yii::app()->request->baseUrl.'/',
			'pages'=>$pager,
			'list'=>$list,
			'seo'=>$seo
        ));
	}

	public function actionRefresh() { 
		$request = Yii::app()->getRequest();
		$sid = trim($request->getParam("sid"));
		if($sid){
			try{
				//获取url
				$site = new Site();
				$row = $site->find('sid=:sid', array(':sid'=>$sid));
				$domain = new Domain();
				$row = $domain->find('id=:id', array(':id'=>$row['dmid']));
				$url = 'www.' . $row['name'];

				//获取seo信息
				$seo = new Seotool($url);
				$info['alexa'] = (int)$seo->getAlexaRank();
				$info['google'] = (int)$seo->getIndexedGoogle();
				$info['baidu'] = (int)$seo->getIndexedBaidu();
				$info['pr'] = (int)$seo->getPagerank();
				$info['sid'] = $sid;

				//更新数据
				$res = new Seo();
				$row = $res->find('sid=:sid', array(':sid'=>$sid));
				if ($row) {
					$res = new Seo();
					$res->_pk = $row['id'];
					$res->_attributes = $info;
					$res->setIsNewRecord(false);
					$res->update();
				} else {
					$res = new Seo();
					$res->_attributes = $info;
					$res->insert();
				}
				$this->redirect(array('list'));
			}catch(CDbException $e){
				throw CDbException($e);
			}
		}
	}
}

?>
