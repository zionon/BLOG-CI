<?php
//用户模型类
class UserModel extends MY_Model
{
	protected $_tableName = 'user';
	protected $_insertFields = array('username','password','email');
	protected $_updateFields = array('username','password','email');

	public function _before_insert(&$data) {
		$data['password'] = md5($data['password']);
		$data['register_time'] = time();
		$data['update_time'] = time();
		if ($data['register_time'] === $data['update_time']) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}