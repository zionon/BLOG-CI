<?php
class TagController extends CI_Controller
{
	public function add() {
		$this->load->model('TagModel','tm');
		$this->tm->add();
	}
}