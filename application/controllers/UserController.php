<?php
class UserController extends CI_Controller
{
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
			$password = $this->input->post('LoginForm[password]', TRUE);
			$username = $this->input->post('LoginForm[username]', TRUE);
			$password = md5($password);
			$userInfo = $this->um->checkPass($username, $password);
			if($userInfo) {
				if ($userInfo->is_admin) {
					$sessionData = array(
						'id' => $userInfo->id,
						'username' => $userInfo->username,
						'is_admin' => $userInfo->is_admin,
					);
					$this->session->set_userdata($sessionData);
				} else {
					$sessionData = array(
						'id' => $userInfo->id,
						'username' => $userInfo->username,
					);
					$this->session->set_userdata($sessionData);
				}
				// var_dump($_SESSION);die;
				redirect(site_url('Welcome'));
			} else {
				$data['confError'] = '密码错误';
				$this->load->view('login', $data);
			}
		}
	}

	//会员登出
	public function logout() {
		// var_dump($_SESSION);
		session_destroy();
		// var_dump($_SESSION);die;
		redirect(site_url('Welcome'));
	}

	//显示会员
	public function userList(){
		$this->load->model('UserModel','um');
		$data = $this->um->search();
		// var_dump($data);die;
		$this->load->view('userList', $data);
	}

	//会员修改
	public function userUpdate($id){
		$this->load->model('UserModel','um');
		//验证表单
		$this->load->library('form_validation');
		if ($this->form_validation->run('register') === FALSE) {
			$data = $this->um->find($id);
			$this->load->view('userUpdate', $data);
		} else {
			$this->um->update();
			redirect(site_url('UserController/userList'));
		}
	}

	//后台增加会员
	public function userCreate() {
		//验证表单
		$this->load->library('form_validation');
		if ($this->form_validation->run('register') === FALSE) {
			$this->load->view('userCreate');
		} else {
			$this->load->model('UserModel','um');
			$this->um->create();
			redirect(site_url('UserController/userList'));
		}
	}

	//后台删除会员
	public function userDelete($id) {
		$this->load->model('UserModel','um');
		$this->um->delete($id);
		redirect(site_url('UserController/userList'));
	}

	//显示会员详情
	public function userDetail($id) {
		$this->load->model('UserModel','um');
		$data = $this->um->find($id);
		$this->load->view('userDetail', $data);
	}

	//生成验证码
	public function getCaptcha() {
		$this->load->library('captcha');
		$code = $this->captcha->getCaptcha();
		$this->session->set_userdata('code',$code);
		$this->captcha->showImg();
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
}






















