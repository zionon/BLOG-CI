<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('PostModel','pm');
		$data = $this->pm->lst();
		// var_dump($data['data']->result());die;
		$this->load->model('TagModel','tm');
		$tag = $this->tm->search();
		// var_dump($tag->result());die;
		$data['tags'] = $tag;
		// var_dump($data);die;
		$this->load->view('blog', $data);
	}
}
