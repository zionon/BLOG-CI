<?php
//后台首页控制器
class IndexC extends CI_Controller{
	//增加
	public function index() {
		$this->load->view('admin/indexc/index');
	}
}