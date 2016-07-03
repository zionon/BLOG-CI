<?php
class CommentController extends MY_Controller
{
	// public function commentCreate() {
	// 	// $this->load->library('form_validation');
	// 	$this->load->model('CommentModel','cm');
	// 	$data = $this->cm->create();
	// 	$data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
	// 	echo json_encode($data);
	// }

	public function commentList() {
		$this->load->model('CommentModel','cm');
		$data = $this->cm->search();
		// var_dump($data);die;
		$this->load->view('commentList', $data);
	}

	public function commentDelete($id) {
		$this->load->model('CommentModel', 'cm');
		$this->cm->delete($id);
		redirect(site_url('CommentController/commentList'));
	}

	public function commentDetail($id) {
		$this->load->model('CommentModel', 'cm');
		$data = $this->cm->detail($id);
		// var_dump($data);die;
		$this->load->view('commentDetail', $data);
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

	public function commentCheck() {
		$this->load->model('CommentModel','cm');
		foreach ($this->input->post('CommentCheck') as $value) {
			$this->cm->chkCom($value);
		}
		redirect(site_url('CommentController/commentList'));
	}
}






