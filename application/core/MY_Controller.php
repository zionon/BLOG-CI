<?php
class MY_Controller extends CI_Controller
{
	public function __construct() {
		//必须先调用父类的构造函数
		parent::__construct();
		//判断登录
		if (!$_SESSION['is_admin']) {
			redirect(site_url('Welcome'));
		}
	}
}