<?php
//日志模型
class BlogM extends CI_Model{
	protected $tableName = 'bt_blog';
	//添加日志
	public function add() {
		//构造数据
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content', TRUE),
			'is_show' => $this->input->post('is_show'),
			'addtime' => date('Y-m-d H:i:s'),
			);
		//插入数据库
		$this->db->insert('bt_blog',$data);
	}

	public function find($id) {
		// $this->db->from($this->tableName);
		$this->db->where('id', $id);
		$data = $this->db->get($this->tableName);
		$data = $data->result('array');
		return $data[0];
	}

	//显示日志
	public function search($perpage = 5) {
		//搜索->设置where条件到$this->db上
		//标题
		$title = $this->input->get('title');
		if ($title) {
			$this->db->like('title', $title);
		}
		//是否显示
		$isShow = $this->input->get('is_show');
		if ($isShow == '是' || $isShow == '否') {
			$this->db->where('is_show', $isShow);
		}

		//先设置将要操作的表名
		$this->db->from($this->tableName);
		//翻页
		$count = $this->db->count_all_results('', FALSE);
		$this->load->library('pagination');		//加载分页类
		//构造配置数组
		$config['base_url'] = site_url('admin/blogc/lst');
		//总的记录数
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		//翻页时其他的变量继续传
		$config['reuse_query_string'] = TRUE;	//翻页时保留当前搜索条件
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		//根据数组配置翻页类
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

	public function delete($id) {
		$this->db->delete($this->tableName,array('id' => $id)); 
	}

	public function update()
	{
		// 接收表单中的隐藏域id来修改
		$this->db->where('id', $this->input->post('id'));
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content', TRUE),
			'is_show' => $this->input->post('is_show'),
			'addtime' => date('Y-m-d H:i:s'),
			);
		// 更新数据库
		$ret = $this->db->update($this->tableName, $data);

		return $ret;
	}
}







