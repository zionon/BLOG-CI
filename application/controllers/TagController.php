<?php
class TagController extends MY_Controller
{
	public function add() {
		$this->load->model('TagModel','tm');
		$this->tm->add();
	}
}