<?php
class PostController extends CI_Controller
{
	public function postList(){
		$this->load->model('PostModel','pm');
		$data = $this->pm->read();
		// var_dump($data);die;
		$this->load->view('postList', $data);
	}

	public function postCreate() {
		//验证表单
		$this->load->library('form_validation');
		if ($this->form_validation->run('post') === FALSE) {
			$this->load->view('postCreate');
		} else {
			$this->load->model('PostModel','pm');
			$this->pm->create();
			redirect(site_url('PostController/postList'));
		}
	}
}