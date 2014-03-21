<?php
/**
 * 错误控制器（注意继承CController）
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class ErrorController extends CController {
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if ($error=Yii::app()->errorHandler->error) {
	    	if (Yii::app()->request->isAjaxRequest) {
	    		echo $error['message'];
	    	} else {
	        	$this->render('error', $error);
	    	}
	    }
	}
}
