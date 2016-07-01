<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WelcomeController extends CI_Controller {

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
		$this->load->model('TagModel','tm');
		$tag = $this->tm->search();
		$data['tags']['tags'] = $tag;
		// var_dump($data['data']->result());die;
		$this->load->model('CommentModel', 'cm');
		$comment = $this->cm->newCom();
		$commentNum = $this->cm->totalCom($data['data']);
		$data['num'] = $commentNum;
		$data['comments']['comment'] = $comment->result();
		// var_dump($data);die;
		$this->load->view('blog', $data);
	}

	public function detail() {
		$this->load->model('PostModel', 'pm');
		$data = $this->pm->find($this->input->get('id'));
		// $data['tags'] = null;
		$this->load->model('TagModel','tm');
		$tag = $this->tm->search();
		$data['tag']['tags'] = $tag;
		// var_dump($data);die;
		$this->load->model('CommentModel', 'cm');
		$comm = $this->cm->find($this->input->get('id'));
		$comments = $this->cm->newCom();
		$data['comment'] = $comm;
		$data['comments']['comment'] = $comments->result();
		$this->load->view('detail', $data);
	}

	public function ajaxGetAllPost() {
		$this->load->model('PostModel', 'pm');
		$data = $this->pm->getPost('ajaxGetAllPost');
		$this->load->model('CommentModel', 'cm');
		$commentNum = $this->cm->totalCom($data['data']);
		$data['num'] = $commentNum;
		$data['data'] = $data['data']->result();
		// var_dump($data['page']);		
		// var_dump($data['page']->create_links());
		// var_dump($data['page']->cur_page);
		// var_dump($data['page']);die;
		echo json_encode($data);
	}

	public function ajaxGetTagPost() {
		$this->load->model('PostModel', 'pm');
		$data = $this->pm->getPost('ajaxGetTagPost');
		$this->load->model('CommentModel', 'cm');
		$commentNum = $this->cm->totalCom($data['data']);
		$data['num'] = $commentNum;
		$data['data'] = $data['data']->result();
		echo json_encode($data);
	}

}
