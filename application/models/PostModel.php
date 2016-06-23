<?php
class PostModel extends MY_Model
{
	protected $_tableName = 'post';
	protected $_insertFields = array('title','content');
	protected $_updateFields = array('title','content');

	public function _before_insert(&$data) {
		$data['create_time'] = time();
		$data['update_time'] = time();
		if ($data['create_time'] == $data['update_time']) {
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function read() {
		$this->db->from('ci_post');
		$data = $this->db->get();
		return array(
			'data' => $data);
	}
}







