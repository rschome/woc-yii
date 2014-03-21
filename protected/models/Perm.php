<?php
/**
 * 权限获取
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class Perm extends CActiveRecord {
	private $_permission;
	private $_rs;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{permission}}';
	}

	public function getPerm($rid){
		return $this->find('rid=:rid',array(':rid'=>$rid));
	}
}

?>
