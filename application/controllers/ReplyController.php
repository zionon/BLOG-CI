<?php
class ReplyController extends MY_Controller
{
	// public function replyCreate() {
	// 	// $this->load->library('form_validation');
	// 	$this->load->model('replyModel','cm');
	// 	$data = $this->cm->create();
	// 	$data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
	// 	echo json_encode($data);
	// }

	public function replyList() {
		$this->load->model('ReplyModel','cm');
		$data = $this->cm->search();
		// var_dump($data);die;
		$this->load->view('replyList', $data);
	}

	public function replyDelete($id) {
		$this->load->model('ReplyModel', 'cm');
		$this->cm->delete($id);
		redirect(site_url('replyController/replyList'));
	}

	public function replyDetail($id) {
		$this->load->model('ReplyModel', 'cm');
		$data = $this->cm->detail($id);
		// var_dump($data);die;
		$this->load->view('replyDetail', $data);
	}

	public function replyChk($id) {
		$this->load->model('ReplyModel', 'cm');
		$this->cm->chkRpy($id);
		redirect(site_url('replyController/replyList'));
	}

	public function replyStatus() {
		$this->load->model('ReplyModel', 'cm');
		$num = $this->cm->statusNum();
		echo json_decode($num);
	}

	public function replyCheck() {
		$this->load->model('ReplyModel','cm');
		foreach ($this->input->post('ReplyCheck') as $value) {
			$this->cm->chkRpy($value);
		}
		redirect(site_url('replyController/replyList'));
	}
}