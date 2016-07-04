<?php
//无限级分类
class CategoryController extends MY_Controller
{
	public function categoryCreate() {
		$this->load->library('form_validation');
		$this->load->model('CategoryModel', 'cm');
		$data = $this->cm->getTree();
		if ($this->form_validation->run('category') === FALSE) {
			$this->load->view('categoryCreate', $data);
		} else {
			$this->cm->create();
			redirect(site_url('CategoryController/categoryList'));
		}
	}

	public function categoryList() {
		$this->load->model('CategoryModel', 'cm');
		$data['tree'] = $this->cm->getTree();
		$this->load->view('categoryList', $data);
	}

	public function categoryUpdate($id) {
		$this->load->library('form_validation');
		$this->load->model('CategoryModel', 'cm');
		$data['tree'] = $this->cm->getTree();
		if ($this->form_validation->run('category') === FALSE) {
			$data['data'] = $this->cm->find($id);
			$data['children'] = $this->cm->getChildren($id);
			$this->load->view('categoryUpdate', $data);
		} else {
			$this->cm->update($id);
			redirect(site_url('CategoryController/categoryList'));
		}
	}
}