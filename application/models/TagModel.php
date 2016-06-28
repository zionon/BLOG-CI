<?php
class TagModel extends MY_Model
{
	protected $_tableName = 'tag';
	protected $_insertFiles = array('name','frequency');

	public function search() {
		$data = $this->db->get($this->_tableName);
		return $data;
	}

	public function add() {
		$tagsArray = array("PHP","Composer","教程","安装","查询构建器","模型","Laravel","CI3","Controller","Linux","数组","字符串","转换");
		foreach ($tagsArray as $value) {
			$data = array(
				'name' => $value,
				'frequency' => rand(1,200),
			);
			$this->db->insert($this->_tableName, $data);
			echo "插入成功，值为$value";
		}
	}
}