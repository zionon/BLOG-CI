<?php
class PostModel extends MY_Model
{
	protected $_tableName = 'post';
	protected $_insertFields = array('title','content','status','tags','cat_id');
	protected $_updateFields = array('title','content','status','tags','cat_id');

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
		//标签
		$tags = $this->input->get('PostSearch[tags]');
		if ($tags) {
			$this->db->like('ci_post.tags', $tags);
		}
		//分类
		$cat_id = $this->input->get('PostSearch[cat_id]');
		if ($cat_id) {
			$this->db->where('ci_post.cat_id', $cat_id);
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
		$this->db->select('post.id,post.title,post.create_time,post.update_time,post.tags,user.username,lookup.name,category.cat_name', FALSE);
		$this->db->join('user','post.author_id=user.id','left');
		$this->db->join('lookup','post.status=lookup.code','left');
		$this->db->join('category', 'post.cat_id=category.id', 'left');
		$this->db->where('ci_lookup.type','PostStatus');
		//取数据
		$data = $this->db->get('',$perpage,$offset);
		//查询记录数
		$countString = null;
		if ($data->result()) {
			if ($this->pagination->cur_page == 0) {
				$countString = '第<b>1-'.$count.'</b>条，共<b>'.$count.'</b>条记录';
			} else {
				$countTotal = count($data->result());
				$countRight = min($perpage * (int)$this->pagination->cur_page, $count);
				$countLeft = ((int)$this->pagination->cur_page - 1) * $perpage + 1;
				$countString = '第<b>'.$countLeft.'-'.$countRight.'</b>条，共<b>'.$count.'</b>条记录';				
			}
		}
		//返回数据
		return array(
			'data' => $data,
			'page' => $pageString,
			'odby' => $odbyArray,
			'count' => $countString,
		);
	}

	//传统方式显示日志文章
	public function lst($perpage = 10) {
		//标签
		$tags = $this->input->get('PostSearch[tags]');
		if ($tags) {
			$this->db->like('ci_post.tags', $tags);
		}
		$cat_id = $this->input->get('PostSearch[cat_id]');
		if ($cat_id) {
			$this->db->where('ci_post.cat_id', $cat_id);
		}
		$this->db->from($this->_tableName);
		$this->db->where('status', '2');
		$count = $this->db->count_all_results('', FALSE);
		$config['base_url'] = site_url('Welcome/index');
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		//生成翻页字符串
		$pageString = $this->pagination->create_links();
		//根据当前页计算偏移量
		$offset = (max(1,(int)$this->pagination->cur_page) - 1) * $perpage;
		//链表查询
		$this->db->select('post.id,post.title,post.content,post.create_time,post.update_time,post.tags,user.username');
		$this->db->join('user','post.author_id=user.id','left');
		// $this->db->join('comment','comment.post_id=post.id','left');
		// $this->db->where('comment.status', '2');
		//取数据
		$this->db->order_by('create_time','desc');
		$data = $this->db->get('', $perpage, $offset);
		for ($i=0; $i < count($data->result()); $i++) { 
			$data->result()[$i]->tags = explode(',', $data->result()[$i]->tags);
		}
		return array(
			'data' => $data,
			'page' => $pageString
		);		
	}

	//ajax显示日志文章
	public function getPost($ajaxMethod, $perpage = 10) {
		//标签
		$tags = $this->input->get('PostSearch[tags]');
		if ($tags) {
			$this->db->like('ci_post.tags', $tags);
		}
		//类别
		$cat_id = $this->input->get('PostSearch[cat_id]');
		if ($cat_id) {
			$this->db->where('ci_post.cat_id', $cat_id);
		}
		$this->db->from($this->_tableName);
		$this->db->where('status', '2');
		//总的记录数
		$count = $this->db->count_all_results('', FALSE);
		//计算总的页数
		$pageCount = ceil($count / $perpage);
		//当前页
		$currpage = max(1, (int)$this->input->get('p'));
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$config['cur_page'] = $currpage;
		$config['ajax_method'] = $ajaxMethod;
		$config['ajax_para'] = $tags;
		$this->load->library('pagination');
		$this->load->library('page');
		$ajaxPage = $this->page->initialize($config);
		$ajaxPage = $this->page->create_links();
		//根据当前页计算偏移量
		$offset = ($currpage - 1) * $perpage;
		//链表查询
		$this->db->select('post.id,post.title,post.content,post.create_time,post.update_time,post.tags,user.username');
		$this->db->join('user','post.author_id=user.id','left');
		// $this->db->join('comment','comment.post_id=post.id','left');
		// $this->db->where('comment.status', '2');
		//取数据
		$this->db->order_by('create_time','desc');
		$data = $this->db->get('', $perpage, $offset);
		// var_dump($this->db->last_query());
		for ($i=0; $i < count($data->result()); $i++) { 
			$data->result()[$i]->content = $this->getPartStr($data->result()[$i]->content, 100);
			$data->result()[$i]->tags = explode(',', $data->result()[$i]->tags);
			$data->result()[$i]->update_time = date('Y-m-d H:i:s', $data->result()[$i]->update_time);
			$data->result()[$i]->create_time = date('Y-m-d H:i:s', $data->result()[$i]->create_time);
		}
		return array(
			'data' => $data,
			'pageCount' => $pageCount,
			'page' => $ajaxPage,
		);
	}

