<?php
class PostController extends MY_Controller
{
	public function postList(){
		$this->load->model('PostModel','pm');
		$data = $this->pm->search();
		// var_dump($data['data']->result());die;
		// var_dump($data['page']);die;
		$this->load->view('postList', $data);
	}

	public function postCreate() {
		//验证表单
		$this->load->library('form_validation');
		if ($this->form_validation->run('post') === FALSE) {
			$this->load->model('CategoryModel', 'cm');
			$data['tree'] = $this->cm->getTree();
			$this->load->view('postCreate', $data);
		} else {
			$this->load->model('PostModel','pm');
			$this->pm->create();
			redirect(site_url('PostController/postList'));
		}
	}

	public function postUpdate($id) {
		$this->load->model('PostModel','pm');
		$this->load->model('CategoryModel', 'cm');
		//验证表单
		$this->load->library('form_validation');
		if ($this->form_validation->run('post') === FALSE) {
			$data = $this->pm->find($id);
			$data['tree'] = $this->cm->getTree();
			// var_dump($data);die;
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