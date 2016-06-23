<?php
class PostModel extends MY_Model
{
	protected $_tableName = 'post';
	protected $_insertFields = array('title','content');
	protected $_updateFields = array('title','content');

	public function search($perpage = 2) {
		$this->db->from($this->_tableName);
		//标题
		$title = $this->input->get('Post[title]');
		if ($title) {
			$this->db->like('title',$title);
		}
		//内容
		$content = $this->input->get('Post[content]');
		if ($content) {
			$this->db->like('content',$content);
		}
		//制作翻页
		$count = $this->db->count_all_results('', FALSE);
		//构造配置的数组
		$config['base_url'] = site_url('PostController/postList');
		//总的记录数
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		//翻页是变量继续传
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
		$this->db->order_by('id','desc');
		//取数据
		$data = $this->db->get('',$perpage,$offset);
		//返回数据
		return array(
			'data' => $data,
			'page' => $pageString,
		);
	}

	public function _before_insert(&$data) {
		$data['create_time'] = time();
		$data['update_time'] = time();
		if ($data['create_time'] == $data['update_time']) {
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function _before_update(&$data) {
		$data['update_time'] = time();
		if ($data['update_time'] == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}







