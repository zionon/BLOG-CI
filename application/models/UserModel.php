<?php
//用户模型类
class UserModel extends MY_Model
{

	public function read() {
		$this->db->from('ci_user');
		$data = $this->db->get();
		$data = $data->result('array');
		return $data;
	}
}