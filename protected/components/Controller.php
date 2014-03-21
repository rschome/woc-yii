<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * @general access control
	 */
	public function init()
	{
		$model = new Perm();
		$permission = $model->getPerm(Yii::app()->session['rid']);
		$controller = Yii::app()->getController()->id;
		if ($permission['perm'] && !preg_match("/$controller/", $permission['perm'])) {
			die('你没有访问权限！');
		}
	}
}
?>