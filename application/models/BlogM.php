<?php
//日志模型
class BlogM extends CI_Model{
	public function add() {
		//构造数据
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content', TRUE),
			'is_show' => $this->input->post('is_show'),
			'addtime' => date('Y-m-d H:i:s'),
			);
		//插入数据库
		$this->db->insert('bt_blog',$data);
	}
}