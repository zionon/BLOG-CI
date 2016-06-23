<?php
class UserController extends CI_Controller
{
	public function register(){
		$this->load->library('form_validation');
		if ($this->form_validation->run('register') === FALSE) {
			$this->load->view('register');
		} else {
			$this->load->model('UserModel','um');
			$this->um->create();
			echo "注册成功";
		}
	}

	//生成验证码
	public function getCaptcha() {
		$this->load->library('captcha');
		$code = $this->captcha->getCaptcha();
		$this->session->set_userdata('code',$code);
		$this->captcha->showImg();
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