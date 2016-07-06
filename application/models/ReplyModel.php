<?php
class ReplyModel extends MY_Model
{
	protected $_tableName = 'comment_reply';
	protected $_insertFields = array('content','author','email','comment_id');

	protected function _before_insert(&$data)
	{
		$data['create_time'] = time();
		if ($data['create_time'] == true) {
			return true;
		} else {
			return false;
		}
	}

}