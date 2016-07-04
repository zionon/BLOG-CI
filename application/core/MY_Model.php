<?php
class MY_Model extends CI_Model
{
	protected $_tableName;
	protected $_insertFields;
	protected $_updateFields;

	public function create() {
		//接收表单
		$data = array();
		$this->_tableName = ucfirst($this->_tableName);
		foreach ($this->_insertFields as $value) {
			$data[$value] = $this->input->post("$this->_tableName[$value]", TRUE);
		}
		//添加前的钩子函数
		if (method_exists($this, '_before_insert')) {
			if ($this->_before_insert($data) === FALSE) {
				return FALSE;
			}
		}
		//插入数据库
		$this->db->insert($this->_tableName,$data);
		//获取新插入的记录的ID
		$data['id'] = $this->db->insert_id();
		//添加后的钩子函数
		if (method_exists($this, '_after_insert')) {
			$this->_after_insert($data);
		}
		return $data;
	}

	public function find($id) {
		$this->db->from($this->_tableName);
		$this->db->where('id',$id);
		$data = $this->db->get();
		$data = $data->result('array');
		return $data[0];
	}

	public function update() {
		$data = array();
		$this->_tableName = ucfirst($this->_tableName);
		$this->db->where('id',$this->input->post("$this->_tableName[id]"));
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
		$ret = $this->db->update($this->_tableName,$data);
		//更新后的钩子函数
		if (method_exists($this,'_after_update')) {
			$this->_after_update($data);
		}
		return $ret;
	}

	public function delete($id) {
		//判断子类中是否定义了_before_delete方法
		if (method_exists($this,'_before_delete')) {
			if ($this->_before_delete($id) === FALSE) {
				return FALSE;
			}
		}
		// var_dump($id);die;
		return $this->db->delete($this->_tableName,array('id' => $id));
	}
}