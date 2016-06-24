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