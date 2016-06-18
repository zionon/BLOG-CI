<?php
//日志控制器
class BlogC extends CI_Controller{
	public function add(){
		//导入表单验证类
		$this->load->library('form_validation');
		//定义验证规则
		$this->form_validation->set_rules('title','标题','required|max_length[150]');
		$this->form_validation->set_rules('content','内容','required');
		//验证表单
		if ($this->form_validation->run() === FALSE) {
			//如果验证失败就显示表单，错误信息在表单中显示
			$this->load->view('admin/blogc/add');
		} else {
			//生成日志模型
			$this->load->model('BlogM');
			$this->BlogM->add();
			//跳转
			redirect(site_url('admin/blogc/lst'));
		}
	}

	public function lst() {
		echo "插入成功";
	}
}