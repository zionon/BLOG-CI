<?php
class CommentModel extends MY_Model
{
	protected $_tableName = 'comment';
	protected $_insertFields = array('content','author','email','post_id');

	protected function _before_insert(&$data) {
		$data['create_time'] = time();
		if ($data['create_time']) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}