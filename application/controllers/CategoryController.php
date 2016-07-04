<?php
//无限级分类
class CategoryController extends MY_Controller
{
	public function categoryCreate() {
		$this->load->library('form_validation');
		$this->load->model('CategoryModel', 'cm');
		$data = $this->cm->getTree();
		// var_dump($data);die;
		if ($this->form_validation->run('category') === FALSE) {
			$this->load->view('categoryCreate', $data);
		} else {
			$this->cm->create();
			echo "插入成功";
		}
	}

	public function categoryList() {
		$this->load->model('CategoryModel', 'cm');
		$data = $this->cm->getTree();
		$this->load->view('categoryList', $data);
	}
}