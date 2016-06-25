<?php
class TestController extends CI_Controller
{
	public function add() {
		$this->load->model('TestModel','tm');
		if ($this->tm->create()) {
			echo "插入成功";
		} else {
			echo "插入失败";
		}
	}
}