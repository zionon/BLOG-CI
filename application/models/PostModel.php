<?php
class PostModel extends MY_Model
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

	public function find($id) {
		$this->db->from('ci_post');
		$this->db->where('id', $id);
		$data = $this->db->get();
		$data = $data->result('array');
		return $data[0];
	}

	public function update() {
		$this->db->where('id', $this->input->post('Post[id]'));
		$data = array(
			'title' => $this->input->post('Post[title]',TRUE),
			'content' => $this->input->post('Post[content]', TRUE),
			);
		$ret = $this->db->update('ci_post', $data);
		return $ret;
	}

	public function delete($id) {
		$this->db->delete('ci_post', array('id' => $id));
	}
}







