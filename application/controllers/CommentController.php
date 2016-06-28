<?php
class CommentController extends CI_Controller
{
	public function commentCreate() {
		// $this->load->library('form_validation');
		$this->load->model('CommentModel','cm');
		$this->cm->create();
		echo "插入成功";		
	}

	public function commentList() {
		$this->load->model('CommentModel','cm');
		$data = $this->cm->search();
		// var_dump($data);die;
		$this->load->view('commentList', $data);
	}

	public function commentChk($id) {
		$this->load->model('CommentModel', 'cm');
		$this->cm->chkCom($id);
		redirect(site_url('CommentController/commentList'));
	}
}