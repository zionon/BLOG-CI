<?php
class PostController extends CI_Controller
{
	public function postList(){
		$this->load->view('postList');
	}

	public function postCreate() {
		//验证表单
		$this->load->library('form_validation');
		if ($this->form_validation->run('post') === FALSE) {
			$this->load->view('postCreate');
		} else {
			$this->load->model('PostModel','pm');
			$this->pm->create();
			echo "插入成功";
		}
	}
}