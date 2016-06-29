<?php
class CommentController extends MY_Controller
{
	public function commentCreate() {
		// $this->load->library('form_validation');
		$this->load->model('CommentModel','cm');
		$data = $this->cm->create();
		$data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
		echo json_encode($data);
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

	public function commentStatus() {
		$this->load->model('CommentModel', 'cm');
		$num = $this->cm->statusNum();
		echo json_decode($num);
	}
}