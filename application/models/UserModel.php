<?php
//用户模型类
class UserModel extends MY_Model
{
	protected $_tableName = 'user';
	protected $_insertFields = array('username','password','email');
	protected $_updateFields = array('username','password','email');

	public function search($perpage = 2) {
		//要操作的表
		$this->db->from($this->_tableName);
		//查询的id
		$id = $this->input->get('UserSearch[id]');
		if ($id) {
			$this->db->where('id', $id);
		}
		//查询的username
		$username = $this->input->get('UserSearch[username]');
		if ($username) {
			$this->db->like('username', $username);
		}
		//查询的email
		$email = $this->input->get('UserSearch[email]');
		if ($email) {
			$this->db->like('email', $email);
		}

		//制作翻页
		$count = $this->db->count_all_results('', FALSE);
		//构造配置的数组
		$config['base_url'] = site_url('UserController/userList');
		//总的记录数
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		//翻页时变量继续传
		$config['reuse_query_string'] = TRUE;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		//根据数组配置翻页类
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		//生成翻页字符串
		$pageString = $this->pagination->create_links();
		//根据当前页计算偏移量
		$offset = (max(1,(int)$this->pagination->cur_page) - 1) * $perpage;
		//排序
		$odbyKey = 'id';
		$odbyWay = 'desc';
		$odbyArray = array();
		$odbyArray['key'] = null;
		if ($this->input->get('sort')) {
			$key = $this->input->get('sort');
			$find = '-';
			$pos = strpos($key, $find);
			if ($pos === FALSE) {
				$odbyKey = $key;
				$odbyWay = 'asc';
				$odbyArray['odbyString'] = 'class="asc" sort-data="-'.$odbyKey.'" href="'.site_url('UserController/userList').'?sort=-'.$odbyKey.'"';
				$odbyArray['key'] = $odbyKey;
			} else {
				$odbyKey = trim($key, $find);
				$odbyArray['odbyString'] = 'class="desc" sort-data="'.$odbyKey.'" href="'.site_url('UserController/userList').'?sort='.$odbyKey.'"';
				$odbyArray['key'] = $odbyKey;
			}
		}
		$this->db->order_by($odbyKey, $odbyWay);
		//取数据
		$data = $this->db->get('', $perpage, $offset);
		//返回数据
		return array(
			'data' => $data,
			'page' => $pageString,
			'odby' => $odbyArray,
		);
	}

	public function chkLogin() {
		$password = $this->input->post('LoginForm[password]', TRUE);
		$username = $this->input->post('LoginForm[username]', TRUE);
		$password = md5($password);
		$userInfo = $this->checkPass($username, $password);
		if($userInfo) {
			if ($userInfo->is_admin) {
				$sessionData = array(
					'id' => $userInfo->id,
					'username' => $userInfo->username,
					'is_admin' => $userInfo->is_admin,
				);
				$this->session->set_userdata($sessionData);
				// $this->session->set_tempdata($sessionData, NULL, 500);
			} else {
				$sessionData = array(
					'id' => $userInfo->id,
					'username' => $userInfo->username,
				);
				$this->session->set_userdata($sessionData);
				$this->session->set_tempdata($sessionData, NULL, 50000);
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function findUsername($username) {
		$this->db->where('username', $username);
		$isUsername = $this->db->get('user');
		if ($isUsername->result()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function checkPass($username, $password) {
		$this->db->where('username', $username);
		$this->db->select('id,username,password,is_admin');
		$data = $this->db->get('user');
		// var_dump($data->result());die;
		if ($data->result()[0]->password === $password) {
			return $data->result()[0];
		} else {
			return FALSE;
		}
	}

	protected function _before_insert(&$data) {
		$data['password'] = md5($data['password']);
		$data['register_time'] = time();
		$data['update_time'] = time();
		if ($data['register_time'] === $data['update_time']) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function _before_update(&$data) {
		$data['password'] = md5($data['password']);
		$data['update_time'] = time();
		if ($data['update_time'] == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}












