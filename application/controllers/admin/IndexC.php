<?php
//后台首页控制器
class IndexC extends CI_Controller{
	//后台主页
	public function index() {
		$this->load->view('admin/indexc/index');
	}
}