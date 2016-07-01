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
	//主页
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

	//单条页面
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

	//会员注册
	public function register(){
		$this->load->library('form_validation');
		if ($this->form_validation->run('register') === FALSE) {
			$this->load->view('register');
		} else {
			// var_dump($this->input->post());die;
			$this->load->model('UserModel','um');
			$this->um->create();
			echo "注册成功";
		}
	}

	//会员登录
	public function login() {
		$this->load->library('form_validation');
		if ($this->form_validation->run('login') === FALSE) {
			// var_dump($this->input->post());die;
			$data['confError'] = null;
			$this->load->view('login', $data);
		} else {
			$this->load->model('UserModel', 'um');
			if ($this->um->chkLogin()) {
				redirect(site_url('Welcome'));
			} else {
				$data['confError'] = '密码错误';
				$this->load->view('login', $data);
			}
		}
	}

	//生成验证码
	public function getCaptcha() {
		$this->load->library('captcha');
		$code = $this->captcha->getCaptcha();
		$this->session->set_userdata('code',$code);
		$this->captcha->showImg();
	}

	//会员登出
	public function logout() {
		// var_dump($_SESSION);
		session_destroy();
		// var_dump($_SESSION);die;
		redirect(site_url('Welcome'));
	}

	//检查用户名是否存在
	public function checkUsername($username) {
		// var_dump($username);die;
		$this->load->model('UserModel','um');
		if ($this->um->findUsername($username)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('checkUsername','用户名不存在');
			return FALSE;
		}
	}

	//检查验证码
	public function checkCode($code) {
		$code = strtolower($code);
		$codeConf = strtolower($this->session->userdata('code'));
		if ($codeConf != $code) {
			$this->form_validation->set_message('checkCode','验证码错误');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	//ajax获取全部日志
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

	//ajax获取tag标签
	public function ajaxGetTagPost() {
		$this->load->model('PostModel', 'pm');
		$data = $this->pm->getPost('ajaxGetTagPost');
		$this->load->model('CommentModel', 'cm');
		$commentNum = $this->cm->totalCom($data['data']);
		$data['num'] = $commentNum;
		$data['data'] = $data['data']->result();
		echo json_encode($data);
	}

	//ajax评论
	public function ajaxPushComment() {
		$this->load->model('CommentModel','cm');
		$data = $this->cm->create();
		$data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
		echo json_encode($data);
	}

}
