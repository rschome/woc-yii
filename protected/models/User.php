<?php
/**
 * 用户管理模块
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

class User extends CActiveRecord {
	
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
		return '{{users}}';
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $password===$this->pass;
	}
}

?>
