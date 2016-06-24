<?php
class PostController extends CI_Controller
{
	public function postList(){
		$this->load->model('PostModel','pm');
		$data = $this->pm->search();
		// var_dump($data['data']->result());die;
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

	public function postUpdate($id) {
		$this->load->model('PostModel','pm');
		//验证表单
		$this->load->library('form_validation');
		if ($this->form_validation->run('post') === FALSE) {
			$data = $this->pm->find($id);
			$this->load->view('postUpdate', $data);
		} else {
			$this->pm->update();
			redirect(site_url('PostController/postList'));
		}
	}

	public function postDelete($id) {
		$this->load->model('PostModel', 'pm');
		$this->pm->delete($id);
		redirect(site_url('PostController/postList'));
	}

	public function postDetail($id) {
		$this->load->model('PostModel','pm');
		$data = $this->pm->find($id);
		// var_dump($data);die;
		$this->load->view('postDetail', $data);
	}
}