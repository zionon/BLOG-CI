<?php
//用户模型类
class UserModel extends MY_Model
{
	public function create() {
		$data = array(
			'username' => $this->input->post('User[username]',TRUE),
			'password' => md5($this->input->post('User[password]')),
			'email' => $this->input->post('User[email]', TRUE),
			'register_time' => time(),
			'update_time' => time(),
			);
		$this->db->insert('ci_user',$data);
	}
}