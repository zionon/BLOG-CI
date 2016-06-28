<?php
class CommentModel extends MY_Model
{
	protected $_tableName = 'comment';
	protected $_insertFields = array('content','author','email','post_id');

	public function search($perpage = 3) {
		$this->db->from($this->_tableName);
		//评论id
		$id = $this->input->get('CommnetSearch[id]');
		if ($id) {
			$this->db->where('ci_comment.id', $id);
		}
		//内容
		$title = $this->input->get('CommnetSearch[content]');
		if ($title) {
			$this->db->like('content',$title);
		}
		//状态
		$status = $this->input->get('CommnetSearch[status]');
		if ($status) {
			$this->db->where('status', $status);
		}
		//内容
		// $content = $this->input->get('PostSearch[content]');
		// if ($content) {
		// 	$this->db->like('content',$content);
		// }
		//制作翻页
		$count = $this->db->count_all_results('', FALSE);
		//构造配置的数组
		$config['base_url'] = site_url('CommnetController/commentList');
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
		$this->db->select('comment.id,comment.content,comment.create_time,comment.status,comment.author,post.title', FALSE);
		$this->db->join('post','post.id=comment.post_id','left');
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

	protected function _before_insert(&$data) {
		$data['create_time'] = time();
		if ($data['create_time']) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}