	public function find($id) {
		$this->db->from($this->_tableName);
		$this->db->where('ci_post.id', $id);
		$this->db->where('ci_lookup.type', 'PostStatus');
		$this->db->select('post.id,post.title,post.content,post.create_time,post.update_time,post.status,post.tags,post.cat_id,user.username,lookup.name,category.cat_name', FALSE);
		$this->db->join('user','post.author_id=user.id','left');
		$this->db->join('lookup','post.status=lookup.code','left');
		$this->db->join('category','post.cat_id=category.id','left');
		$data = $this->db->get();
		$data = $data->result('array');
		return $data[0];
	}

	public function update() {
		$data = array();
		$this->_tableName = ucfirst($this->_tableName);
		$this->db->where('id',$this->input->post("$this->_tableName[id]"));
		$oldTags = $this->db->select('tags')->get($this->_tableName);
		$oldTags = $oldTags->result()[0]->tags;
		$oldTags = explode(',', $oldTags);
		// var_dump($oldTags);die();
		foreach ($this->_updateFields as $value) {
			$data[$value] = $this->input->post("$this->_tableName[$value]",TRUE);
		}
		//更新前的钩子函数
		if (method_exists($this,'_before_update')) {
			if ($this->_before_update($data) === FALSE) {
				return FALSE;
			}
		}
		//更新数据库
		$this->db->where('id', $this->input->post("$this->_tableName[id]"));
		$ret = $this->db->update($this->_tableName,$data);
		//更新后的钩子函数
		$newTags = array_diff(explode(',', $data['tags']), $oldTags);
		// var_dump($newTags);die;
		if (method_exists($this,'_after_update') && !empty($newTags)) {
			$this->_after_update($newTags);
		}
		return $ret;
	}

	protected function _before_insert(&$data) {
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

	protected function _after_insert($data) {
		$tags = explode(',',$data['tags']);
		foreach ($tags as $value) {
			$data = array(
				'name' => $value
			);
			$this->db->insert('tag', $data);
		}
	}

	protected function _before_update(&$data) {
		$data['update_time'] = time();
		$data['author_id'] = '1';
		$data['tags'] = str_replace('，', ',', $data['tags']);
		if ($data['update_time'] == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function _after_update($data) {
		foreach ($data as $value) {
			$newTags['name'] = $value;
			$this->db->insert('tag', $newTags);
		}
	}

	// protected function ajaxPage($count, $perpage, $currpage) {
	// 	$config['total_rows'] = $count;
	// 	$config['per_page'] = $perpage;
	// 	$config['cur_page'] = $currpage;
	// 	$this->load->library('pagination');
	// 	$page = $this->load->library('page');
	// 	return $this->page->initialize($config);
	// }
	protected function getPartStr($str, $len) {
		$one = 0;
		$partstr = '';
		for ($i=0; $i < $len; $i++) { 
			$sstr = substr($str, $one, 3);
			if (ord($sstr) > 224) {
				$partstr .= substr($str, $one, 3);
				$one += 3;
			} elseif (ord($sstr) > 192) {
				$partstr .= substr($str, $one, 2);
				$one += 2;
			} elseif (ord($sstr) < 192) {
				$partstr .= substr($str, $one, 1);
				$one += 1;
			}
		}
		if (strlen($str) < $one) {
			return $partstr;
		} else {
			return $partstr.'....';
		}
	}
}
