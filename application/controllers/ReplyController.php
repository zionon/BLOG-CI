<?php
class ReplyController extends MY_Controller
{
	// public function replyCreate() {
	// 	// $this->load->library('form_validation');
	// 	$this->load->model('replyModel','rm');
	// 	$data = $this->rm->create();
	// 	$data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
	// 	echo json_encode($data);
	// }

	public function replyList() {
		$this->load->model('ReplyModel','rm');
		$data = $this->rm->search();
		// var_dump($data);die;
		$this->load->view('replyList', $data);
	}

	public function replyDelete($id) {
		$this->load->model('ReplyModel', 'rm');
		$this->rm->delete($id);
		redirect(site_url('replyController/replyList'));
	}

	public function replyDetail($id) {
		$this->load->model('ReplyModel', 'rm');
		$data = $this->rm->detail($id);
		// var_dump($data);die;
		$this->load->view('replyDetail', $data);
	}

	public function replyChk($id) {
		$this->load->model('ReplyModel', 'rm');
		$this->rm->chkRpy($id);
		redirect(site_url('replyController/replyList'));
	}

	public function replyStatus() {
		$this->load->model('ReplyModel', 'rm');
		$num = $this->rm->statusNum();
		echo json_decode($num);
	}

	public function replyCheck() {
		$this->load->model('ReplyModel','rm');
		foreach ($this->input->post('ReplyCheck') as $value) {
			$this->rm->chkRpy($value);
		}
		redirect(site_url('replyController/replyList'));
	}
}