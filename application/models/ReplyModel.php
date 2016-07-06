<?php
class ReplyModel extends MY_Model
{
	protected $_tableName = 'reply';
	protected $_insertFields = array('contents','author','email','comment_id');

	public function search($perpage = 10) {
		$this->db->from($this->_tableName);
		//评论id
		$id = $this->input->get('ReplySearch[id]');
		if ($id) {
			$this->db->where('ci_reply.id', $id);
		}
		//内容
		$title = $this->input->get('ReplySearch[content]');
		if ($title) {
			$this->db->like('ci_reply.content',$title);
		}
		//状态
		$status = $this->input->get('ReplySearch[status]');
		// var_dump($status);die;
		if ($status) {
			$this->db->where('ci_reply.status', $status);
		}
		//发表时间
		// $create_time = $this->input->get('ReplySearch[create_time]');
		// if ($create_time) {
		// 	$this->db->like('ci_reply.create_time', $create_time);
		// }
		//内容
		// $content = $this->input->get('PostSearch[content]');
		// if ($content) {
		// 	$this->db->like('content',$content);
		// }
		//制作翻页
		$count = $this->db->count_all_results('', FALSE);
		//构造配置的数组
		$config['base_url'] = site_url('ReplyController/replyList');
		//总的记录数
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		//根据数组配置翻页类
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		//生成翻页字符串
		$pageString = $this->pagination->create_links();
		//根据当前页计算偏移量
		$offset = (max(1,(int)$this->pagination->cur_page) - 1) * $perpage;
		//排序
		$odbyKey = 'status';
		$odbyWay = 'asc';
		$odbyArray = array();
		$odbyArray['key'] = null;
		if ($this->input->get('sort')) {
			$key = $this->input->get('sort');
			$find = '-';
			$pos = strpos($key, $find);
			if ($pos === FALSE) {
				$odbyKey = $key;
				$odbyWay = 'desc';
				$odbyArray['odbyString'] = 'class="desc" data-sort="-'.$key.'" href="'.site_url('ReplyController/replyList').'?sort=-'.$key.'"';
				$odbyArray['key'] = $odbyKey;
			} else {
				$odbyKey = trim($key, $find);
				$odbyArray['odbyString'] = 'class="asc" data-sort="'.$odbyKey.'" href="'.site_url('ReplyController/replyList').'?sort='.$odbyKey.'"';
				$odbyArray['key'] = $odbyKey;
			}
		}
		$this->db->order_by($odbyKey,$odbyWay);
		//连表查询
		$this->db->select('reply.id,reply.contents,reply.create_time,reply.status,reply.author,comment.content,lookup.name', FALSE);
		$this->db->join('comment','comment.id=reply.comment_id','left');
		$this->db->join('lookup','lookup.code=reply.status');
		$this->db->where('ci_lookup.type','CommentStatus');
		//取数据
		$data = $this->db->get('',$perpage,$offset);
		// var_dump($this->db->last_query());die;
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

	public function detail($id) {
		$this->db->from($this->_tableName);
		$this->db->where('reply.id', $id);
		$this->db->where('lookup.type', 'CommentStatus');
		$this->db->join('comment', 'comment.id=reply.comment_id', 'left');
		$this->db->join('lookup', 'comment.status=lookup.code');
		$this->db->select('reply.id,reply.contents,lookup.name,reply.create_time,reply.author,reply.email,comment.content');
		$data = $this->db->get();
		$data = $data->result('array');
		return $data[0];
	}

	public function chkRpy($id) {
		$this->db->where('id', $id);
		$data = array(
			'status' => '2',
		);
		$this->db->update($this->_tableName, $data);
	}

	public function statusNum() {
		$this->db->from($this->_tableName);
		$this->db->where('status', '1');
		$this->db->select('status');
		$data = $this->db->get();
		return count($data->result());
	}

	protected function _before_insert(&$data)
	{
		$data['create_time'] = time();
		if ($data['create_time'] == true) {
			return true;
		} else {
			return false;
		}
	}

}