<?php 
/**
 * 侧边栏公共部件
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */
	
class Sidebar extends CWidget {
   private $permission;

   public function init()
   {
	   $model = new Perm();
	   $this->permission = $model->getPerm(Yii::app()->session['rid']);
	   parent::init();
   }

   public function run() {
	   $controller = Yii::app()->getController()->id;
	   $this->render('sidebar',array(
		     'permission' => $this->permission,
		     $controller => "class='active'"
	   ));
   }
}

?>
