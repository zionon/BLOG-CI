<?php
class PostModel extends MY_Model
{
	protected $_tableName = 'post';
	protected $_insertFields = array('title','content','status','tags');
	protected $_updateFields = array('title','content','status','tags');

	public function search($perpage = 10) {
		$this->db->from($this->_tableName);
		//文章id
		$id = $this->input->get('PostSearch[id]');
		if ($id) {
			$this->db->where('ci_post.id', $id);
		}
		//标题
		$title = $this->input->get('PostSearch[title]');
		if ($title) {
			$this->db->like('title',$title);
		}
		//状态
		$status = $this->input->get('PostSearch[status]');
		if ($status) {
			$this->db->where('ci_post.status', $status);
		}
		//内容
		// $content = $this->input->get('PostSearch[content]');
		// if ($content) {
		// 	$this->db->like('content',$content);
		// }
		//制作翻页
		$count = $this->db->count_all_results('', FALSE);
		//构造配置的数组
		$config['base_url'] = site_url('PostController/postList');
		//总的记录数
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		//翻页是变量继续传
		// $config['reuse_query_string'] = TRUE;
		// $config['first_link'] = '首页';
		// $config['last_link'] = '尾页';
		// $config['next_link'] = '下一页';
		// $config['prev_link'] = '上一页';
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
				$odbyArray['odbyString'] = 'class="asc" data-sort="-'.$key.'" href="'.site_url('PostController/postList').'?sort=-'.$key.'"';
				$odbyArray['key'] = $odbyKey;
			} else {
				$odbyKey = trim($key, $find);
				$odbyArray['odbyString'] = 'class="desc" data-sort="'.$odbyKey.'" href="'.site_url('PostController/postList').'?sort='.$odbyKey.'"';
				$odbyArray['key'] = $odbyKey;
			}
		}
		$this->db->order_by($odbyKey,$odbyWay);
		//连表查询
		$this->db->select('post.id,post.title,post.create_time,post.update_time,user.username,lookup.name', FALSE);
		$this->db->join('user','post.author_id=user.id','left');
		$this->db->join('lookup','post.status=lookup.code','left');
		$this->db->where('ci_lookup.type','PostStatus');
		//取数据
		$data = $this->db->get('',$perpage,$offset);
		//查询记录数
		$countString = null;
		if ($data->result()) {
			$countTotal = count($data->result());
			$countRight = min($perpage * (int)$this->pagination->cur_page, $count);
			$countLeft = ((int)$this->pagination->cur_page - 1) * $perpage + 1;
			$countString = '第<b>'.$countLeft.'-'.$countRight.'</b>条，共<b>'.$count.'</b>条记录';
		}
		//返回数据
		return array(
			'data' => $data,
			'page' => $pageString,
			'odby' => $odbyArray,
			'count' => $countString,
		);
	}

	public function find($id) {
		$this->db->from($this->_tableName);
		$this->db->where('ci_post.id', $id);
		$this->db->where('ci_lookup.type', 'PostStatus');
		$this->db->select('post.id,post.title,post.content,post.create_time,post.update_time,post.status,user.username,lookup.name', FALSE);
		$this->db->join('user','post.author_id=user.id','left');
		$this->db->join('lookup','post.status=lookup.code','left');
		$data = $this->db->get();
		$data = $data->result('array');
		return $data[0];
	}

	public function _before_insert(&$data) {
		$data['create_time'] = time();
		$data['update_time'] = time();
		$data['author_id'] = '1';
		$data['tags'] = str_replace('，', ',', $data['tags']);
		if ($data['create_time'] == $data['update_time']) {
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function _after_insert($data) {
		$tags = explode(',',$data['tags']);
		foreach ($tags as $value) {
			$data = array(
				'name' => $value
			);
			$this->db->insert('tag', $data);
		}
	}

	public function _before_update(&$data) {
		$data['update_time'] = time();
		$data['author_id'] = '1';
		if ($data['update_time'] == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}







