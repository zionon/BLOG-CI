<?php
class CommentController extends CI_Controller
{
	public function commentCreate() {
		// $this->load->library('form_validation');
		$this->load->model('CommentModel','cm');
		$this->cm->create();
		echo "插入成功";		
	}

	public function commnetList() {
		$this->load->model('CommentModel','cm');
		$data = $this->cm->search();
	}
}