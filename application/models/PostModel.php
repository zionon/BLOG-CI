<?php
class PostModel extends CI_Model
{
	public function create() {
		//接收表单
		$data = array(
			'title' => $this->input->post('Post[title]',TRUE),
			'content' => $this->input->post('Post[content]', TRUE),
			'create_time' => time(),
			'update_time' => time(),
			);
		$this->db->insert('ci_post',$data);
	}

	public function read() {
		$this->db->from('ci_post');
		$data = $this->db->get();
		return array(
			'data' => $data);
	}
}